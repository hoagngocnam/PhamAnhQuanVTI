@extends('layouts.user')
@section('content')
<section class="login first grey" style=" margin-top:-200px ;">
    <div class="container">
        <div class="box-wrapper">
            <div class="box box-border">
                <div class="box-body">
                    <h4>{{ __('Login') }}</h4>
                    <form method="POST" action="{{ route('user.storee') }}">
                        @csrf
                        @if (session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                        @endif
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail ') }}</label>
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
                        <div class="form-group">
                            <div class="form-group ">
                                <label for="password" class="fw">Mật khẩu
                                    <a style="font-size:14px ;margin-left:160px" href="{{route('forget.password.get')}}"
                                        class="pull-right">Quên
                                        mật khẩu?</a>
                                </label>
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
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>
                        <div class="form-group text-center">
                            <span class="text-muted">Bạn chưa có tài khoản? </span> <a
                                href="{{route('user.register')}}">Đăng ký </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
setTimeout(function() {
    $(".alert").remove();
}, 5000); // 5 secs
</script>
@endsection