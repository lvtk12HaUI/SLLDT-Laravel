@extends('master.master-teacher')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <div class="col-md-6 mx-auto mt-5">
            <div class="header-block">
                <h3 class="title text-center mt-4">THÔNG TIN CÁ NHÂN</h3>
            </div>
            <div class="header-block mt-5">
                <form method="POST" action="{{ route('teacher.handle_edit_personal_infoTeacher',Session::get('username')) }}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Họ tên</label>
                        <input name="teacher_name" type="text" class="form-control" value="{{ $infoTeacher['teacher_name'] }}" required>
                        @if($errors->has('teacher_name'))
					        <p class="text-danger">{{$errors->first('teacher_name')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ngày sinh</label>
                        <input name="birthday" type="date" class="form-control col-md-4 col-lg-4 col-xl-4" value="{{ $infoTeacher['birthday'] }}" required>
                        @if($errors->has('birthday'))
					        <p class="text-danger">{{$errors->first('birthday')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Giới tính</label>
                        <div class="rows form-group">
                            <select name="gender" class="form-control col-md-4 col-lg-4 col-xl-4">
                                <option value="0" {{ $infoTeacher['gender'] == 0 ? 'selected = selected' : '' }} >Nữ</option>
                                <option value="1" {{ $infoTeacher['gender'] == 1 ? 'selected = selected' : '' }} >Nam</option>
                            </select>
                        </div>
                        @if($errors->has('gender'))
					        <p class="text-danger">{{$errors->first('gender')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Số điện thoại</label>
                        <input name="phone" type="text" class="form-control" value="{{ $infoTeacher['phone'] }}" required>
                        @if($errors->has('phone'))
					        <p class="text-danger">{{$errors->first('phone')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input name="email" type="text" class="form-control" value="{{ $infoTeacher['email'] }}" required>
                        @if($errors->has('email'))
					        <p class="text-danger">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Địa chỉ</label>
                        <input name="address" type="text" class="form-control" value="{{ $infoTeacher['address'] }}" required>
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