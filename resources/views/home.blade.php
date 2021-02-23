@extends('layouts.app')

@section('content')
    <div class="chat-window">
        @php
            $username = Auth::user()->firstName." ".Auth::user()->secondName;
            $profile = Auth::user()->profile;
            $status = $profile->status;
            $profile_image = $profile->profile_image;
        @endphp
        <chat-window user="{{ $username }}" status="{{ $status }}" image="{{ $profile_image }}" ></chat-window>
    </div>
@endsection
