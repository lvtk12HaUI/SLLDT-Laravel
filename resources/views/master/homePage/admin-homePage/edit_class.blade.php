@extends('master.master-admin')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <div class="col-md-12">
                <div class="card card-block sameheight-item add-students">
                    <div class="title-block">
                        <h3 class="title"> CHỈNH SỬA LỚP HỌC </h3>
                    </div>
                    <form method="POST" action="{{ route('admin.handleEditClass') }}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Tên lớp học</label>
                            <input name="class_name" type="text" class="form-control underlined" value="{{ $class->class_name }}">
                            <input name="id" type="hidden" class="form-control underlined" value="{{ $class->id }}">
                            @if($errors->has('class_name'))
                                <p class="text-danger">{{$errors->first('class_name')}}</p>
                            @endif
                            @if(session('notification'))
                                <p class="text-danger">{{ session('notification') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Chọn khối học</label>
                            <div class="rows form-group">
                                <select name="class_id" class="form-control col-md-2 col-lg-2 col-xl-2">
                                    <option value="" >Khối học</option>
                                    <option @if($class->class_id == 6) selected @endif value="6">6</option>
                                    <option @if($class->class_id == 7) selected @endif value="7">7</option>
                                    <option @if($class->class_id == 8) selected @endif value="8">8</option>
                                    <option @if($class->class_id == 9) selected @endif value="9">9</option>
                                </select>
                            </div>
                            @if($errors->has('class_id'))
                                <p class="text-danger">{{$errors->first('class_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-0">Phòng học hiện tại : {{ $class->room->name }}</label>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Phòng học còn trống</label>
                            <div class="rows form-group">
                                <select name="room_id" class="form-control col-md-2 col-lg-2 col-xl-2">
                                    <option value="" >Phòng học</option>
                                    @foreach($antiRoom as $key => $val)
                                    <option @if($class->room_id == $val['id']) selected @endif value="{{ $val['id'] }}" >{{ $val['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('room_id'))
                                <p class="text-danger">{{$errors->first('room_id')}}</p>
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