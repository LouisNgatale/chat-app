<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function index()
    {
        return  new PostCollection(Post::all());
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $user_id = Auth::id();

        // Get Constraints
        // TODO: Make the image path unique
        $imagePath = request('image')->store('uploads/posts', 'public');
        $caption = $request->input('caption');

        //Resize & store Image
        $image = Image::make("storage/{$imagePath}")->fit(1200,1200);
        $image->save();

        //TODO: Make privacy dynamic
        try {
            DB::table('posts')
                ->insert([
                    'caption' => $caption,
                    'media' => $imagePath,
                    'privacy' => 'Public',
                    'user_id' => $user_id
                ]);
            return ApiHelper::apiResponse(false,201,"Uploaded Successfully");
        }catch (\Exception $exception){
            return ApiHelper::apiResponse(true,400,"Uploaded Failed");
        }


    }

    function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
