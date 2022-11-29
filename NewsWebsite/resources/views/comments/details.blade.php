@extends('layouts.admin')
@section('content')
<style>
th {
    width: 250px;
}
</style>
@if (session('danger'))
<div class="alert alert-danger">{{session('danger')}}</div>
@endif
<div id="content" class="container-fluid mt-4">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chi tiết comments
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none ;">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/comments/list')}}">Comments</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
        <div class="card-body">
            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>Bài viết</th>
                        <td>{{$comment->posts->title}}</td>
                    </tr>
                    <tr>
                        <th>Người comments</th>
                        <td>{{$comment->user->first_name}} {{$comment->user->last_name}}</td>
                    </tr>
                    <tr>
                        <th>Nội dung</th>
                        <td>{{$comment->comment}}</td>
                    </tr>
                </thead>
            </table>
            @if($comment->status == 0)
            <a href="{{ route('comment.edit',$comment->id) }}" class="btn btn-success">Active</a>
            @elseif($comment->status == 1)
            <a style="margin-left:0px;" href="{{ route('comment.edit',$comment->id) }}" class="btn btn-info">Inctive</a>
            @endif
            <a style="margin-left:1300px;" href="{{ route('comment.delete',$comment->id) }}"
                class="btn btn-danger">Delete</a>

        </div>
    </div>
</div>
</div>
<script>
setTimeout(function() {
    $(".alert").remove();
}, 5000);
</script>
@endsection('content')