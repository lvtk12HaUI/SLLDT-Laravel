<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <table>
        <tr>
            <td colspan="{{count($infoSubjects) + 6}}" style="background-color:#ffffff;"></td>
        </tr>
        <tr>
            <td colspan="{{count($infoSubjects) + 6}}" style="background-color:#ffffff;text-align: center;font-weight:bold;">Phòng GDĐT Hoài Đức</td>
        </tr>
        <tr>
            <td colspan="{{count($infoSubjects) + 6}}" style="background-color:#ffffff;text-align: center;font-weight:bold;">Trường THCS Cát Quế A</td>
        </tr>
        <tr>
            <td colspan="{{count($infoSubjects) + 6}}" style="background-color:#ffffff;"></td>
        </tr>
        <tr>
            <td colspan="{{count($infoSubjects) + 6}}" style="background-color:#ffffff;"></td>
        </tr>
        <tr>
            <td colspan="{{count($infoSubjects) + 6}}" style="color:#000000;font-size:20px;text-align: center;font-weight:bold">BẢNG ĐIỂM TỔNG KẾT LỚP {{ $infoClass->class_name }}</td>
        </tr>
        <tr>
            <td colspan="{{count($infoSubjects) + 6}}" style="background-color:#ffffff;"></td>
        </tr>
        <tr>
            <td colspan="{{count($infoSubjects) + 6}}" style="background-color:#ffffff;border-bottom:1px solid gray;"></td>
        </tr>
        <tr style="border-top:1px solid gray;">
            <th rowspan="2" style="color:#000000;width:5px;font-size:12px;text-align: center;font-weight:bold">STT</th>
            <th rowspan="2" style="color:#000000;width:25px;font-size:12px;text-align: center;font-weight:bold">Họ và tên</th>
            <th rowspan="2" style="color:#000000;width:15px;font-size:12px;text-align: center;font-weight:bold">Mã học sinh</th>
            <th colspan="{{count($infoSubjects)}}" style='color:#000000;width:12px;font-size:12px;text-align: center;font-weight:bold'>Điểm trung bình các môn</th>
            <th rowspan="2" style="color:#000000;width:10px;font-size:12px;text-align: center;font-weight:bold">TB môn</th>
            <th rowspan="2" style="color:#000000;width:10px;font-size:12px;text-align: center;font-weight:bold">Học lực</th>
            <th rowspan="2" style="color:#000000;width:12px;font-size:12px;text-align: center;font-weight:bold">Hạnh kiểm</th>
        </tr>
        <tr>
            @foreach ($infoSubjects as $key => $subject)
                <th style='color:#000000;width:12px;font-size:12px;text-align: center;font-weight:bold'>{{$subject->name}}</th>
            @endforeach
        </tr>
        @foreach ($infoPoint as $key => $val)
        <tr style="background:none;">
            <td style="color:#000000;width:5px;font-size:12px;text-align: center;font-weight:bold">{{ $key+1 }}</td>
            <td style="color:#000000;width:25px;font-size:12px;text-align: center;font-weight:bold">{{ $val->student_name }}</td>
            <td style="color:#000000;width:15px;font-size:12px;text-align: center;font-weight:bold">{{ $val->student_number }}</td>
            @foreach ($infoSubjects as $subject)
                @foreach ($val->pointAVG as $key2 => $val2)
                    @if($subject->name == $val2->subject)
                        <td style="color:#000000;width:12px;font-size:12px;text-align: center;font-weight:bold">{{ number_format($val2->point_avg,1) }}</td>
                    @endif
                @endforeach
            @endforeach
            <td style="color:#000000;width:10px;font-size:12px;text-align: center;font-weight:bold">{{ number_format($val->point_avg,1) }}</td>
            <td style="color:#000000;width:10px;font-size:12px;text-align: center;font-weight:bold">{{ $val->hocLuc }}</td>
            <td style="color:#000000;width:12px;font-size:12px;text-align: center;font-weight:bold">{{ $val->conduct }}</td>
        </tr>    
    @endforeach
    </table>
</body>
</html>