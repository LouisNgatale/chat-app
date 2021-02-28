<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $user;

    public function index() {
        $user = Auth::user();
        $id = Auth::id();

        $profile = DB::table('profiles')
            ->where('user_id',"=",$id)
            ->get();
        $profile = json_decode($profile,true);

        $data = [];


        $data['firstName'] = $user->firstName;
        $data['secondName'] = $user->secondName;
        $data['userName'] = $user->userName;

        $data['bio'] = $profile[0]['bio'];
        $data['image'] = $profile[0]['profile_image'];

        $response = ApiHelper::apiResponse(false,202,"Success", $data );
        return response()->json($response,200);
//        dd($profile);
//         return $bio;
    }

    public function create(Request $request) {
        //
    }


    public function store(Request $request) {
        //
    }


    public function show(int $id) {
        //
    }


    public function edit($id) {
        //
    }


    public function update(Request $request, $id) {
        //
    }


    public function destroy($id) {
        //
    }
}
