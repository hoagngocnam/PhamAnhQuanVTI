@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js">
</script>
<div id="content" class="container-fluid mt-4">
    <div class="card">
        @if (session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
        @endif
        @if (session('danger'))
        <div class="alert alert-danger">{{session('danger')}}</div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none ;">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/user')}}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
        <div class=" font-weight-bold ">
            <div class="form-search" style="width: 750px ; margin-left:450px; margin-bottom: 20px">
                <form action="#">
                    <div class="form-group d-flex">
                        <label style="width:250px" for="email" class=" col-form-label text-md-left"> Địa chỉ mail
                        </label>
                        <input style="margin-right: 230px ;" placeholder="Nhập địa chỉ mail ...." id="email" type="text"
                            class="form-control " name="infor" value="{{ request()->input('infor') }}"
                            autocomplete="email">
                    </div>
                    <div class="form-group d-flex " style="position:relative ;">
                        <label for="sex" class=" text-md-left mt-2"> Giới tính </label>
                        <div class="">
                            <div class="block-text mt-2 ml-5 mb-2 ">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="0" {{ $sex === 0 ? 'checked' : '' }}
                                        class="custom-control-input" id="radio-b1" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b1">Nam</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="1" {{ $sex === 1 ? 'checked' : '' }}
                                        class="custom-control-input" id="radio-b2" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b2">Nữ</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="2" {{ $sex === 2 ? 'checked' : '' }}
                                        class="custom-control-input" id="radio-b3" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b3">Khác</label>
                                </div>
                            </div>
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
                    </div>
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary"
                        style="margin-left: 430px ;">
                </form>
            </div>
        </div>
        <div class="card-body">
            <form method="" action="{{ route('admin.add') }}">
                <input type="submit" name="" value="+ Thêm mới" class="btn btn-primary">
            </form>
            <table class="table table-striped table-checkall mt-3">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Email</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->total()>0)
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{++$t}}</th>
                        <td>{{$user->email}}</td>
                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                        <td>{{$userSex[$user->sex]}}</td>
                        @if(!isset($user->birthday))
                        <td>--/--/----</td>
                        @else
                        <td>{{date('d-m-Y', strtotime($user->birthday))}}</td>
                        @endif
                        <td>{{$user->address}}</td>
                        <td>{{$userRole[$user->role]}}</td>
                        <td>
                            <a href="{{route('admin.edit',$user->id)}}"
                                class=" btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                                data-placement="top" title="Edit">Sửa</a>
                            @if(Auth::id()!=$user->id)
                            <a data-id="{{$user->id}}" href="{{route('admin.delete',$user->id)}}" data-redirect="0"
                                class="_delete_data btn btn-danger btn-sm rounded-0 text-white" type="button"
                                data-toggle="tooltip" data-placement="top" title="Delete">Xóa
                            </a>
                            @endif
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
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
</div>
<script>
setTimeout(function() {
    $(".alert").remove();
}, 5000);
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