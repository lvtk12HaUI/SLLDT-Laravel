@extends('master.master-student')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <div class="col-md-6 mx-auto mt-5">
            <div class="header-block">
                <h3 class="title text-center mt-4">THÔNG TIN CÁ NHÂN</h3>
            </div>
            <div class="header-block mt-5">
                <form method="POST" action="{{ route('student.handle_edit_personal_infoStudent',Session::get('username')) }}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Họ tên</label>
                        <input name="student_name" type="text" class="form-control" value="{{ $infoStudent['student_name'] }}" required>
                        @if($errors->has('student_name'))
					        <p class="text-danger">{{$errors->first('student_name')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ngày sinh</label>
                        <input name="birthday" type="date" class="form-control col-md-4 col-lg-4 col-xl-4" value="{{ $infoStudent['birthday'] }}" required>
                        @if($errors->has('birthday'))
					        <p class="text-danger">{{$errors->first('birthday')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Giới tính</label>
                        <div class="rows form-group">
                            <select name="gender" class="form-control col-md-4 col-lg-4 col-xl-4">
                                <option value="0" {{ $infoStudent['gender'] == 0 ? 'selected = selected' : '' }} >Nữ</option>
                                <option value="1" {{ $infoStudent['gender'] == 1 ? 'selected = selected' : '' }} >Nam</option>
                            </select>
                        </div>
                        @if($errors->has('gender'))
					        <p class="text-danger">{{$errors->first('gender')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Số điện thoại</label>
                        <input name="phone" type="text" class="form-control" value="{{ $infoStudent['phone'] }}" required>
                        @if($errors->has('phone'))
					        <p class="text-danger">{{$errors->first('phone')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input name="email" type="text" class="form-control" value="{{ $infoStudent['email'] }}" required>
                        @if($errors->has('email'))
					        <p class="text-danger">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Địa chỉ</label>
                        <input name="address" type="text" class="form-control" value="{{ $infoStudent['address'] }}" required>
                        @if($errors->has('address'))
					        <p class="text-danger">{{$errors->first('address')}}</p>
                        @endif
                    </div>
                    <div align='center'>
                        <button type="submit" class="btn btn-space btn-primary-1">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </article>
@endsection