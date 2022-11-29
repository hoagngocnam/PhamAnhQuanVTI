@extends('layouts.user')
@section('content')
<section class="login first grey" style="margin-top:-200px ;">
    <div class="container">
        <div class="box-wrapper">
            <div class="box box-border">
                <div class="box-body">
                    <h4>Đặt lại mật khẩu</h4>
                    @if (session('danger'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('danger') }}
                    </div>
                    @endif
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('reset.password.post') }}">
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
                            <label for="password-confirm">Mật Khẩu Confirm </label>
                            <div>
                                <input placeholder="Mật khẩu confirm " id="password-confirm" type="password"
                                    class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-block">Đặt lại mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection