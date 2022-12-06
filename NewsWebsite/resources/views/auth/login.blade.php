@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail ') }}</label>

                            <div class="col-md-6">
                                <input placeholder="Nhập địa chỉ mail" id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu</label>

                            <div class="col-md-6">
                                <input placeholder="Nhập mật khẩu" id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    style="position: relative;" autocomplete="new-password">
                                <i style="position: absolute ; right:45px; top:8px" class="bi bi-eye-slash"
                                    id="togglePassword"></i>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" id="role" value="3" placeholder="3" name="role">
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 mb-3 mt-2">
                                <button style="margin-left: 25px ;" type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a href="{{ route('register') }}"
                                    style="color:white; margin-left: 60px ; padding: 6px 18px" class="btn btn-danger">
                                    Đăng ký
                                </a>
                            </div>
                        </div>
                        @if (Route::has('password.request'))
                        <a style="margin-left: 330px ; color:grey" class="" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection