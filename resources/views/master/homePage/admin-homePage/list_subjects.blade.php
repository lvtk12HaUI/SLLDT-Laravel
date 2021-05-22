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
                    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                            <div class="card-header bordered">
                                <div class="header-block">
                                    <h3 class="title"> Danh sách môn học </h3>
                                    <a href="{{ route('admin.add_subject') }}" class="btn btn-primary btn-sm"> Thêm </a>
                                </div>
                            </div>
                        <ul class="item-list striped">
                            <li class="item item-list-header">
                                <div class="item-row">

                                    <div class="item-col item-col-header">

                                        <span>STT</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Mã môn học</span>

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
                                    <div class="item-col item-col-header">

                                        <span>Xoá</span>
    
                                    </div>
                                </div>
                            </li>
                            @foreach($subjects as $key => $val)
                            <li class="item">
                                <div class="item-row">
                                    <div class="item-col">{{ $key+1 }}</div>
                                    <div class="item-col">{{ $val['subject_number'] }}</div>
                                    <div class="item-col"><a href="{{ route('admin.edit_subject', $val['id']) }}" class="text-decoration-none">{{ $val['name'] }}</a></div>
                                    <div class="item-col">@if($val['lop_6'] == 6) <i class="fas fa-check"></i> @endif</div>
                                    <div class="item-col">@if($val['lop_7'] == 7) <i class="fas fa-check"></i> @endif</div>
                                    <div class="item-col">@if($val['lop_8'] == 8) <i class="fas fa-check"></i> @endif</div>
                                    <div class="item-col">@if($val['lop_9'] == 9) <i class="fas fa-check"></i> @endif</div>
                                    <div class="item-col">
                                        <a onclick="return del_subejct('{{ $val['name'] }}')" href="{{ route('admin.handleDelSubject', $val['subject_number']) }}" class="btn btn-danger-outline">Xoá</a>
                                    </div>
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
    <script type="text/javascript">
        function del_subejct(name){
            return confirm("Bạn muốn xóa môn học: "+name);
        }
    </script>
@endpush
@endsection