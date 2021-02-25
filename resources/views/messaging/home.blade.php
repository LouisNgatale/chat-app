@extends('layouts.app')

@section('content')
    <div class="chat-window">
        @php
            $username = Auth::user()->username." ".Auth::user()->secondName;
            $profile = Auth::user()->profile;
            $status = $profile->status ?? "";
           // $img = "/storage/{{ $profile->profile_image }}";
            $profile_image = "images/blank.png";
        @endphp
        <chat-window user="{{ $username  }}" status="{{ $status  }}" image="{{ $profile_image }}" ></chat-window>
    </div>
@endsection

