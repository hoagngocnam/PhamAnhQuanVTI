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
            <h5 class="m-0 ">Danh sách dannh mục</h5>
        </div>
        <div class="card-header font-weight-bold ">
            <div class="form-search" style="width: 750px ; margin-left:450px; margin-top:40px; margin-bottom: 20px">
                <form action="#">
                    <div class="form-group d-flex">
                        <label style="width:350px" for="name" class=" col-form-label text-md-left"> Tên danh mục
                        </label>
                        <input style="margin-right: 230px ;" placeholder="Nhập danh mục...." id="name" type="text"
                            class="form-control " name="infor" value="{{ request()->input('infor') }}">
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
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $t=0;
                    @endphp
                    @foreach ($categories as $cat)
                    @php
                    $t++;
                    @endphp
                    <tr>
                        <th scope="row">{{$t}}</th>
                        <td>{{$cat->name}}</td>
                        <td>{{$cat->created_at}}</td>
                        <td>
                            <a href="{{route('categories.edit',$cat->id)}}"
                                class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                                data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

                            <a href="{{route('categories.delete',$cat->id)}}"
                                onclick="return confirm('Bạn có muốn xóa danh mục này ?')"
                                class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip"
                                data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$categories->links()}}
        </div>
    </div>
</div>

@endsection