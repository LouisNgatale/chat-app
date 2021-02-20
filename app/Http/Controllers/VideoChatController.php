<?php

namespace App\Http\Controllers;

use App\Events\AcceptCall;
use App\Events\CallEvent;
use App\Events\CancelCall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoChatController extends Controller{

    public function makeCall(Request $request) {
        $data['conversation_id'] = $request->input('conversation_id');
        $data['signalData'] = $request->signal_data;
        $caller = Auth::user()->name;
        broadcast(new CallEvent($data,$caller))->toOthers();
        return  $data['signalData'];
    }

    public function cancel(Request $request) {
        $receiver = $request->input('conversation_id');
        $sender = Auth::user()->name;
        broadcast(new CancelCall($receiver,$sender))->toOthers();
        return  $receiver;
    }

    public function accept(Request $request) {
        $data['conversation_id'] = $request->input('conversation_id');
        $data['signal'] = $request->signal;
        $data['to'] = $request->to;
        $data['type'] = 'callAccepted';
        $sender = Auth::user()->name;
        broadcast(new AcceptCall($data,$sender))->toOthers();
        return  $data['conversation_id'];
    }

}
