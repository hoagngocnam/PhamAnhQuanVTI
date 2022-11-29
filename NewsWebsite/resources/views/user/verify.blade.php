@extends('layouts.user')
@section('content')
<section class="login first grey" style=" margin-top:-200px ;">
    <div class="container">
        <div class="box-wrapper">
            <div class="box box-border">
                <div class="box-body">
                    <h4>Quên mật khẩu</h4>
                    <form method="POST" action="{{ route('forget.password.post') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" class="form-control">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group ">
                            <button class="btn btn-primary btn-block">Gửi đường dẫn lấy lại mật khẩu</button>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{route('user.login')}}">Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection