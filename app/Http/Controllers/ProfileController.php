<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function store(Request $request) {
        $user = Auth::user();

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
            $imagePath = request('profile_pic')->store('uploads', 'public');

            //Resize & store Image
            $image = Image::make("storage/{$imagePath}")->fit(1200,1200);
            $image->save();

        $profile = new Profile([
            'status' => $request->input('status'),
            'bio' => $request->input('bio'),
            'profile_image' => $imagePath
        ]);

        // Save profile
        $user->profile()->save($profile);

        //Create new address model
        $address = new Address([
            'country' => $request->input('country')
        ]);


        //Save address
        $profile = $user->profile;
        $profile->address()->save($address);


        //Save birthdate
        $user->birthDate = $request->input('birthday');
        $user->save();

        // Redirect user
        return redirect('/home');
    }
}
