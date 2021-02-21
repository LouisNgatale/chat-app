@extends('layouts.app')

@section('content')
    <div class="chat-window">
        <chat-window user="{{ \Illuminate\Support\Facades\Auth::user()->name }}"></chat-window>
    </div>
@endsection
