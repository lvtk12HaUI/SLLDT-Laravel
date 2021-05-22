@extends('master.master-admin')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <div class="col-md-12">
                <div class="card card-block sameheight-item add-students">
                    <div class="title-block">
                        <h3 class="title"> THÊM MÔN HỌC </h3>
                    </div>
                    <form method="POST" action="{{ route('admin.handleAddSubject') }}">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <label class="control-label">Mã môn học</label>
                                <input name="subject_number" type="text" class="form-control underlined" value="{{ old('subject_number') }}" required>
                                @if(session('notification'))
                                    <p class="text-danger">{{session('notification')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tên môn học</label>
                                <input name="subject_name" type="text" class="form-control underlined" value="{{ old('subject_name') }}" required>
                            </div>
                            <label class="control-label">Chọn lớp học</label>
                            <div class="form-group">
                                <input name="lop_6" type="checkbox" value="6" class="is_gvcn"><label>Lớp 6</label>
                            </div>
                            <div class="form-group">
                                <input name="lop_7" type="checkbox" value="7" class="is_gvcn"><label>Lớp 7</label>
                            </div>
                            <div class="form-group">
                                <input name="lop_8" type="checkbox" value="8" class="is_gvcn"><label>Lớp 8</label>
                            </div>
                            <div class="form-group">
                                <input name="lop_9" type="checkbox" value="9" class="is_gvcn"><label>Lớp 9</label>
                            </div>
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