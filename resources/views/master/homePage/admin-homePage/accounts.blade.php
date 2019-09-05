@extends('master.master-admin')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-12">
                    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                        <form action="" method="post">
                            <div class="card-header bordered">
                                <div class="header-block">
                                    <h3 class="title"> Danh sách thành viên </h3>
                                    <a href="{{ route('admin.addStudents') }}" class="btn btn-primary btn-sm"> Thêm </a>
                                </div>
                                <div class="header-block pull-right">
                                    <label class="search">
                                        <input class="search-input" name="search" placeholder="search...">
                                        <i class="fa fa-search search-icon"></i>
                                    </label>
                                    <div class="pagination">
                                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <ul class="item-list striped">
                            <li class="item item-list-header">
                                <div class="item-row">

                                    <div class="item-col item-col-header ">

                                        <span>STT</span>

                                    </div>

                                    <div class="item-col item-col-header ">

                                        <span>Mã học Sinh</span>

                                    </div>

                                    <div class="item-col item-col-header ">

                                        <span>Họ và tên</span>

                                    </div>

                                    <div class="item-col item-col-header">

                                        <span>Tên tài khoản</span>

                                    </div>
                                    <div class="item-col item-col-header ">

                                        <span>Mật khẩu</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Xoá</span>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection