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
            <td colspan="10" style="background-color:#ffffff;"></td>
        </tr>
        <tr>
            <td colspan="10" style="background-color:#ffffff;"></td>
        </tr>
        <tr>
            <td colspan="10" style="background-color:#ffffff;"></td>
        </tr>
        <tr>
            <td colspan="10" style="color:#000000;font-size:20px;text-align: center;font-weight:bold">DANH SÁCH GIÁO VIÊN</td>
        </tr>
        <tr>
            <td colspan="10" style="background-color:#ffffff;"></td>
        </tr>
        <tr>
            <td colspan="10" style="background-color:#ffffff;"></td>
        </tr>
        <tr>
            <td colspan="10" style="background-color:#ffffff;border-bottom:1px solid gray;"></td>
        </tr>
        <tr>
            <td style="color:#000000;width:5px;font-size:12px;text-align: center;font-weight:bold">STT</td>
            <td style="color:#000000;width:15px;font-size:12px;text-align: center;font-weight:bold">MÃ GIÁO VIÊN</td>
            <td style="color:#000000;width:15px;font-size:12px;text-align: center;font-weight:bold">HỌ VÀ TÊN</td>
            <td style="color:#000000;width:20px;font-size:12px;text-align: center;font-weight:bold">MÔN HỌC</td>
            <td style="color:#000000;width:20px;font-size:12px;text-align: center;font-weight:bold">LỚP GIẢNG DẠY</td>
            <td style="color:#000000;width:20px;font-size:12px;text-align: center;font-weight:bold">NGÀY SINH</td>
            <td style="color:#000000;width:15px;font-size:12px;text-align: center;font-weight:bold">GIỚI TÍNH</td>
            <td style="color:#000000;width:13px;font-size:12px;text-align: center;font-weight:bold">ĐIỆN THOẠI</td>
            <td style="color:#000000;width:13px;font-size:12px;text-align: center;font-weight:bold">EMAIL</td>
            <td style="color:#000000;width:25px;font-size:12px;text-align: center;font-weight:bold">ĐỊA CHỈ</td>
        </tr>
        @foreach($infoStudents as $key => $val)
        <tr>
            <td style="border:1px solid #000000;text-align: center">{{ $key + 1 }}</td>
            <td style="border:1px solid #000000;text-align: left">{{$val['teacher_number']}}</td>
            <td style="border:1px solid #000000;text-align: left">{{$val['teacher_name']}}</td>
            <td style="border:1px solid #000000;text-align: left">{{$val['name']}}</td>
            <td style="border:1px solid #000000;text-align: left">{{$val['class']}}</td>
            <td style="border:1px solid #000000;text-align: left">{{date('d/m/Y',strtotime($val['birthday']))}}</td>
            <td style="border:1px solid #000000;text-align: left">{{$val['gender'] == 1 ? 'Name' : 'Nữ'}}</td>
            <td style="border:1px solid #000000;text-align: left">{{$val['phone']}}</td>
            <td style="border:1px solid #000000;text-align: left">{{$val['email']}}</td>
            <td style="border:1px solid #000000;text-align: left">{{$val['address']}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>