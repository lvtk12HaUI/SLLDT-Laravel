@extends('master.master-admin')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-12">
                    <table class='table table-simple account-management'>
                        <tr>
                            <td colspan='4' class=' text-center'><h3 class="font-weight-bold">THÔNG TIN GIÁO VIÊN</h3></td>
                        </tr>
                        <tr>
                            <td colspan='4' class='text-left font-weight-bold pdt-20'>1. Thông tin cơ bản</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-left pdt-20">Mã giáo viên: <b>{{ $infoTeacher['teacher_number'] }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-left pdt-10">Họ tên: <b>{{ $infoTeacher['teacher_name'] }}</b></td>
                        </tr>
                        <tr>
                            <?php
                                $date = $infoTeacher['birthday'];
                                $date = strtotime($date);
                                $date = date('d/m/Y',$date);
                            ?>
                            <td colspan="2" class="text-left pdt-10">Ngày sinh: <b><?= $date ?></b></td>
                            <td colspan="2" class="text-left pdt-10">Giới tính: <b>{{ $infoTeacher['gender']==1 ? 'Nam' : 'Nữ' }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-left pdt-10">Giáo viên môn: <b>{{ $infoTeacher['name'] }}</b></td>
                            <td colspan="2" class="text-left pdt-10">Chủ nhiệm lớp: <b>{{ $infoTeacher['class'] === null ? 'Không' : $infoTeacher['class'] }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-left pdt-10">Số điện thoại: <b>{{ $infoTeacher['phone'] }}</b></td>
                            <td colspan="2" class="text-left pdt-10">Email: <b>{{ $infoTeacher['email'] }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-left pdt-10">Địa chỉ: <b>{{ $infoTeacher['address'] }}</b></td>
                        </tr>
                        <tr>
                            <td colspan='4' class='text-left font-weight-bold pdt-20'>2. Lịch giảng dạy</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                @if(session('notification'))
                                    <div class="alert alert-success" role="alert" style="margin-top:20px;">
                                        <strong>{{ session('notification') }}</strong>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="pdt-20">
                                <table id="fromHTMLtestdiv" style="background-color:#78767600;" class="table sat-col sun-col text-center table-bordered">
                                    <thead class="font-size-18">
                                        <tr>
                                            <th class="text-center">BUỔI</th>
                                            <th class="text-center">TIẾT</th>
                                            @foreach($day as $key => $item)
                                                <th>{{ $item['day'] }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="font-size-14">
                                        @foreach($tiethoc as $key => $val)
                                            <tr style="height:30px;">
                                                @if($val['id']==1)
                                                    <td rowspan="5" class="font-weight-bold text-center font-size-20">SÁNG</td>
                                                @endif
                                                <td>{{ $val['id'] }}</td>
                                                @foreach($day as $key => $val2)
                                                    <td>
                                                        @foreach($InfoTkb as $key => $val3)
                                                             @if($val['id'] === $val3['tiethoc_id'] && $val2['id'] === $val3['weekdays_id'] )
                                                                <span><b>{{ $val3['class'] }}</b></span>
                                                             @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='4'><a href="{{ route('admin.add_TKB_teacher',$infoTeacher['teacher_number']) }}" class="btn btn-primary float-right">Thêm lịch giảng dạy</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </article>
@endsection