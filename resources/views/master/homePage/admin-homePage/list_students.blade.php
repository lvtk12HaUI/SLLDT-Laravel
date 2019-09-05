@extends('master.master-admin')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-12">
                    @if(session('notification'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{ session('notification') }}</strong>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif
                    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                        <div class="card-header bordered">
                            <div class="header-block">
                                <h3 class="title"> Danh sách học sinh </h3>
                                <a href="{{ route('admin.add_students') }}" class="btn btn-primary btn-sm"> Thêm </a>
                            </div>
                            <div class="header-block pull-right">
                                <label class="search">
                                    <input type="text" class="search-input" id="search" placeholder="search..." value="{{ $keyword }}">
                                    <i class="fa fa-search search-icon"></i>
                                </label>
                                <div class="pagination">
                                    <button type="submit" class="btn btn-primary" id="btnSearch">Tìm kiếm</button>
                                </div>
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
                                    <div class="item-col item-col-header width-1">

                                        <span>Lớp</span>
    
                                    </div>
                                    <div class="item-col item-col-header">

                                            <span>Địa chỉ</span>
            
                                        </div>
                                    <div class="item-col item-col-header width-1">

                                            <span>Kết Quả</span>
            
                                    </div>
                                    <div class="item-col item-col-header width">

                                            <span>Xóa</span>
            
                                    </div>
                                </div>
                            </li>
                            {{-- view all info students --}}
                            @foreach($infoStudents as $key => $val)
                                <li class="item">
                                    <div class="item-row">

                                        <div class="item-col width">{{ $key + 1 }}</div>

                                        <div class="item-col width-2">{{ $val['student_number'] }}</div>

                                        <div class="item-col width-2"><a href="{{ route('admin.edit_infoStudents', $val['student_number']) }}" class="text-decoration-none">{{ $val['student_name'] }}</a></div>
                                        <?php
                                            $date = $val['birthday'];
                                            $date = strtotime($date);
                                            $date = date('d/m/Y',$date);
                                        ?>
                                        <div class="item-col width-2"><?= $date ?></div>

                                        <div class="item-col width-1">{{ $val['gender'] = ($val['gender']==1) ? 'Nam' : 'Nữ' }}</div>

                                        <div class="item-col width-1">{{ $val['class_name'] }}</div>

                                        <div class="item-col">{{ $val['address'] }}</div>

                                        <div class="item-col width-1"><a href="{{ route('admin.result_student',$val['student_number']) }}" class="btn btn-success-outline">Xem</a></div>

                                        <div class="item-col width"><a onclick="return del_student('{{ $val['student_name'] }}','{{ $val['student_number'] }}')" 
                                        href="{{ route('admin.handlePostDelInfoStudents', $val['student_number']) }}" class="btn btn-danger-outline">Xoá</a></div>

                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </article>
    @push('scripts')
        <script>
            function del_student(student_name,student_number){
                return confirm("Bạn muốn xóa học sinh tên "+ student_name +" với mã học sinh là "+ student_number );
            }

            $(function(){
                 $('#btnSearch').click(function(){
                     let keyword = $('#search').val().trim();
                     if(keyword.length > 0){
                         window.location.href = "{{ route('admin.list_students') }}" + "?keyword=" + keyword;
                     }
                 });
             });
        </script>
    @endpush
@endsection