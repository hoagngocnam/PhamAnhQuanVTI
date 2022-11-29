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
            <h5 class="m-0 ">Danh sách danh mục</h5>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none ;">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/categories/list')}}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
        <div class="font-weight-bold ">
            <div class="form-search" style="width: 750px ; margin-left:450px;margin-bottom: 20px;position:relative ;">
                <form action="#">
                    <div class="form-group d-flex">
                        <label style="width:350px" for="name" class=" col-form-label text-md-left"> Tên danh mục
                        </label>
                        <input style="margin-right: 230px ;" placeholder="Nhập danh mục...." id="name" type="text"
                            class="form-control " name="infor" value="{{ request()->input('infor') }}">
                    </div>
                    <div class="form-group" style="position: absolute ; top: 134px">
                        <select class="form-control" style="width: 200px;" id="record" name="record">
                            <option disabled selected>-- Số lượng hiển thị --</option>
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary"
                        style="margin-left: 430px ;">
                </form>
            </div>
        </div>
        <div class="card-body">
            <form method="" action="{{ route('categories.add') }}">
                <input type="submit" name="" value="+ Thêm mới" class="btn btn-primary">
            </form>
            <table class="table table-striped table-checkall mt-3">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Bài viết</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $cat)
                    <tr>
                        <th scope="row">{{++$t}}</th>
                        <td>{{$cat->name}}</td>
                        <td>{{$cat->created_at->format('d/m/Y')}}</td>
                        <th scope="col"><a href="/admin/posts/list?categories_id={{$cat->id}}"> Bài viết</a>
                        </th>
                        <td>
                            <a href="{{route('categories.edit',$cat->id)}}"
                                class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                                data-placement="top" title="Edit">Sửa</a>

                            <a href="{{route('categories.delete',$cat->id)}}" data-id="{{$cat->id}}" data-redirect="0"
                                class="_delete_data btn btn-danger btn-sm rounded-0 text-white" type="button"
                                data-toggle="tooltip" data-placement="top" title="Delete">Xóa</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->withQueryString()->links() }}
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