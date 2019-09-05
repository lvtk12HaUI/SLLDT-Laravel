@extends('master.master-teacher')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <div class="col-md-6 mx-auto mt-5">
            <div class="header-block">
                <h3 class="title text-center mt-4">ĐỔI MẬT KHẨU</h3>
            </div>
            <div class="header-block mt-5">
                <form method="POST" action="{{ route('HandleChangePassword',Session::get('username')) }}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Mật khẩu hiện tại<span class="text-red">*</span></label>
                        <input name="pass" type="password" class="form-control" value="{{ old('pass') }}">
                        @if($errors->has('pass'))
					        <p class="text-danger">{{$errors->first('pass')}}</p>
                        @endif
                        @if(session('passNotFound'))
                            <p class="text-danger">{{ session('passNotFound') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mật khẩu mới<span class="text-red">*</span></label>
                        <input name="PassNew" type="password" class="form-control" value="{{ old('PassNew') }}">
                        @if($errors->has('PassNew'))
					        <p class="text-danger">{{$errors->first('PassNew')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Xác nhận mật khẩu mới<span class="text-red">*</span></label>
                        <input name="RetypePassNew" type="password" class="form-control" value="{{ old('RetypePassNew') }}">
                        @if($errors->has('RetypePassNew'))
					        <p class="text-danger">{{$errors->first('RetypePassNew')}}</p>
                        @endif
                        @if(session('notification'))
                            <p class="text-danger">{{ session('notification') }}</p>
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