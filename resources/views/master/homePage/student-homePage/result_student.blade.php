@extends('master.master-student')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-12">
                    <table class='table table-simple account-management'>
                        <tr>
                            <td colspan='3' class='tdbold paddingbottom-0px text-left font-weight-bold'>Phòng GDĐT Hoài Đức</td>
                            <td class='tdbold paddingbottom-0px text-center text-right'></td>
                        </tr>
                        <tr>
                            <td colspan='3' class='tdbold paddingtop-0px text-left font-weight-bold'>Trường THCS Cát Quế A</td>
                            <td class='paddingtop-0px text-left'></td>
                        </tr>
                        <tr>
                            <td colspan='4' class='tdbold paddingbottom-0px text-center font-weight-bold'>KẾT QUẢ HỌC TẬP RÈN LUYỆN</td>
                        </tr>
                        <tr>
                        <td colspan='4' class='tdbold paddingtop-0px text-center font-weight-bold'>Lớp: {{ $infoStudent['class_name'] }}</td>     
                        </tr>
                        <tr>
                            <td colspan='4' class='text-left'>Học sinh: <b>{{ $infoStudent['student_name'] }}</b></td>                                   
                        </tr>
                        <tr>
                            <?php
                                $date = $infoStudent['birthday'];
                                $date = strtotime($date);
                                $date = date('d/m/Y',$date);
                            ?>
                            <td class='text-left'>Ngày sinh: <b><?= $date ?></b></td>
                            <td class='text-left'>Giới tính: <b>{{ $infoStudent['gender'] === 1 ? 'Nam' : 'Nữ' }}</b></td>
                            <td colspan="2" class='text-left'>Mã học sinh: <b>{{ $infoStudent['student_number'] }}</b></td>                                   
                        </tr>
                        <tr>
                            <td colspan='4' class='text-left font-weight-bold' style="padding-top: 20px;">1. Kết quả học tập</td>                                   
                        </tr>
                        <tr>
                            <td colspan='4' style="padding-top: 10px;">
                                <table style="background:none;" class='table table-bordered-outside table-simple table-striped custom'>
                                    <thead>
                                        <tr>
                                            <th style='width:5%; border: 1px solid;' class="text-center" >TT</th>
                                            <th style='border: 1px solid;' class="text-center">Môn học</th>
                                            <th style='border: 1px solid;' class="text-center">Điểm miệng</th>
                                            <th style='border: 1px solid;' class="text-center">Điểm kiểm tra HS I</th>
                                            <th style='border: 1px solid;' class="text-center">Điểm kiểm tra HS II</th>
                                            <th style='border: 1px solid;' class="text-center">HK</th>
                                            <th style='border: 1px solid;' class="text-center">TBM</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subjects as $key => $val)
                                        <tr style="background:none;">
                                            <td style='border: 1px solid;' class="text-center">{{ $key+1 }}</td>
                                            <td style='border: 1px solid;' class="pdl-10">{{ $val['name'] }}</td>
                                            @foreach($typeOfPoint as $key => $val2)
                                                <td style='border: 1px solid;'>
                                                    @foreach($point as $key => $val3)
                                                        @if($val['subject_number'] == $val3['subject_number'] && $val2['point_id'] == $val3['point_id'])
                                                            <span class="pdl-10">{{ $val3['point'] }}</span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @endforeach
                                            <td style='border: 1px solid;'>
                                                @foreach($pointAVG as $key => $val4)
                                                    @if($val['name'] == $val4['subject'])
                                                            <span class="pdl-10">{{ $val4['point_avg'] }}</span>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr style="background:none;" class="font-weight-bold">
                                            <td style='border: 1px solid;'  class="text-right pr-5" colspan="5">Điểm tổng kết</td>
                                            <td style='border: 1px solid;' class="text-left pl-5" colspan="2">{{ number_format($infoPoint->point_avg,1) }}</td>
                                        </tr>
                                        <tr style="background:none;" class="font-weight-bold">
                                            <td style='border: 1px solid;'  class="text-right pr-5" colspan="5">Học lực</td>
                                            <td style='border: 1px solid;' class="text-left pl-5" colspan="2">{{$infoPoint->hocLuc}}</td>
                                        </tr>
                                        <tr style="background:none;" class="font-weight-bold">
                                            <td style='border: 1px solid;' class="text-right pr-5" colspan="5">Hạnh kiểm</td>
                                            <td style='border: 1px solid;' class="text-left pl-5" colspan="2">{{$infoStudent['conduct']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </article>
@endsection