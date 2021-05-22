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
                                <form method="POST" action="{{route('teacher.handleAddMultiConduct')}}">
                                    @csrf
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

                                                <span>Hạnh kiểm</span>

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
                                                    <select name="conduct[{{$key}}][conduct]" class="form-control col-md-8 col-lg-8 col-xl-8">
                                                        <option value="">Hạnh kiểm</option>
                                                        <option @if($val['conduct'] === "Tốt") selected @endif value="Tốt"> Tốt</option>
                                                        <option @if($val['conduct'] === "Khá") selected @endif value="Khá">Khá</option>
                                                        <option @if($val['conduct'] === "Trung bình") selected @endif value="Trung bình">Trung bình</option>
                                                        <option @if($val['conduct'] === "Yếu") selected @endif value="Yếu">Yếu</option>
                                                        <option @if($val['conduct'] === "Kém") selected @endif value="Kém">Kém</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="conduct[{{$key}}][student_number]" value="{{$val['student_number']}}"/>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="item">
                                        <div align='right' class="pt-3 pb-3 pr-3">
                                            <button type="submit" class="btn btn-success">Chỉnh sửa</button>
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