@extends('master.master-admin')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <div class="col-md-12">
                <div class="card card-block sameheight-item add-students">
                    <div class="title-block">
                        <h3 class="title"> SỬA THÔNG TIN HỌC SINH: {{ $infoStudent['student_name'] }} </h3>
                        <hr>
                    </div>
                    <form method="POST" action="{{ route('admin.handlePostEditInfoStudents',$infoStudent['student_number']) }}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Mã học sinh</label>
                            <input name="student_number" type="text" class="form-control underlined" value="{{ $infoStudent['student_number'] }}">
                            @if($errors->has('student_number'))
					            <p class="text-danger">{{$errors->first('student_number')}}</p>
                            @endif 
                            @if(session('notification'))
                                <p class="text-danger">{{ session('notification') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Họ và Tên</label>
                            <input name="student_name" type="text" class="form-control underlined" value="{{ $infoStudent['student_name'] }}">
                            @if($errors->has('student_name'))
					            <p class="text-danger">{{$errors->first('student_name')}}</p>
				            @endif 
                        </div>
                        <div class="form-group">
                                <label class="control-label">Ngày sinh</label>
                                <input name="birthday" type="date" class="form-control col-md-2 col-lg-2 col-xl-2" value="{{ $infoStudent['birthday'] }}">
                                @if($errors->has('birthday'))
                                    <p class="text-danger">{{$errors->first('birthday')}}</p>
                                @endif 
                            </div>
                        <div class="form-group">
                            <label class="control-label">Giới Tính</label>
                            <div class="rows form-group">
                                <select name="gender" class="form-control col-md-2 col-lg-2 col-xl-2">
                                    <option value="0" {{ $infoStudent['gender'] == 0 ? 'selected = selected' : '' }} >Nữ</option>
                                    <option value="1" {{ $infoStudent['gender'] == 1 ? 'selected = selected' : '' }} >Nam</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Lớp</label>
                            <div class="rows form-group">
                                <select name="class" class="form-control col-md-2 col-lg-2 col-xl-2">
                                    @foreach ($classes as $key => $item)
                                        <option value="{{ $item['id'] }}" {{ $infoStudent['class'] == $item['id'] ? 'selected =selected' : '' }}>{{ $item['class_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input name="email" type="text" class="form-control underlined" value="{{ $infoStudent['email'] }}">
                            @if($errors->has('email'))
					            <p class="text-danger">{{$errors->first('email')}}</p>
				            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Điện Thoại</label>
                            <input name="phone" type="text" class="form-control underlined" value="{{ $infoStudent['phone'] }}">
                            @if($errors->has('phone'))
					            <p class="text-danger">{{$errors->first('phone')}}</p>
				            @endif
                        </div> 
                        <div class="form-group">
                            <label class="control-label">Địa Chỉ</label>
                            <input name="address" type="text" class="form-control underlined" value="{{ $infoStudent['address'] }}">
                            @if($errors->has('address'))
					            <p class="text-danger">{{$errors->first('address')}}</p>
				            @endif 
                        </div> 
                        <div align='right'>
                            <button type="submit" class="btn btn-success">Sửa</button>
                        </div>
                    </form>
                </div>
            </div>
    </article>
@endsection