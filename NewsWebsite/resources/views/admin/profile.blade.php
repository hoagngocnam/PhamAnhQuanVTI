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
            Thông tin cá nhân
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none ;">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
        <div class="card-body" style="margin-left: 350px ;">
            <div class="form-group row mb-3">
                <label for="email" class="col-md-2 col-form-label text-md-left"> Địa chỉ mail </label>

                <div class="col-md-4">
                    <input placeholder="Nhập địa chỉ mail" id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $user->email }}" autocomplete="email" disabled>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="email" class="col-md-2 col-form-label text-md-left"> Họ và tên </label>

                <div class="col-md-4">
                    <input placeholder="Nhập địa chỉ mail" id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $user->first_name }} {{ $user->last_name }}" autocomplete="email" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="sex" class="col-md-2 col-form-label text-md-left"> Giới tính * </label>
                <div class="col-md-4">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                        name="first_name" value="{{$userSex[$user->sex]}}" autocomplete="first_name" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="birthday" class="col-md-2 col-form-label text-md-left"> Ngày sinh </label>

                <div class="col-md-4">
                    <input id="birthday" type="date" class="form-control" name="birthday" value="{{$user->birthday}}"
                        disabled>

                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-2 col-form-label text-md-left"> Địa chỉ </label>

                <div class="col-md-4">
                    <textarea disabled name="address" id="address" cols="41">{{$user->address }}</textarea>
                </div>

            </div>
            <div class="form-group row mb-4">
                <label for="avatar" class="col-md-2 mb-3 col-form-label text-md-left"> Avatar * </label>

                <div class="col-md-4">
                    <div id="displayImg" class="mt-2">
                        <img src="{{asset($user->avatar)}}" alt="">
                    </div>
                </div>
            </div>
            <div class="form-group d-flex" style="margin-left: 230px ;">
                <div class="" style="margin-left: 100px;">
                    <a href="{{ route('admin.edit',$user->id) }}" class="btn btn-primary">
                        Chỉnh sửa
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