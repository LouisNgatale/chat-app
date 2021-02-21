@extends('layouts.app')

@section('content')
<div class="register">
    <div class="back_cover">
        <div class="left_banner container">
            <div class="auth_card border-top ">
                <h4>Create new account</h4>
                <div class="pl-3 pr-3 pt-2">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <div class="">
                                <input id="name" type="text" placeholder="First name" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                                @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="">
                                <input id="secondName" placeholder="Second Name" type="text" class="form-control @error('secondName') is-invalid @enderror" name="secondName" value="{{ old('secondName') }}" required autocomplete="secondName" autofocus>

                                @error('secondName')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="">
                                <label for="email"></label><input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="">
                                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="">
                                <input  placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="w-100 col pl-2 pr-2">
                                <button type="submit" class="w-100 btn">
                                    {{ __('Continue') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr>
                    <a class="col text-center btn-link" href="{{ route('login') }}">
                        {{ __('Already have an account? Login') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="right_banner">
            <welcome></welcome>
        </div>
    </div>
</div>
@endsection
