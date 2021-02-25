@extends('layouts.app')

@section('content')
    <div class="profile_finish">

        <div class="w-75 container-fluid">
            <div class="container">
                    <div class="row pt-5 align-items-center">
                        <div class="col-md-3 col-4 p-lg-5 p-md-3 mr-0 container-fluid">
                            <img class="rounded-circle w-100 img-fluid" src="/images/blank.png" alt="">
                        </div>

                        <div class="col-md-9 col-8  p-3 pl-0 align-items-end">
                            <div class="">
                                <div class="">
                                    <span class="my-2">{{ \Illuminate\Support\Facades\Auth::user()->firstName }}  {{ \Illuminate\Support\Facades\Auth::user()->secondName }}</span>
                                </div>
                                <div class="">
                                    <span class="my-2">{{ \Illuminate\Support\Facades\Auth::user()->email }}</span>
                                </div>
                                <div class="">
                                    <div class="">
                                        <label for="image" class="@error('profile_pic') is-invalid @enderror  btn button">
                                            Choose profile picture
                                        </label>
                                        @error('profile_pic')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="container-fluid justify-content-center">
                <h5>Profile</h5>
                <hr class="border-white">

                <div class="row justify-content-center">

                    <form class="w-75" action="{{ route('create-profile') }}" enctype="multipart/form-data" method="POST">
                        @csrf

                        <input class="file" id="image" name="profile_pic" type="file" />

                        <div class="form-group col-auto">
                            <input class="@error('status') is-invalid @enderror status form-control" value="{{ old('status') }}" name="status" type="text" placeholder="Status">
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-auto">
                            <textarea class="@error('bio') is-invalid @enderror bio form-control" name="bio" id="bio" cols="30" rows="5" placeholder="Bio"></textarea>
                            @error('bio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class=" col-sm-6">
                            <label for="date"  class="">Birthday</label>
                            <input  type="date"  id="date" value="{{ old('birthday') }}" name="birthday"  class="@error('birthday') is-invalid @enderror form-control datepicker" >
                            @error('birthday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-4 col-sm-6">
                            @php
                                $countries = Countries::getList('en');
                            @endphp
                            <select name="country" class="@error('country') is-invalid @enderror form-group countries custom-select">
                                <option  disabled>Choose your country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <button class="btn button btn-primary" type="submit">Create Profile</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
