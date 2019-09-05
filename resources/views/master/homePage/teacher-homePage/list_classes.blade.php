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
                                <h3 class="title"> Danh sách lớp giảng dạy  </h3>
                            </div>
                        </div>
                        <ul class="item-list striped">
                            <li class="item item-list-header">
                                <div class="item-row">

                                    <div class="item-col item-col-header">

                                        <span>STT</span>

                                    </div>

                                    <div class="item-col item-col-header">

                                        <span>Tên lớp</span>

                                    </div>

                                    <div class="item-col item-col-header">

                                        <span>Phòng học</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Danh sách học sinh</span>

                                    </div>
                                    <div class="item-col item-col-header width-2">

                                        <span>Thời khóa biểu</span>

                                    </div>
                                </div>
                            </li>
                            @foreach($infoClass as $key => $item)
                            <li class="item">
                                <div class="item-row">
                                    <div class="item-col">{{ $key + 1 }}</div>

                                    <div class="item-col">{{ $item['class_name'] }}</div>

                                    <div class="item-col">{{ $item['room_name'] }}</div>

                                <div class="item-col"><a href="{{ route('teacher.listStudentsOfClass',$item['class_name']) }}" class="btn btn-success-outline">Xem</a></div>

                                    <div class="item-col width-2"><a href="{{ route('teacher.tkb_of_class',$item['class_name']) }}" class="btn btn-success-outline">Xem</a></div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection