@extends('master.master-admin')
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
                            <td colspan='4' class='tdbold paddingbottom-0px text-center font-weight-bold'>BẢNG ĐIỂM TỔNG KẾT LỚP {{ $infoClass->class_name }}</td>
                        </tr>
                        <tr>
                            <td colspan='4' style="padding-top: 50px;">
                                <table style="background:none;" class='table table-bordered-outside table-simple table-striped custom'>
                                    <thead>
                                        <tr style="vertical-align: none;">
                                            <th rowspan="2" style='width:4%; border: 1px solid;' class="text-center" >STT</th>
                                            <th rowspan="2" style='border: 1px solid;' class="text-center">Họ và tên</th>
                                            <th rowspan="2" style='border: 1px solid;width:8%' class="text-center">Mã học sinh</th>
                                            <th colspan="{{count($infoSubjects)}}" style='border: 1px solid;' class="text-center">Điểm trung bình các môn</th>
                                            <th rowspan="2" style='border: 1px solid;width:5%;' class="text-center">TB môn</th>
                                            <th rowspan="2" style='border: 1px solid;width:5%;' class="text-center">Học lực</th>
                                            <th rowspan="2" style='border: 1px solid;width:5%;' class="text-center">Hạnh kiểm</th>    
                                        </tr>
                                        <tr>
                                            @foreach ($infoSubjects as $key => $subject)
                                                <th style='border: 1px solid;width:5%;' class="text-center">{{$subject->name}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($infoPoint as $key => $val)
                                            <tr style="background:none;">
                                                <td style='border: 1px solid;' class="text-center">{{ $key+1 }}</td>
                                                <td style='border: 1px solid;' class="text-center">{{ $val->student_name }}</td>
                                                <td style='border: 1px solid;' class="text-center">{{ $val->student_number }}</td>
                                                @foreach ($infoSubjects as $subject)
                                                    @foreach ($val->pointAVG as $key2 => $val2)
                                                        @if($subject->name == $val2->subject)
                                                            <td style='border: 1px solid;' class="text-center">{{ number_format($val2->point_avg,1) }}</td>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                <td style='border: 1px solid;' class="text-center">{{ number_format($val->point_avg,1) }}</td>
                                                <td style='border: 1px solid;' class="text-center">{{ $val->hocLuc }}</td>
                                                <td style='border: 1px solid;' class="text-center">{{ $val->conduct }}</td>
                                            </tr>    
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.resultSummaryExport', $infoClass->id) }}" class="btn btn-primary btn-sm"> Xuất file excel </a>
                </div>
            </div>
        </section>
    </article>
@endsection