@extends('layouts.app')

@section('content')
<div class="login">
    <div class="back_cover">

        <div class="left_banner container">
            <h4>Logo Here</h4>
            <div class="auth_card border-top ">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col">
                            <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="password" class=" col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="w-100 col pl-2 pr-2">
                            <button type="submit" class="w-100 btn">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                    <div class="mt-4 form-group row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="col  btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                </form>
                <hr>
                <a class="col text-center btn-link" href={{ route('register') }}>
                    {{ __('Register new account?') }}
                </a>
            </div>
        </div>

        <div class="right_banner">
            <welcome></welcome>
        </div>
    </div>
</div>

@endsection
