@extends('layouts.user')
@section('content')

<section class="login first grey" style=" margin-top:-200px ;">
    <div class="container">
        <div class="box-wrapper">
            <div class="box box-border">
                <div class="box-body">
                    <h4>Đăng ký</h4>
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email"> Địa chỉ mail * </label>
                            <div>
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
                        <div class="form-group d-flex ">
                            <div class="form-group ">
                                <label for="first_name" class=""> Họ * </label>

                                <div>
                                    <input maxlength="50" placeholder="Nhập họ" id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}">

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="last_name" class=""> Tên * </label>

                                <div class="">
                                    <input maxlength="50" placeholder="Nhập tên" id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="password"> Mật khẩu * </label>
                            <div>
                                <input placeholder="Nhập mật khẩu" id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Mật Khẩu Confirm *</label>
                            <div>
                                <input placeholder="Mật khẩu confirm " id="password-confirm" type="password"
                                    class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sex"> Giới tính * </label>
                            <div style="display:flex ;">
                                <div>
                                    <input type="radio" value="0" class="custom-control-input" id="radio-b1" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b1">Nam</label>
                                </div>
                                <div style="margin-left: 25px">
                                    <input type="radio" value="1" class="custom-control-input" id="radio-b2" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b2">Nữ</label>
                                </div>
                                <div style="margin-left: 25px">
                                    <input type="radio" value="2" class="custom-control-input" id="radio-b3" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b3">Khác</label>
                                </div>
                            </div>
                            @error('sex')
                            <span class="invalid-feedback" style="display:block ;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address"> Địa chỉ </label>
                            <div>
                                <textarea name="address" id="address" cols="39"
                                    placeholder=" Nhập địa chỉ...."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Đăng ký
                            </button>
                        </div>
                        <div class="form-group text-center">
                            <span class="text-muted">Bạn đã có tài khoản? </span> <a href="{{route('user.login')}}">
                                Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection