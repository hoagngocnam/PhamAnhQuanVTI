@extends('layouts.app')

@section('content')
<h2 style="text-align: center">Quản trị viên</h2> 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div style="text-align: center" class="card-header">{{ __('Register') }}</div>

                <div class="card-body" style="margin-left: 35px">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-left"> Địa chỉ mail * </label>

                            <div class="col-md-8">
                                <input placeholder="Nhập địa chỉ mail" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex mb-1 ">
                        
                        <div class="form-group row">
                            <label for="first_name" class="col-md-3 col-form-label text-md-left"> Họ * </label>

                            <div class="col-md-6" style="margin-left: 91px;">
                                <input placeholder="Nhập họ" id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" style="margin-left: 8px ;">
                            <label for="last_name" class="col-md-3 col-form-label text-md-left"> Tên * </label>

                            <div class="col-md-8">
                                <input placeholder="Nhập tên" id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-left"> Mật khẩu * </label>

                            <div class="col-md-8">
                                <input placeholder="Nhập mật khẩu" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-left">Mật Khẩu Confirm *</label>

                            <div class="col-md-8">
                                <input placeholder="Mật khẩu confirm " id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthday" class="col-md-3 col-form-label text-md-left"> Ngày sinh * </label>

                            <div class="row" style="margin-left: 1px;">
                                <div class="col-4 pr-lg-3 pr-md-3 pr-1">
                                <select class="form-control hy-dropdown rounded-0" name="day">
                                        <option {{ old('day') ? '' : 'selected' }} disabled value="">Ngày </option>
                                        <?php
                                        $d = 1;
                                        ?>
                                        @while($d<=31)
                                            <option value="{{$d}}" @if(old('day')==$d) {{'selected'}} @endif>{{$d}} 
                                            </option>
                                            @php $d++; @endphp
                                        @endwhile
                                    </select>
                                </div>
                                <div class="col-4 pr-lg-3 pr-md-3 pr-1 pl-lg-3 pl-md-3 pl-1">
                                    <select class="form-control hy-dropdown rounded-0" name="month" style="    margin-right: 31px;">
                                        <option {{ old('month') ? '' : 'selected' }} disabled value="">Tháng</option>
                                        <?php
                                        $m = 1;
                                        ?>
                                        @while($m<=12)
                                            <option value="{{$m}}" @if(old('month')==$m) {{'selected'}} @endif>{{$m}}
                                            </option>
                                            @php $m++; @endphp
                                        @endwhile
                                    </select>
                                </div>
                                <div class="col-4 pl-lg-3 pl-md-3 pl-1">                                
                                    <select class="form-control hy-dropdown rounded-0 " name="year">
                                        <option {{ old('year') ? '' : 'selected' }} disabled value="">Năm</option>
                                        <?php
                                        $y = 1946;
                                        $year = Carbon\Carbon::now()->year - 18;
                                        ?>
                                        @while($y<=$year)
                                            <option
                                                value="{{$y}}" @if(old('year')==$y) {{'selected'}} @endif>{{$y == 1946 ? '1946' : $y}}</option>
                                            @php $y++; @endphp
                                        @endwhile
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    @if($errors->has('year'))
                                        <div class="d-flex mt-2">
                                            <em class="hy-icon hy-icon-security proper proper-taller"></em>
                                            <span class="noti-text ml-1">{{$errors->first('year')}}</span>
                                        </div>
                                    @endif
                                    @if($errors->has('month'))
                                        <div class="d-flex mt-2">
                                            <em class="hy-icon hy-icon-security proper proper-taller"></em>
                                            <span class="noti-text ml-1">{{$errors->first('month')}}</span>
                                        </div>
                                    @endif
                                    @if($errors->has('day'))
                                        <div class="d-flex mt-2">
                                            <em class="hy-icon hy-icon-security proper proper-taller"></em>
                                            <span class="noti-text ml-1">{{$errors->first('day')}}</span>
                                        </div>
                                    @endif
                                    @if($errors->has('date_of_birth'))
                                        <div class="d-flex mt-2">
                                            <em class="hy-icon hy-icon-security proper proper-taller"></em>
                                            <span class="noti-text ml-1">{{$errors->first('date_of_birth')}}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="sex" class="col-md-3 col-form-label text-md-left"> Giới tính * </label>

                            <div class="col-md-8">
                            <div class="block-text mt-2">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="0" {{ old('sex') == 0 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b1" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b1">Nam</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="1" {{ old('sex') == 1 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b2" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b2">Nữ</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="2" {{ old('sex') == 2 ? 'checked' : '' }}
                                    class="custom-control-input" id="radio-b3" name="sex">
                                    <label class="custom-control-label font-weight-normal" for="radio-b3">Khác</label>
                                </div>
                            </div>

                                @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>


                        <div class="form-group row">
                            <label for="address" class="col-md-3 col-form-label text-md-left"> Địa chỉ </label>

                            <div class="col-md-8">
                                <textarea name="address" id="address" cols="51" placeholder="Nhập địa chỉ" >
                                </textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0 d-flex" style="margin-left: 300px ;">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                Đăng ký
                                </button>
                            </div>
                            <div class="" style="margin-left: 80px;">
                                <button type="submit" class="btn btn-secondary">
                                Đăng nhập
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
