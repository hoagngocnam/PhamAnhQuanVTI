@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
        <p class="alert alert-success">{{session('status')}}</p>
        @endif
        @if (session('danger'))
        <p class="alert alert-danger">{{session('danger')}}</p>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
        </div>
        <div class="card-header font-weight-bold ">
            <div class="form-search" style="width: 750px ; margin-left:450px; margin-top:40px; margin-bottom: 20px">
                <form action="#">
                    <div class="form-group d-flex">
                        <label style="width:250px" for="email" class=" col-form-label text-md-left"> Địa chỉ mail
                        </label>
                        <input style="margin-right: 230px ;" placeholder="Nhập địa chỉ mail, Họ tên ...." id="email"
                            type="text" class="form-control " name="infor" value="{{ request()->input('infor') }}"
                            autocomplete="email">
                    </div>
                    <div class="form-group d-flex ">
                        <label for="sex" class=" text-md-left mt-2"> Giới tính </label>
                        <div class="">
                            <div class="block-text mt-2 ml-5 mb-2 ">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="0" {{ old('sex') == 0 ? '' : '' }}
                                        class="custom-control-input" id="radio-b1" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b1">Nam</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="1" {{ old('sex') == 1 ? '' : '' }}
                                        class="custom-control-input" id="radio-b2" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b2">Nữ</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="2" {{ old('sex') == 2 ? '' : '' }}
                                        class="custom-control-input" id="radio-b3" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b3">Khác</label>
                                </div>
                            </div>
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
                    @php
                    $t=0;
                    @endphp
                    @foreach ($users as $user)
                    @php
                    $t++;
                    @endphp
                    <tr>
                        <th scope="row">{{$t}}</th>
                        <td>{{$user->email}}</td>
                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                        <td>{{$userSex[$user->sex]}}</td>
                        @if(!isset($user->birthday))
                        <td>--/--/----</td>
                        @else
                        <td>{{$user->birthday}}</td>
                        @endif
                        <td>{{$user->address}}</td>
                        <td>{{$userRole[$user->role]}}</td>
                        <td>
                            <a href="{{route('admin.edit',$user->id)}}"
                                class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                                data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @if(Auth::id()!=$user->id)
                            <a href="{{route('admin.delete',$user->id)}}"
                                onclick="return confirm('Bạn có muốn xóa thành viên này ?')"
                                class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                                data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
            {{$users->links()}}
        </div>
    </div>
</div>

@endsection