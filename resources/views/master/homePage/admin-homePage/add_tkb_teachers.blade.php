@extends('master.master-admin')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <div class="col-md-12">
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                <div class="card card-block sameheight-item add-students">
                    <div class="title-block">
                        <h3 class="title"> THÊM LỊCH GIẢNG DẠY </h3>
                        <hr>
                    </div>
                    <form method="POST" action="{{ route('admin.handle_add_TKB_teacher',$infoTeacher['teacher_number']) }}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Mã giáo viên: </label>
                            <span class="font-weight-bold">{{ $infoTeacher['teacher_number'] }}</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tên giáo viên: </label>
                            <span class="font-weight-bold">{{ $infoTeacher['teacher_name'] }}</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Giáo viên môn:  </label>
                            <span class="font-weight-bold">{{ $infoTeacher['name'] }}</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Lớp giảng dạy</label>
                            <div class="rows form-group">
                                <select name="class" class="form-control col-md-2 col-lg-2 col-xl-2">
                                <option value="" selected="selected">Lớp học</option>
                                    @foreach ($classes as $key => $item)
                                        <option value="{{ $item['class_name'] }}" >{{ $item['class_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('class'))
					            <p class="text-danger">{{$errors->first('class')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Thứ trong tuần</label>
                            <div class="rows form-group">
                                <select name="weekdays" class="form-control col-md-2 col-lg-2 col-xl-2">
                                <option value="" >Thứ trong tuần</option>
                                    @foreach ($weekdays as $key => $item)
                                        <option value="{{ $item['id'] }}">{{ $item['day'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('weekdays'))
					            <p class="text-danger">{{$errors->first('weekdays')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tiết học</label>
                            <div class="rows form-group">
                                <select name="tiethoc" class="form-control col-md-2 col-lg-2 col-xl-2">
                                <option value="" selected="selected">Tiết học</option>
                                    @foreach ($tiethoc as $key => $item)
                                        <option value="{{ $item['id'] }}" >{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('tiethoc'))
					            <p class="text-danger">{{$errors->first('tiethoc')}}</p>
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
@endsection
