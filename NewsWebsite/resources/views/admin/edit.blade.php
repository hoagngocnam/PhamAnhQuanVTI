@extends('layouts.admin')
@section('content')
<style>
img {
    max-width: 300px;
    max-height: 170px;
}
</style>
<div id="content" class="container-fluid mt-4">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa thông tin người dùng
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none ;">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/list')}}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="card-body" style="margin-left: 350px ;">
            <form method="POST" action="{{ route('admin.update',$user->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row mb-3">
                    <label for="email" class="col-md-2 col-form-label text-md-left"> Địa chỉ mail * </label>

                    <div class="col-md-4">
                        <input placeholder="Nhập địa chỉ mail" id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $user->email }}" autocomplete="email" disabled>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group d-flex mb-1 ">

                    <div class="form-group row">
                        <label for="first_name" class="col-md-2 col-form-label text-md-left"> Họ * </label>

                        <div class="col-md-5" style="margin-left: 138px;">
                            <input maxlength="50" placeholder="Nhập họ" id="first_name" type="text"
                                class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                value="{{ $user->first_name }}" autocomplete="first_name" autofocus>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row" style="margin-left: -60px;">
                        <label for="last_name" class="col-md-3 col-form-label text-md-left"> Tên * </label>

                        <div class="col-md-6">
                            <input maxlength="50" placeholder="Nhập tên" id="last_name" type="text"
                                class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                value="{{ $user->last_name }}" autocomplete="last_name" autofocus>

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-2 col-form-label text-md-left"> Mật khẩu * </label>

                    <div class="col-md-4">
                        <input placeholder="Nhập mật khẩu" id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            autocomplete="new-password" style="position: relative ;">
                        <i style=" position: absolute ; right:50px; top:8px" class="bi bi-eye-slash"
                            id="togglePassword"></i>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-2 col-form-label text-md-left">Mật Khẩu Confirm
                        *</label>

                    <div class="col-md-4">
                        <input placeholder="Mật khẩu confirm " id="password-confirm" type="password"
                            class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sex" class="col-md-2 col-form-label text-md-left"> Giới tính * </label>
                    <div class="col-md-4">
                        <div class="block-text mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="0" {{ $user->sex  == 0 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b1" name="sex">
                                <label class="custom-control-label font-weight-normal" for="radio-b1">Nam</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="1" {{ $user->sex  == 1 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b2" name="sex">
                                <label class="custom-control-label font-weight-normal" for="radio-b2">Nữ</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="2" {{ $user->sex  == 2 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b3" name="sex">
                                <label class="custom-control-label font-weight-normal" for="radio-b3">Khác</label>
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
                    <label for="birthday" class="col-md-2 col-form-label text-md-left"> Ngày sinh </label>

                    <div class="col-md-4">
                        <input id="birthday" type="date" class="form-control" name="birthday"
                            value="{{$user->birthday}}">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-2 col-form-label text-md-left"> Địa chỉ </label>

                    <div class="col-md-4">
                        <textarea name="address" id="address" cols="41">{{$user->address }}</textarea>
                    </div>

                </div>
                @if($user_role['role'] == 3)
                <div class="form-group row">
                    <label for="role" class="col-md-2 col-form-label text-md-left"> Vai trò * </label>
                    <div class="col-md-4">
                        <div class="block-text mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="3" {{ $user->role==3 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b4" name="role">
                                <label class="custom-control-label  font-weight-normal" for="radio-b4">Manager</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="1" {{ $user->role == 1 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b5" name="role">
                                <label class="custom-control-label font-weight-normal" for="radio-b5">Admin</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="2" {{ $user->role == 2 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b6" name="role">
                                <label class="custom-control-label font-weight-normal" for="radio-b6">User</label>
                            </div>
                        </div>

                        @error('role')
                        <span class="invalid-feedback" style="display:block ;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @endif
                @if($user_role['role'] == 2)
                <div class="form-group row">
                    <label for="role" class="col-md-2 col-form-label text-md-left"> Vai trò * </label>
                    <div class="col-md-4">
                        <div class="block-text mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input disabled type="radio" value="3" {{ $user->role==3 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b4" name="role">
                                <label class="custom-control-label  font-weight-normal" for="radio-b4">Manager</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input disabled type="radio" value="1" {{ $user->role == 1 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b5" name="role">
                                <label class="custom-control-label font-weight-normal" for="radio-b5">Admin</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input disabled type="radio" value="2" {{ $user->role == 2 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b6" name="role">
                                <label class="custom-control-label font-weight-normal" for="radio-b6">User</label>
                            </div>
                        </div>

                        @error('role')
                        <span class="invalid-feedback" style="display:block ;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @endif
                @if($user_role['role'] == 1)
                <div class="form-group row">
                    <label for="role" class="col-md-2 col-form-label text-md-left"> Vai trò * </label>
                    <div class="col-md-4">
                        <div class="block-text mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input disabled type="radio" value="3" {{ $user->role==3 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b4" name="role">
                                <label class="custom-control-label  font-weight-normal" for="radio-b4">Manager</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="1" {{ $user->role == 1 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b5" name="role">
                                <label class="custom-control-label font-weight-normal" for="radio-b5">Admin</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="2" {{ $user->role == 2 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b6" name="role">
                                <label class="custom-control-label font-weight-normal" for="radio-b6">User</label>
                            </div>
                        </div>

                        @error('role')
                        <span class="invalid-feedback" style="display:block ;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @endif

                <div class="form-group row mb-4">
                    <label for="avatar" class="col-md-2 mb-3 col-form-label text-md-left"> Avatar * </label>

                    <div class="col-md-4">
                        <input type="file" value="{{$user->avatar}}" name="avatar" id="avatar"
                            onchange="ImagesFileAsURL()" />
                        <div id="displayImg" class="mt-2">
                            <img src="{{asset($user->avatar)}}" alt="">
                        </div>
                    </div>
                    @error('avatar')
                    <span class="invalid-feedback" style="display:block ;margin-left: 230px;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group d-flex" style="margin-left: 230px ;">
                    <div class="">
                        <button style="padding: 6px 12px;" type="submit" class="btn btn-primary">
                            Hoàn thành
                        </button>
                    </div>
                    <div class="" style="margin-left: 80px;">
                        <a href="{{ route('admin.list') }}" style="color:white" class="btn btn-secondary">
                            Danh sách
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
function ImagesFileAsURL() {
    var fileSelected = document.getElementById('avatar').files;
    if (fileSelected.length > 0) {
        var fileToLoad = fileSelected[0];
        var fileReader = new FileReader();
        fileReader.onload = function(fileLoaderEvent) {
            var srcData = fileLoaderEvent.target.result;
            var newImage = document.createElement('img');
            newImage.src = srcData;
            document.getElementById('displayImg').innerHTML = newImage.outerHTML;
        }
        fileReader.readAsDataURL(fileToLoad);
    }
}
</script>
@endsection('content')