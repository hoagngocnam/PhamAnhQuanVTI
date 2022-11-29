@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid mt-4">
    <div class="card">
        <div class="card-header font-weight-bold">
            Nội dung bài viết
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none ;">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/posts/list')}}">Post</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
        <div class="card-body" style="margin-left: 300px ;">
            <div class="form-group row mb-3">
                <label style="font-size:22px ;" for="title" class="col-md-1"> Tiêu đề: </label>

                <div class="col-md-8">
                    <label style="font-size:22px ;" for="">{{  $post->title  }}</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="post_time" class="col-md-1 "> Ngày đăng </label>

                <div class="col-md-3">
                    <label for="post_time" class="col-md-8">{{date('d-m-Y', strtotime($post->post_time))}}
                    </label>

                </div>
            </div>
            @error('post_time')
            <span class="invalid-feedback" style="display:block;margin-left :210px " role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="form-group">
                <label for="content" class="col-md-3 col-form-label row text-md-left"> Nội
                    dung bài viết * </label>

                <div class="col-md-8 mt-4 ml-4">
                    {!!$post->content!!}
                </div>
            </div>
            <div class="form-group ">
                <label style="margin-left: 800px;margin-top:40px;font-weight: bold" for="">Tác giả :
                    {{ $post->user->first_name }}
                    {{ $post->user->last_name }} </label>
            </div>
        </div>
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