@extends('master.master-teacher')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-12">
                    <table class='table table-simple account-management mt-50'>
                        <tr>
                            <td colspan='4' class=' text-center'><h3 class="font-weight-bold">THÔNG TIN CƠ BẢN</h3></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-left pdt-20 pdb-20">Mã giáo viên: <b>{{ $infoTeacher['teacher_number'] }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-left pdt-20 pdb-20">Họ tên: <b>{{ $infoTeacher['teacher_name'] }}</b></td>
                        </tr>
                        <tr>
                            <?php
                                $date = $infoTeacher['birthday'];
                                $date = strtotime($date);
                                $date = date('d/m/Y',$date);
                            ?>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Ngày sinh: <b><?= $date ?></b></td>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Giới tính: <b>{{ $infoTeacher['gender'] == 1 ? 'Nam' : 'Nữ'  }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Số điện thoại: <b>{{ $infoTeacher['phone']}}</b></td>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Email: <b>{{ $infoTeacher['email'] }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-left pdt-20">Địa chỉ: <b>{{ $infoTeacher['address'] }}</b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </article>
@endsection