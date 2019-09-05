@extends('master.master-teacher')
@section('title','Trường THCS Cát Quế A')
@section('content')
    <article class="content dashboard-page">
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-12">
                    <h3 class="text-center font-weight-bold">LỊCH GIẢNG DẠY</h3>
                    <table id="fromHTMLtestdiv" style="background-color:#78767600;" class="table sat-col sun-col text-center table-bordered mt-50">
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
                                                    <span><b>{{ $val3['class'] }} - {{ $val3['room_name'] }}</b></span>
                                                    @endif
                                            @endforeach
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </article>
@endsection