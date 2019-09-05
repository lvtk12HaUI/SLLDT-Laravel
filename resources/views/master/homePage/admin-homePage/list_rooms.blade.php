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
                                    <h3 class="title"> Danh sách phòng học </h3>
                                    <a href="{{ route('admin.add_room') }}" class="btn btn-primary btn-sm"> Thêm </a>
                                </div>
                            </div>
                        <ul class="item-list striped">
                            <li class="item item-list-header">
                                <div class="item-row">

                                    <div class="item-col item-col-header">

                                        <span>STT</span>

                                    </div>
                                    <div class="item-col item-col-header">

                                        <span>Tên phòng</span>

                                    </div>
                                    <div class="item-col item-col-header width">

                                        <span>Xóa</span>

                                    </div>
                                </div>
                            </li>
                            @foreach($listRooms as $key => $val)
                                <li class="item">
                                    <div class="item-row">

                                        <div class="item-col">{{ $key + 1 }}</div>

                                        <div class="item-col">{{ $val['name'] }}</div>
                                        
                                        <div class="item-col width"><a onclick="return del_rooms('{{ $val['name'] }}')" 
                                        href="{{ route('admin.handleDelRoom', $val['name']) }}" class="btn btn-danger-outline">Xoá</a></div>
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
            function del_rooms(room_name){
                return confirm("Bạn muốn xóa phòng học "+room_name);
            }
        </script>
    @endpush
@endsection