@extends('master.master-admin')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <div class="col-md-12">
                <div class="card card-block sameheight-item add-students">
                    <div class="title-block">
                        <h3 class="title"> THÊM GIÁO VIÊN </h3>
                        <hr>
                    </div>
                    <form method="POST" action="{{ route('admin.handlePostAddInfoTeachers') }}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Mã giáo viên</label>
                            <input name="teacher_number" type="text" class="form-control underlined" value="{{ old('teacher_number') }}">
                            @if($errors->has('teacher_number'))
					            <p class="text-danger">{{$errors->first('teacher_number')}}</p>
                            @endif
                            @if(session('notification'))
                                <p class="text-danger">{{ session('notification') }}</p>
                            @endif 
                        </div>
                        <div class="form-group">
                            <label class="control-label">Họ và Tên</label>
                            <input name="teacher_name" type="text" class="form-control underlined" value="{{ old('teacher_name') }}">
                            @if($errors->has('teacher_name'))
					            <p class="text-danger">{{$errors->first('teacher_name')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Ngày sinh</label>
                            <input name="birthday" type="date" class="form-control col-md-2 col-lg-2 col-xl-2" placeholder="dd/mm/yyyy" value="{{ old('birthday') }}"> 
                            @if($errors->has('birthday'))
					            <p class="text-danger">{{$errors->first('birthday')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Giới Tính</label>
                            <div class="rows form-group">
                                <select name="gender" class="form-control col-md-2 col-lg-2 col-xl-2">
                                    <option value="" selected="selected">Giới tính</option>
                                    <option value="0">Nữ</option>
                                    <option value="1">Nam</option>
                                </select>
                            </div>
                            @if($errors->has('gender'))
					            <p class="text-danger">{{$errors->first('gender')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Môn học</label>
                            <div class="rows form-group">
                                <select name="subject_number" class="form-control col-md-2 col-lg-2 col-xl-2">
                                    <option value="" selected="selected">Môn học</option>
                                    @foreach ($subjects as $key => $item)
                                        <option value="{{ $item['subject_number'] }}" >{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('subject_number'))
					            <p class="text-danger">{{$errors->first('subject_number')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <input name="is_gvcn" type="checkbox" class="is_gvcn"><label>Là giáo viên chủ nhiệm</label>
                            @if(session('classExists'))
                                <p class="text-danger">{{ session('classExists') }}</p>
                            @endif
                        </div>
                        <div class="form-group d-none" id="gvcn_of_class">
                            <label class="control-label">Chọn lớp học chủ nhiệm</label>
                            <div class="rows form-group">
                                <select name="class" class="form-control col-md-2 col-lg-2 col-xl-2">
                                <option value="" selected="selected">Lớp học</option>
                                    @foreach ($classes as $key => $item)
                                        <option value="{{ $item['class_name'] }}" >{{ $item['class_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input name="email" type="text" class="form-control underlined" value="{{ old('email') }}">
                            @if($errors->has('email'))
					            <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Điện Thoại</label>
                            <input name="phone" type="text" class="form-control underlined" value="{{ old('phone') }}">
                            @if($errors->has('phone'))
					            <p class="text-danger">{{$errors->first('phone')}}</p>
                            @endif
                        </div> 
                        <div class="form-group">
                            <label class="control-label">Địa Chỉ</label>
                            <input name="address" type="text" class="form-control underlined" value="{{ old('address') }}">
                            @if($errors->has('address'))
					            <p class="text-danger">{{$errors->first('address')}}</p>
                            @endif
                        </div> 
                        <div align='right'>
                            <button type="submit" class="btn btn-success">Thêm</button>
                            <button class="btn btn-primary" type="reset" >Nhập lại</button>
                        </div>
                    </form>
                </div>
            </div>
    </article>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function(){
                $('input[type="checkbox"]').click(function(){
                    if($(this).is(":checked")){
                        $("#gvcn_of_class").removeClass("d-none");
                    }
                    else if($(this).is(":not(:checked)")){
                        $("#gvcn_of_class").addClass("d-none");
                    }
                });
            });
        </script>
    @endpush
@endsection
