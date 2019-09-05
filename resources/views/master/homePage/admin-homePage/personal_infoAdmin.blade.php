@extends('master.master-admin')
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
                            <td colspan="4" class="text-left pdt-20 pdb-20">Họ tên: <b>{{ $name }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Ngày sinh:</td>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Giới tính:</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Số điện thoại:</td>
                            <td colspan="2" class="text-left pdt-20 pdb-20">Email:</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-left pdt-20">Địa chỉ:</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </article>
@endsection