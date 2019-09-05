@extends('master.master-admin')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-12">
                    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                            <div class="card-header bordered">
                                <div class="header-block">
                                    <h3 class="title"> Danh sách môn học </h3>
                                </div>
                            </div>
                        <ul class="item-list striped">
                            <li class="item item-list-header">
                                <div class="item-row">

                                    <div class="item-col item-col-header">

                                        <span>STT</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Môn học</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Lớp 6</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Lớp 7</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Lớp 8</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Lớp 9</span>
    
                                    </div>
                                </div>
                            </li>
                            @foreach($subjects as $key => $val)
                            <li class="item">
                                <div class="item-row">
                                    <div class="item-col">{{ $key+1 }}</div>
                                    <div class="item-col">{{ $val['name'] }}</div>
                                    <div class="item-col">@if($val['lop_6'] == 6) <i class="fas fa-check"></i> @endif</div>
                                    <div class="item-col">@if($val['lop_7'] == 7) <i class="fas fa-check"></i> @endif</div>
                                    <div class="item-col">@if($val['lop_8'] == 8) <i class="fas fa-check"></i> @endif</div>
                                    <div class="item-col">@if($val['lop_9'] == 9) <i class="fas fa-check"></i> @endif</div>
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