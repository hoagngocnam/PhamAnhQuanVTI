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
            <h5 class="m-0 ">Danh sách Comments</h5>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none ;">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/comments/list')}}">Comments</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
        <div class="font-weight-bold ">
            <form method="GET" action="#">
                <div class="form-search" style="width: 100% ; margin-left:200px; margin-bottom: 20px;position:relative">
                    <div class="d-flex">
                        <div>
                            <div class="form-group d-flex">
                                <div class="form-group d-flex">
                                    <label style="width:200px" for="user_name" class=" col-form-label text-md-left">
                                        Người
                                        comments
                                    </label>
                                    <input style="width: 350px ;" id="user_name" type="text" class="form-control "
                                        name="user_name" value="{{ request()->input('user_name') }}">
                                </div>
                            </div>
                            <div class="form-group d-flex ">
                                <label for="status" class=" text-md-left mt-2"> Trạng thái </label>
                                <div style="margin-left:50px ;" class="">
                                    <div class="block-text mt-2 ml-5 mb-2 ">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" value="0" {{ $status === 0 ? 'checked' : '' }}
                                                class="custom-control-input" id="radio-b1" name="status">
                                            <label class="custom-control-label font-weight-normal"
                                                for="radio-b1">Inactive</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" value="1" {{ $status === 1 ? 'checked' : '' }}
                                                class="custom-control-input" id="radio-b2" name="status">
                                            <label class="custom-control-label font-weight-normal"
                                                for="radio-b2">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-left :160px">
                            <div class="form-group d-flex">
                                <label style="width:140px" for="title" class=" col-form-label text-md-left"> Bài viết
                                </label>
                                <input style="width: 350px ;" placeholder="" id="title" type="text"
                                    class="form-control " name="title" value="{{ request()->input('title') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="position: absolute ; top: 160px;left:-120px">
                        <select class="form-control" style="width: 200px;" id="record" name="record">
                            <option disabled selected>-- Số lượng hiển thị --</option>
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary"
                        style="margin-left: 850px ; margin-top: -100px">
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall mt-3">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Người comments</th>
                        <th scope="col">Bài viết</th>
                        <th scope="col">Nôi dung comments</th>
                        <th scope="col">Thời gian viết</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Kích hoạt</th>
                        <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($comments->total()>0)
                    @foreach ($comments as $comment)
                    <tr>
                        <th scope="row">{{++$t}}</th>
                        <td>{{ $comment->user->first_name }} {{ $comment->user->last_name }}</td>
                        <td>{{ Str::limit($comment->posts->title, 100) }}</td>
                        <td>{{ Str::limit($comment->comment, 100) }}</td>
                        <td>{{$comment->created_at}}</td>
                        @if($comment->status == 0)
                        <td><i style="margin-left: 30px ;" class="fa-solid fa-x"></i></td>
                        @elseif($comment->status == 1)
                        <td><i style="margin-left: 30px ;" class="fa-solid fa-check"></i></td>
                        @endif
                        @if($comment->status == 0)
                        <td><a style="color:green" href="{{route('comment.edit',$comment->id)}}">Active</a></td>
                        @elseif($comment->status == 1)
                        <td></td>
                        @endif
                        <td><a style="color: red ;" href="{{route('comment.details',$comment->id)}}">Chi tiết</a></td>
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
            <a href="{{ route('comments.active') }}" style="margin-left:1480px;" class="btn btn-primary">Active All</a>
            {{ $comments->withQueryString()->links() }}
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