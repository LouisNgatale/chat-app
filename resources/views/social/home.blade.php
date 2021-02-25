@extends('layouts.app')

@section('content')
    <div class="container-fluid social">
        {{-- TopBar Component --}}
        <div class="row">
            <Navbar></Navbar>
        </div>

        <div class="row">
        {{-- Left Panel --}}
            <div id="left-panel" class="col-md-3 ">
                {{-- Profile Component --}}
                    <Profile></Profile>
            </div>

        {{-- Middle Panel --}}
            <div id="middle-panel" class="col-md-6">
                {{-- New Post Component --}}
                <div class="row">
                    <div class="col">
                        <Createpost class="mt-4"></Createpost>
                    </div>
                </div>
                {{-- Filter Components --}}

                {{-- Posts Component --}}
                <div class="row">
                    <div class="col">
                        <Posts class="w-100"></Posts>
                    </div>
                </div>
            </div>

        {{-- Right Panel --}}
            <div id="right-panel" class=" col-md-3">
                {{-- Trending Component --}}
                <div class="row">
                    <div class="col p-0 pr-3">
                        <Trending class="mt-4 mb-4"></Trending>
                        <Friends class="mb-4"></Friends>
                    </div>
                </div>
                {{-- Friends list Component --}}
            </div>
        </div>
    </div>
@endsection

