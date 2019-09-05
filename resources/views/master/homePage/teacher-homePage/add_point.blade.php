@extends('master.master-teacher')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <div class="col-md-12">
                {{-- @if(session('notification'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ session('notification') }}</strong>
                    </div>
                @endif --}}
                <div class="card card-block sameheight-item add-students">
                    <div class="title-block">
                        <h3 class="title"> THÊM ĐIỂM CHO HỌC SINH </h3>
                    </div>
                <form method="POST" action="{{ route('teacher.handlePostAddPoint',$infoStudent['student_number']) }}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Mã học sinh: </label>
                            <span class="font-weight-bold">{{ $infoStudent['student_number'] }}</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Họ và tên: </label>
                            <span class="font-weight-bold">{{ $infoStudent['student_name'] }}</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Lớp: </label>
                            <span class="font-weight-bold">{{ $infoStudent['class_name'] }}</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Chọn loại điểm</label>
                            <div class="rows form-group">
                                <select name="type_of_point" class="form-control col-md-2 col-lg-2 col-xl-2">
                                    <option value="" >Loại điểm</option>
                                    @foreach($typeOfPoint as $key => $val)
                                        <option value="{{ $val['point_id'] }}" >{{ $val['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('type_of_point'))
					            <p class="text-danger">{{$errors->first('type_of_point')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nhập điểm</label>
                        <input name="point" type="text" class="form-control underlined" value="{{ old('point') }}">
                            @if($errors->has('point'))
					            <p class="text-danger">{{$errors->first('point')}}</p>
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