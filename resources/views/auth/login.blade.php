@extends('layouts.app')

@section('content')
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-login">
                <div class="card-header">
                    <h1 class="title">{{ __('Login') }}</h1>
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <h5 class="alert-danger">{{ $error }}</h5>
                        @endforeach
                    @endif
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input type="email" class="hawkeye-form @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" class="hawkeye-form @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  id="exampleInputPassword1" placeholder="Password">
                                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-hawkeye-add">{{ __('Login') }}</button>
                                <a class="btn btn-hawkeye" href="{{ route('register') }}">Register</a>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
