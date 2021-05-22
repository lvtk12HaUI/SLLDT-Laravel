<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\{Accounts,InfoStudents,InfoTeachers,Classes,Subjects,Tkbofteachers,Weekdays,Tiethoc,TypeOfPoint,PointOfStudent,Point_AVG};
use App\Http\Requests\StoreEditInfoStudent;
use Illuminate\Support\Facades\DB;
use App\Helpers\Common\getTeacherNumber;

class StudentsController extends Controller
{
    //view personal infostudent
    public function viewPersonalInfoStudent(Request $request,InfoStudents $infoStudents){
        $student_number = $request->session()->get('username');
        $student_number = strtoupper($student_number);
        $data = [];
        $data['infoStudent'] = $infoStudents->checkAddInfoStudents($student_number);
        return view('master.homePage.student-homePage.personal_infoStudent',$data);   
    }

    //view edit personal infostudent
    public function viewEditPersonalInfoStudent(Request $request,InfoStudents $infoStudents){
        $student_number = $request->session()->get('username');
        $student_number = strtoupper($student_number);
        $data = [];
        $data['infoStudent'] = $infoStudents->checkAddInfoStudents($student_number);
        return view('master.homePage.student-homePage.edit_personal_infoStudent',$data);   
    }

     //handle edit personal infostudent
     public function handleEditPersonalInfoStudent(StoreEditInfoStudent $request){
        $student_number = $request->session()->get('username');
        InfoStudents::where('student_number', $student_number)
                    ->update([
                        'student_name' => $request->student_name,
                        'birthday' => $request->birthday,
                        'gender' => $request->gender,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'address' => $request->address,
                    ]);
            return redirect()->route('student.personal_infoStudent',$student_number);   
    }
    
    //view result student
    public function viewResultOfStudent(Request $request,InfoStudents $infoStudents,Classes $class,Subjects $subject,TypeOfPoint $type,PointOfStudent $point,Point_AVG $avg){
        $student_number = $request->session()->get('username');
        $student_number = strtoupper($student_number);
        $class_id = $infoStudents->getClassId($student_number);
        $infoSt = $infoStudents->checkAddInfoStudents($student_number);
        $data = [];
        $data['infoStudent'] = $infoSt;
        $data['subjects'] = $subject->getDataByClass($class_id);
        $data['typeOfPoint'] = $type->getAllData();
        $data['point'] = $point->getPointByStudent($student_number);
        $data['pointAVG'] = $avg->getPointByStudent($student_number);
        $infoPoint = InfoStudents::where('student_number', $student_number)->first();
            $sumPoint = 0;
            foreach ($infoPoint->pointAVG as $point) {
                $sumPoint += $point->point_avg;
            }
            $pointAVG = $sumPoint/count($infoPoint->pointAVG); 
            $infoPoint->point_avg = $pointAVG; 
            $hocLuc = "";
            if ($pointAVG >= Point_AVG::LOAI_GIOI) {
                foreach ($infoPoint->pointAVG as $point) {
                    if($point->point_avg <= 6.5){
                        $hocLuc = "Khá";
                        break;
                    }
                    if((strtoLower($point->name) == 'toán học' || strtoLower($point->name) == 'ngữ văn') && $val->pointAVG >= Point_AVG::LOAI_GIOI){
                        $hocLuc = "Giỏi";
                        break;
                    }
                }
            }
            else if ($pointAVG >= Point_AVG::LOAI_KHA) {
                foreach ($infoPoint->pointAVG as $point) {
                    if($point->point_avg <= 5){
                        $hocLuc = "Trung bình";
                        break;
                    }
                    if((strtoLower($point->name) == 'toán học' || strtoLower($point->name) == 'ngữ văn') && $val->pointAVG >= Point_AVG::LOAI_KHA){
                        $hocLuc = "Khá";
                        break;
                    }
                }
            }
            else if ($pointAVG >= Point_AVG::LOAI_TRUNG_BINH) {
                foreach ($infoPoint->pointAVG as $point) {
                    if($point->point_avg <= 3.5){
                        $hocLuc = "Kém";
                        break;
                    }
                    if((strtoLower($point->name) == 'toán học' || strtoLower($point->name) == 'ngữ văn') && $val->pointAVG >= Point_AVG::LOAI_TRUNG_BINH){
                        $hocLuc = "Trung bình";
                        break;
                    }
                }
            }
            else if ($pointAVG >= Point_AVG::LOAI_YEU) {
                foreach ($infoPoint->pointAVG as $point) {
                    if($point->point_avg <= 2.5){
                        $hocLuc = "Kém";
                        break;
                    }
                    $hocLuc = "Yếu";
                }
            }
            else{
                $hocLuc = "Kém"; 
            }
            $infoPoint->hocLuc = $hocLuc; 
            $data['infoPoint'] = $infoPoint;
        return view('master.homePage.student-homePage.result_student',$data);
    }

    //view tkb of student
    public function viewTKBOfStudent(Request $request,InfoStudents $infoStudents,Tkbofteachers $tkb,Weekdays $day,Tiethoc $tiet){
        $student_number = $request->session()->get('username');
        $student_number = strtoupper($student_number);
        $class = $infoStudents->getClassId($student_number);
        $class_name = $class['class_name'];
        $data = [];
        $data['day'] = $day->getAllDataWeekdays();
        $data['tiethoc'] = $tiet->getAllDataTietHoc();
        $data['tkbOfClass'] = $tkb->getDataTKBOfClass($class_name);
        return view('master.homePage.student-homePage.tkb_student',$data);
    }

    public function listInfoStudentByClass(Request $request,InfoStudents $infoStudents){
        $keyword = $request->keyword;
        $student_number = $request->session()->get('username');
        $student_number = strtoupper($student_number);
        $class_id = $infoStudents->getClass($student_number);
        $data = [];
        $data['infoStudents'] = $infoStudents->listInfoStudentsByClassId($class_id,$keyword);
        $data['keyword'] = $keyword;
        return view('master.homePage.student-homePage.list_infoStudent_by_class',$data);
    }

    public function listTeachers(Request $request,InfoStudents $infoStudents,InfoTeachers $infoTeachers,Classes $class,Tkbofteachers $tkb){
        $student_number = $request->session()->get('username');
        $class_id = $infoStudents->getClass($student_number);
        $class_name = $class->checkClassId($class_id);
        $teachers_number = $tkb->getTeachersNumber($class_name);
        $infoGVCN = $infoTeachers->getInfoGVCN($class_name);
        $teacherNumberOfGVCN = $infoGVCN['teacher_number'];
        $teachersNumber = getTeacherNumber::getTeachersNumber($teachers_number,$teacherNumberOfGVCN);
        $teachersNumber2 = [];
        foreach($teachersNumber as $key => $val){
            array_push($teachersNumber2,$val);
        }
        $data = [];
        $data['class'] = $class_name['class_name'];
        $data['infoTeachers'] = $infoTeachers->getInfoTeachersByClass($teachersNumber2);
        return view('master.homePage.student-homePage.list_teachers_by_class',$data);
    }
}
