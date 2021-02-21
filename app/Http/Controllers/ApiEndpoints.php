<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Conversations;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiEndpoints extends Controller{

    public $conversation_id;

    public function allUsers() {
        return DB::table('users')->select('name','email','id')->get();
    }

    public function getConversation($conversation_id) {
        return  DB::table('messages')
            ->join('users', 'users.id', '=', 'messages.receiver_id')
            ->where('messages.conversations_id', '=',$conversation_id)
            ->select('messages.message_body','messages.receiver_id','messages.read','messages.created_at')
            ->get();
    }

    public function allConversations() {
        //Authenticated User
        $authenticated_user = auth()->id();
        $ids_array = array();
        $users = array();
        $conversation_array = array();
        $id_num = 0;
        $i = 0;

        //Array of conversation Id's  that belongs to the authenticated users
        $conversations = $this->getConversations($authenticated_user);
        $ids = json_decode($conversations,true);


        //Push ids to the array
        foreach ($ids as $id){
            //Query the specific
            array_push($ids_array,$id['id']);
            $id_num++;
        }

        //For each conversation Id, query their respective conversation participants other than the authenticated user
        foreach ($ids_array as $id_array){
            $user_name = json_decode($this->getUserName($authenticated_user, $id_array),true);
            $users[$i] = array(
                'Participant_A' => $user_name[0]['name'],
                'Participant_A_id' => $user_name[0]['id'],
                'Conversation_Id' => $ids_array[$i]
            );
            $i++;
        }

        $conversation_array = array(
            'Logged_User' =>  $authenticated_user,
            'Users' => $users
        );

        return $conversation_array;
    }

    public function getUserName(int $authenticated_user, $conversation_id): \Illuminate\Support\Collection {
        return DB::table('users')
            ->join('conversations_users_pivot', 'users.id', '=', 'conversations_users_pivot.users_id')
            ->join('conversations', 'conversations.id', '=', 'conversations_users_pivot.conversations_id')
            ->where('conversations_users_pivot.users_id', '!=', $authenticated_user)
            ->where('conversations_users_pivot.conversations_id', '=', $conversation_id)
            ->select('users.name','users.id')
            ->get();
    }

    public function getConversations(int $authenticated_user): \Illuminate\Support\Collection {
        return DB::table('users')
            ->join('conversations_users_pivot', 'users.id', '=', 'conversations_users_pivot.users_id')
            ->join('conversations', 'conversations.id', '=', 'conversations_users_pivot.conversations_id')
            ->where('conversations_users_pivot.users_id', '=', $authenticated_user)
            ->select('conversations.id')
            ->get();
    }

    public function sendMessage(Request $request,Messages $messages) {
        $conversation_id = $request->input('conversation_id');
        $message_body = $request->input('message_body');
        $receiver_id = $request->input('receiver_id');

       $id =  DB::table('messages')
            ->insert([
                'conversations_id' => $conversation_id,
                'message_body' => $message_body,
                'receiver_id' => $receiver_id,
            ]);

        broadcast(new NewMessage($message_body,$receiver_id, $conversation_id))->toOthers();
        return $message_body;
    }

    public function search($keyword) {
        $users = User::where('name', 'LIKE', "%$keyword%")->get();

        return $users;
    }

}
