<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function store(Request $request) {
        $user = Auth::user();
        $id = Auth::id();

        $v = Validator::make($request->all(), [
            'birthday' => 'nullable | before:18 years ago',
            'status' => 'string|min:1|max:30|nullable',
            'bio' => 'string|min:1|max:32|nullable',
            'profile_pic' => '',
            'country' => 'required'
        ], // rules
            ['before' => 'You must be at least 18 years old',], // messages
        );

        if ($v->fails()) {
            return redirect('register/profile')
                ->withErrors($v)
                ->withInput();
        }

        //Create new profile model
            // Get image path
            $imagePath = request('profile_pic')->store('uploads/profile', 'public');

        //Resize & store Image
            $image = Image::make("storage/{$imagePath}")->fit(1200,1200);
            $image->save();


        // Create & save profile
        $profile_id = DB::table('profiles')->insertGetId([
            'status' => $request->input('status'),
            'bio' => $request->input('bio'),
            'user_id' => $id ,
            'profile_image' => $imagePath
        ]);

        //Create & save address
        DB::table('addresses')->insert([
            'country' => $request->input('country'),
            'profile_id' => $profile_id
        ]);


        //Save birthdate
        $user->birthDate = $request->input('birthday');
        $user->save();

        return Redirect::route('home');
    }
}
