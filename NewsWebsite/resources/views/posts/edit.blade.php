@extends('layouts.admin')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
img {
    max-width: 300px;
    max-height: 170px;
}
</style>

</html>

<div id="content" class="container-fluid mt-4">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa bài viết
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none ;">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/posts/list')}}">Post</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="card-body" style="margin-left: 350px ;">
            <form method="POST" action="{{ route('posts.update',$post->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row mb-3">
                    <label for="title" class="col-md-2 col-form-label text-md-left"> Tiêu đề * </label>

                    <div class="col-md-4">
                        <input placeholder="Nhập tiêu đề bài viết" id="title" type="text"
                            class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{  $post->title  }}">

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex">
                    <label style="width:213px" for="categories_id" class=" col-form-label text-md-left"> Danh
                        mục *
                    </label>
                    <select class="form-control" style="width: 391px;" id="categories_id" name="categories_id">
                        <option value="{{  $post->categories_id  }}" selected>
                            {{  $post->categories->name  }}</option>
                        {!!$list_categories!!}
                    </select>
                </div>
                @error('categories_id')
                <span class="invalid-feedback" style="display:block ; margin-left :210px" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="form-group row">
                    <label for="post_time" class="col-md-2 col-form-label text-md-left"> Ngày đăng </label>

                    <div class="col-md-4">
                        <input value="{{$post->post_time}}" id="post_time" type="date" class="form-control"
                            name="post_time">

                    </div>
                </div>
                @error('post_time')
                <span class="invalid-feedback" style="display:block;margin-left :210px " role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="form-group row">
                    <label for="hot_flag" class="col-md-2 col-form-label text-md-left"> Trạng thái nổi bật * </label>
                    <div class="col-md-4">
                        <div class="block-text mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="0" {{ $post->hot_flag == 0 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b1" name="hot_flag">
                                <label class="custom-control-label font-weight-normal" for="radio-b1">Inactive</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="1" {{ $post->hot_flag == 1 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b2" name="hot_flag">
                                <label class="custom-control-label font-weight-normal" for="radio-b2">Active</label>
                            </div>
                        </div>

                        @error('hot_flag')
                        <span class="invalid-feedback" style="display:block ;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="photo" class="col-md-2 mb-3 col-form-label text-md-left"> Photo * </label>

                    <div class="col-md-4">
                        <input type="file" value="" name="photo" id="photo" onchange="ImagesFileAsURL()" />
                        <div id="displayImg" class="mt-2">
                            <img src="{{asset($post->photo)}}" alt="">
                        </div>
                    </div>
                    @error('photo')
                    <span class="invalid-feedback" style="display:block ;margin-left: 230px;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="content" class="col-md-3 col-form-label row text-md-left"> Nội
                        dung bài viết * </label>

                    <div class="col-md-8 mt-4">
                        <textarea name="content" id="content"
                            placeholder="Nội dung bài viết .................................">{!!$post->content!!}</textarea>
                    </div>
                    @error('content')
                    <span class="invalid-feedback mt-2" style="display:block ; margin-left : 320px" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
        </div>


        <div class="form-group d-flex" style="margin-left: 600px ;">
            <div class="">
                <button style="padding: 6px 12px;" type="submit" class="btn btn-primary">
                    Hoàn thành
                </button>
            </div>
            <div class="" style="margin-left: 80px;">
                <a href="{{ route('posts.list') }}" style="color:white" class="btn btn-secondary">
                    Danh sách
                </a>
            </div>
        </div>

        </form>
    </div>
</div>
</div>

<script src="https://cdn.tiny.cloud/1/jxxs51xd5e4bq2anprjymlu2r9frw2i0rdxu6r8m6v52ss6y/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
var editor_config = {
    path_absolute: "http://127.0.0.1:8000/",
    selector: 'textarea',
    height: 500,
    relative_urls: false,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback: function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
            'body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName(
            'body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url: cmsURL,
            title: 'Filemanager',
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no",
            onMessage: (api, message) => {
                callback(message.content);
            }
        });
    }
};

tinymce.init(editor_config);
</script>
<script type="text/javascript">
function ImagesFileAsURL() {
    var fileSelected = document.getElementById('photo').files;
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