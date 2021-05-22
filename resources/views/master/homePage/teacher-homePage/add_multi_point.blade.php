@extends('master.master-teacher')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-12">
                    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                        <div class="card-header bordered">
                            <div class="header-block">
                                <h3 class="title font-weight-bold">Lớp: {{ $class }}</h3>
                            </div>
                        </div>
                            <ul class="item-list striped">
                                <form method="POST" action="{{route('teacher.handlePostAddMultiPoint')}}">
                                    @csrf
                                    <li class="item item-list-header">
                                        <div class="item-row">

                                            <div class="item-col item-col-header width-2">

                                                <span>Chọn loại điểm</span>

                                            </div>
                                            <div class="item-col item-col-header">
                                                <select name="type_of_point" class="form-control col-md-4 col-lg-3 col-xl-3">
                                                    <option value="" >Loại điểm</option>
                                                    @foreach($typeOfPoint as $key => $val)
                                                        <option value="{{ $val['point_id'] }}" @if($val['point_id'] == old('type_of_point')) selected @endif >{{ $val['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('type_of_point'))
                                                    <span class="text-danger">{{$errors->first('type_of_point')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item item-list-header">
                                        <div class="item-row">

                                            <div class="item-col item-col-header">

                                                <span>STT</span>

                                            </div>
                                            <div class="item-col item-col-header">

                                                <span>Mã học Sinh</span>

                                            </div>
                                            <div class="item-col item-col-header">

                                                <span>Họ và tên</span>

                                            </div>
                                            <div class="item-col item-col-header">

                                                <span>Điểm</span>

                                            </div>
                                        </div>
                                    </li>
                                    {{-- view all info students by class --}}
                                    @foreach($listStudents as $key => $val)
                                        <li class="item" style="border-bottom: 1px solid #e9edf0;">
                                            <div class="item-row">

                                                <div class="item-col">{{ $key + 1 }}</div>

                                                <div class="item-col">{{ $val['student_number'] }}</div>

                                                <div class="item-col">{{ $val['student_name'] }}</div>

                                                <div class="item-col">
                                                    <input name="point[{{$key}}][point]" type="text" class="form-control underlined" value="{{ old('point.'.$key.'.point') }}">
                                                </div>
                                                @if($errors->has('point'))
                                                    <span class="text-danger">{{$errors->first('point')}}</span>
                                                @endif
                                                <input type="hidden" name="point[{{$key}}][student_number]" value="{{$val['student_number']}}"/>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="item">
                                        <div align='right' class="pt-3 pb-3 pr-3">
                                            <button type="submit" class="btn btn-success">Thêm</button>
                                        </div>
                                    </li>
                                </form>
                            </ul>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection