@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid mt-4">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa danh mục
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none ;">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/categories/edit')}}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="card-body" style="margin-left: 350px ;">
            <form method="POST" action="{{ route('categories.update',$categories->id) }}">
                @csrf

                <div class="form-group row mb-3">
                    <label for="email" class="col-md-2 col-form-label text-md-left"> Sửa Danh mục </label>
                    <div class="col-md-5">
                        <input placeholder="Nhập danh mục" id=" " type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{$categories->name }}">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="form-group d-flex" style="margin-left: 600px ;">
            <div class="">
                <button style="padding: 6px 12px;" type="submit" class="btn btn-primary">
                    Hoàn thành
                </button>
            </div>
            <div class="" style="margin-left: 80px;">
                <a href="{{ route('admin.list') }}" style="color:white" class="btn btn-secondary">
                    Danh sách
                </a>
            </div>
        </div>

        </form>
    </div>
</div>
</div>

@endsection('content')