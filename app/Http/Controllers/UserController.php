<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
//    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse $response
     */
    public function index()
    {
        $user = Auth::user();
        $profile = Profile::find(Auth::id());

        $data = [];
//
        $data['firstName'] = $user->firstName;
        $data['secondName'] = Auth::user()->secondName;
        $data['userName'] = Auth::user()->userName;

        $data['bio'] = $profile->bio;
        $data['image'] = $profile->profile_image;
//
        $response = ApiHelper::apiResponse(false,202,"Success", $data );

        return response()->json($response,200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response $response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response $response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
