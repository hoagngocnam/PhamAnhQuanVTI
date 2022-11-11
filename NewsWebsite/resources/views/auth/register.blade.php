@extends('layouts.app')

@section('content')
<h2 style="text-align: center">Quản trị viên</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div style="text-align: center" class="card-header">{{ __('Register') }}</div>

                <div class="card-body" style="margin-left: 35px">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-left"> Địa chỉ mail * </label>

                            <div class="col-md-8">
                                <input placeholder="Nhập địa chỉ mail" id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex mb-1 ">

                            <div class="form-group row">
                                <label for="first_name" class="col-md-3 col-form-label text-md-left"> Họ * </label>

                                <div class="col-md-6" style="margin-left: 91px;">
                                    <input placeholder="Nhập họ" id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}" autocomplete="first_name" autofocus>

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="margin-left: 8px ;">
                                <label for="last_name" class="col-md-3 col-form-label text-md-left"> Tên * </label>

                                <div class="col-md-8">
                                    <input placeholder="Nhập tên" id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" autocomplete="last_name" autofocus>

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-left"> Mật khẩu * </label>

                            <div class="col-md-8">
                                <input placeholder="Nhập mật khẩu" id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-left">Mật Khẩu Confirm
                                *</label>

                            <div class="col-md-8">
                                <input placeholder="Mật khẩu confirm " id="password-confirm" type="password"
                                    class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sex" class="col-md-3 col-form-label text-md-left"> Giới tính * </label>
                            <div class="col-md-8">
                                <div class="block-text mt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="0" {{ old('sex') == 0 ? '' : '' }}
                                            class="custom-control-input" id="radio-b1" name="sex">
                                        <label class="custom-control-label font-weight-normal"
                                            for="radio-b1">Nam</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="1" {{ old('sex') == 1 ? '' : '' }}
                                            class="custom-control-input" id="radio-b2" name="sex">
                                        <label class="custom-control-label font-weight-normal" for="radio-b2">Nữ</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="2" {{ old('sex') == 2 ? '' : '' }}
                                            class="custom-control-input" id="radio-b3" name="sex">
                                        <label class="custom-control-label font-weight-normal"
                                            for="radio-b3">Khác</label>
                                    </div>
                                </div>

                                @error('sex')
                                <span class="invalid-feedback" style="display:block ;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="address" class="col-md-3 col-form-label text-md-left"> Địa chỉ </label>

                            <div class="col-md-8">
                                <textarea name="address" id="address" cols="51"
                                    placeholder=" Nhập địa chỉ...."></textarea>
                            </div>

                        </div>

                        <div class="form-group mb-0 d-flex" style="margin-left: 300px ;">
                            <div class="">
                                <button style="padding: 6px 18px;" type="submit" class="btn btn-primary">
                                    Đăng ký
                                </button>
                            </div>
                            <div class="" style="margin-left: 80px;">
                                <a href="{{ route('login') }}" style="color:white" class="btn btn-secondary">
                                    Đăng nhập
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection