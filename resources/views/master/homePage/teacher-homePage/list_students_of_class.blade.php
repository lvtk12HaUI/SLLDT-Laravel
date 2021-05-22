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
                                <h3 class="title font-weight-bold">Lớp: {{ $class->class_name }}</h3>
                                <a href="{{ route('teacher.studentsExport', $class->id) }}" class="btn btn-primary btn-sm"> Xuất file excel danh sách học sinh </a>
                            </div>
                        </div>
                        <ul class="item-list striped">
                            <li class="item item-list-header">
                                <div class="item-row">

                                    <div class="item-col item-col-header width">

                                        <span>STT</span>

                                    </div>
                                    <div class="item-col item-col-header width-2">

                                        <span>Mã học Sinh</span>

                                    </div>
                                    <div class="item-col item-col-header width-2">

                                        <span>Họ và tên</span>

                                    </div>
                                    <div class="item-col item-col-header width-2">

                                        <span>Ngày Sinh</span>

                                    </div>
                                    <div class="item-col item-col-header width-1">

                                        <span>Giới Tính</span>

                                    </div>
                                    <div class="item-col item-col-header width-2">

                                        <span>Số điện thoại</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                            <span>Địa chỉ</span>
            
                                    </div>
                                    <div class="item-col item-col-header width-1">

                                            <span>Kết Quả</span>
            
                                    </div>
                                </div>
                            </li>
                            {{-- view all info students by class --}}
                            @foreach($listStudents as $key => $val)
                                <li class="item">
                                    <div class="item-row">

                                        <div class="item-col width">{{ $key + 1 }}</div>

                                        <div class="item-col width-2">{{ $val['student_number'] }}</div>

                                        <div class="item-col width-2">{{ $val['student_name'] }}</div>
                                        <?php
                                            $date = $val['birthday'];
                                            $date = strtotime($date);
                                            $date = date('d/m/Y',$date);
                                        ?>
                                        <div class="item-col width-2"><?= $date ?></div>

                                        <div class="item-col width-1">{{ $val['gender'] = ($val['gender']==1) ? 'Nam' : 'Nữ' }}</div>

                                        <div class="item-col width-2">{{ $val['phone'] }}</div>

                                        <div class="item-col">{{ $val['address'] }}</div>

                                        <div class="item-col width-1"><a href="{{ route('teacher.result_student',$val['student_number']) }}" class="btn btn-success-outline">Xem</a></div>

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