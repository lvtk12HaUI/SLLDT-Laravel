@extends('master.master-student')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-12">
                    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                        <div class="card-header bordered">
                            <div class="header-block">
                                <h3 class="title"> Danh sách giáo viên </h3>
                            </div>
                        </div>
                        <ul class="item-list striped">
                            <li class="item item-list-header">
                                <div class="item-row">

                                    <div class="item-col item-col-header">

                                        <span>STT</span>

                                    </div>

                                    <div class="item-col item-col-header">

                                        <span>Họ và Tên</span>

                                    </div>

                                    <div class="item-col item-col-header ">

                                        <span>Môn học</span>

                                    </div>


                                    <div class="item-col item-col-header ">

                                        <span>Giới Tính</span>

                                    </div>

                                    <div class="item-col item-col-header">

                                        <span>Điện thoại</span>

                                    </div>

                                </div>
                            </li>
                            @foreach ($infoTeachers as $key => $val)
                            <li class="item">
                                <div class="item-row">
                                    <div class="item-col">{{ $key + 1 }}  
                                        @if($val['is_gvcn'] == 1 && $val['class'] == $class )
                                            <span class="btn btn-success font-size-14" style="max-height:30px;margin-left:100px;">Chủ nhiệm</span>
                                        @endif
                                    </div>

                                    <div class="item-col">{{ $val['teacher_name'] }}</div>

                                    <div class="item-col">{{ $val['name'] }}</div>

                                    <div class="item-col">{{ $val['gender'] = ($val['gender']==1) ? 'Nam' : 'Nữ' }}</div>

                                    <div class="item-col">{{ $val['phone'] }}</div>

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