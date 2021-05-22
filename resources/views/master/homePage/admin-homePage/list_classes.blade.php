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
                                <h3 class="title"> Danh sách lớp học </h3>
                                <a href="{{ route('admin.add_class') }}" class="btn btn-primary btn-sm"> Thêm </a>
                            </div>
                        </div>
                        <ul class="item-list striped">
                            <li class="item item-list-header">
                                <div class="item-row">

                                    <div class="item-col item-col-header">

                                        <span>STT</span>

                                    </div>

                                    <div class="item-col item-col-header">

                                        <span>Tên lớp</span>

                                    </div>

                                    <div class="item-col item-col-header">

                                        <span>Phòng học</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Danh sách học sinh</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Thời khóa biểu</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Bảng điểm tổng kết</span>

                                    </div>
                                    {{-- <div class="item-col item-col-header width">

                                            <span>Xóa</span>
            
                                    </div> --}}
                                </div>
                            </li>
                            @foreach($infoClasses as $key => $item)
                            <li class="item">
                                <div class="item-row">
                                    <div class="item-col">{{ $key + 1 }}</div>

                                    <div class="item-col"><a href="{{ route('admin.edit_class',$item['id']) }}" class="text-decoration-none">{{ $item['class_name'] }}</a></div>

                                    <div class="item-col">{{ $item['room_name'] }}</div>

                                    <div class="item-col"><a href="{{ route('admin.listStudentsOfClass',$item['id']) }}" class="btn btn-success-outline">Xem</a></div>

                                    <div class="item-col"><a href="{{ route('admin.tkb_of_class',$item['class_name']) }}" class="btn btn-success-outline">Xem</a></div>

                                    <div class="item-col"><a href="{{ route('admin.result_summary',$item['id']) }}" class="btn btn-success-outline">Xem</a></div>

                                    {{-- <div class="item-col width"><a onclick="return del_class('{{ $item['class_name'] }}')" href="{{ route('admin.handleDelClass',$item['id']) }}" class="btn btn-danger-outline">Xóa</a></div> --}}
                                    
                                </div>
                            </li>
                            @endforeach
                    </div>
                </div>
            </div>
        </section>
    </article>
    @push('scripts')
        <script type="text/javascript">
            function del_class(class_name){
                return confirm("Bạn muốn xóa lớp học "+class_name);
            }
        </script>
    @endpush
@endsection