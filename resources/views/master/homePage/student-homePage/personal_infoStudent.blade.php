@extends('master.master-student')
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
                            <td colspan="4" class="text-left pdt-20 pdb-20">Mã học sinh: <b>{{ $infoStudent['student_number'] }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-left pdt-20 pdb-20">Họ tên: <b>{{ $infoStudent['student_name'] }}</b></td>
                        </tr>
                        <tr>
                            <?php
                                $date = $infoStudent['birthday'];
                                $date = strtotime($date);
                                $date = date('d/m/Y',$date);
                            ?>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Ngày sinh: <b><?= $date ?></b></td>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Giới tính: <b>{{ $infoStudent['gender'] == 1 ? 'Nam' : 'Nữ'  }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Số điện thoại: <b>{{ $infoStudent['phone']}}</b></td>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Email: <b>{{ $infoStudent['email'] }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-left pdt-20">Địa chỉ: <b>{{ $infoStudent['address'] }}</b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </article>
@endsection