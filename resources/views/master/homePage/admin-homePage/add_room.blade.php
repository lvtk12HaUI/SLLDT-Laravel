@extends('master.master-admin')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <div class="col-md-12">
                @if(session('notification'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('notification') }}</strong>
                    </div>
                @endif
                <div class="card card-block sameheight-item add-students">
                    <div class="title-block">
                        <h3 class="title"> THÊM PHÒNG HỌC </h3>
                    </div>
                    <form method="POST" action="{{ route('admin.handleAddRoom') }}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Tên phòng học</label>
                            <input name="room_name" type="text" class="form-control underlined" value="{{ old('room_name') }}">
                            @if($errors->has('room_name'))
                                <p class="text-danger">{{$errors->first('room_name')}}</p>
                            @endif
                            @if(session('notification'))
                                <p class="text-danger">{{ session('notification') }}</p>
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