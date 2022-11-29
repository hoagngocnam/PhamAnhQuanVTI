@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid mt-4">
    <div class="card">
        @if (session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
        @endif
        @if (session('danger'))
        <div class="alert alert-danger">{{session('danger')}}</div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none ;">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/posts/list')}}">Post</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
        <div class="font-weight-bold ">
            <form method="GET" action="#">
                <div class="form-search"
                    style="width: 100% ; margin-left:200px;margin-bottom: 20px;position:relative ;">
                    <div class="d-flex">
                        <div>
                            <div class="form-group d-flex">
                                <label style="width:120px" for="categories_id" class=" col-form-label text-md-left">
                                    Danh
                                    mục
                                </label>
                                <select class="form-control" style="width: 215px;" id="categories_id"
                                    name="categories_id">
                                    <option value="0">--- Chọn danh mục ---</option>
                                    {!!$list_categories!!}
                                </select>
                            </div>
                            <div class="form-group d-flex ">
                                <label for="hot_flag" class=" text-md-left mt-2"> Nổi bật </label>
                                <div class="">
                                    <div class="block-text mt-2 ml-5 mb-2 ">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" value="0" {{ $hot_flag === 0 ? 'checked' : '' }}
                                                class="custom-control-input" id="radio-b1" name="hot_flag">
                                            <label class="custom-control-label font-weight-normal"
                                                for="radio-b1">Inactive</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" value="1" {{ $hot_flag === 1 ? 'checked' : '' }}
                                                class="custom-control-input" id="radio-b2" name="hot_flag">
                                            <label class="custom-control-label font-weight-normal"
                                                for="radio-b2">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-left :160px">
                            <div class="form-group d-flex">
                                <label style="width:140px" for="title" class=" col-form-label text-md-left"> Tiêu đề
                                </label>
                                <input style="width: 350px ;" placeholder="Nhập tiêu đề ...." id="title" type="text"
                                    class="form-control " name="title" value="{{ request()->input('title') }}">
                            </div>
                            <div class="form-group d-flex">
                                <label style="width:140px" for="user_name" class=" col-form-label text-md-left"> Tác giả
                                </label>
                                <input style="width: 350px ;" placeholder="Nhập tên tác giả ...." id="user_name"
                                    type="text" class="form-control " name="user_name"
                                    value="{{ request()->input('user_name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="position: absolute ; top: 220px">
                        <select class="form-control" style="width: 200px;" id="record" name="record">
                            <option disabled selected>-- Số lượng hiển thị --</option>
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary"
                        style="margin-left: 895px ; margin-top: 30px">
                </div>
            </form>
        </div>
        <div class="card-body">
            <form method="" action="{{ route('posts.add') }}">
                <input type="submit" name="" value="+ Thêm mới" class="btn btn-primary">
            </form>
            <table class="table table-striped table-checkall mt-3">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Lượt xem</th>
                        <th scope="col">Tác giả</th>
                        <th scope="col">Trạng thái nổi bật</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Thời gian viết</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($posts->total()>0)
                    @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{++$t}}</th>
                        <td>{{ Str::limit($post->title, 100) }}</td>
                        <td>{{$post->categories->name}}</td>
                        @if(!isset($post->view))
                        <td>/</td>
                        @else
                        <td>{{$post->view}}</td>
                        @endif
                        <td>{{ $post->user->last_name }}</td>
                        <td>{{$postStatus[$post->hot_flag]}}</td>
                        <td>{!! Str::limit($post->content, 100) !!} <a style="color: RoyalBlue ;"
                                href="{{ route('posts.details',$post->id) }}">Xem
                                thêm</a>
                        </td>
                        <td>{{$post->created_at->format('d/m/Y')}}</td>
                        <td>
                            <a href="{{route('posts.edit',$post->id)}}"
                                class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                                data-placement="top" title="Edit">Sửa</a>
                            <a href="{{route('posts.delete',$post->id)}}" data-id="{{$post->id}}" data-redirect="0"
                                class="_delete_data btn btn-danger btn-sm rounded-0 text-white" type="button"
                                data-toggle="tooltip" data-placement="top" title="Delete">Xóa</a>
                        </td>

                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8" class="bg-white text-dark">
                            Không tìm thấy bản ghi nào !
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{ $posts->withQueryString()->links() }}
        </div>
    </div>
</div>
<script>
setTimeout(function() {
    $(".alert").remove();
}, 5000); // 5 secs
</script>
<script>
$(document).ready(function() {
    console.log(123);
    $('._delete_data').click(function(e) {
        if (e.target.dataset.redirect == 0) {
            e.preventDefault();
            var data_id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                if (result.value) {
                    e.target.dataset.redirect = 1;
                    e.target.click();
                }
            })
        }

    });
});
</script>
@endsection