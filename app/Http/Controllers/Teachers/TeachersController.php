<?php

namespace App\Http\Controllers\Teachers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreEditInfoTeacher,StoreAddPoint, StoreAddMultiPoint}; 
use App\Models\{Accounts,InfoStudents,Classes,InfoTeachers,Subjects,Tkbofteachers,Weekdays,Tiethoc,Rooms,PointOfStudent,TypeOfPoint,Point_AVG};
use Illuminate\Support\Facades\DB;
use App\Helpers\Common\getClassName;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Rules\CheckPointRule;

class TeachersController extends Controller
{	
	//view personal infoteacher
    public function viewPersonalInfoTeacher($teacher_number,Request $request,InfoTeachers $infoTeachers){
        $user = $request->session()->get('username');
        if($user === $teacher_number){
            $data = [];
            $data['infoTeacher'] = $infoTeachers->getInfoTeacher($teacher_number);
            return view('master.homePage.teacher-homePage.personal_infoTeacher',$data);   
        }
        else{
            abort(404);
        }
	}

    //view edit personal infoteacher
    public function viewEditPersonalInfoTeacher($teacher_number,Request $request,InfoTeachers $infoTeachers){
        $user = $request->session()->get('username');
        if($user === $teacher_number){
            $data = [];
            $data['infoTeacher'] = $infoTeachers->getInfoTeacher($teacher_number);
            return view('master.homePage.teacher-homePage.edit_personal_infoTeacher',$data);   
        }
        else{
            abort(404);
        }
	}

    //handle edit personal infoteacher
    public function handleEditPersonalInfoTeacher($teacher_number,StoreEditInfoTeacher $request){
        $user = $request->session()->get('username');
        if($user === $teacher_number){
            InfoTeachers::where('teacher_number', $teacher_number)
                        ->update([
                            'teacher_name' => $request->teacher_name,
                            'birthday' => $request->birthday,
                            'gender' => $request->gender,
                            'phone' => $request->phone,
                            'email' => $request->email,
                            'address' => $request->address,
                        ]);
            return redirect()->route('teacher.personal_infoTeacher',$teacher_number);   
        }
        else{
            abort(404);
        }
	}

    //view lịch giảng dạy
	public function viewTKBTeacher(Request $request,InfoTeachers $infoTeachers,Subjects $subject,Tkbofteachers $tkb,Weekdays $day,Tiethoc $tiet){
		$teacher_number = $request->session()->get('username');
		$check = $infoTeachers->getInfoTeacher($teacher_number);
        if($check){
            $data = [];
            $data['infoTeacher'] = $check;
            $data['InfoTkb'] = $tkb->getDataTKBOfTeacher($teacher_number);
            $data['day'] = $day->getAllDataWeekdays();
            $data['tiethoc'] = $tiet->getAllDataTietHoc();
            return view('master.homePage.teacher-homePage.tkb_teacher',$data);
        }
        else{
            abort(404);
        }
	}

    //view list classes đang giảng dạy
    public function viewListClasses(Request $request,InfoTeachers $infoTeachers,Classes $class,TypeOfPoint $type){
        $teacher_number = $request->session()->get('username');
        $check = $infoTeachers->getInfoTeacher($teacher_number);
        if($check){
            $data = [];
            $class_name = getClassName::getClassName($teacher_number,$infoTeachers,$class);
            $data['infoClass'] = $class->getDataInfoClass($class_name);
            return view('master.homePage.teacher-homePage.list_classes',$data);
        }
        else{
            abort(404);
        }

    }

    //view list students trong class
    public function listStudentsOfClass($class_id,InfoStudents $infoStudents){
        $data = [];
        $data['class'] = Classes::where('id', $class_id)->first();
        $data['listStudents'] = $infoStudents->listInfoStudentsByClass2($class_id);
        return view('master.homePage.teacher-homePage.list_students_of_class',$data);

    }

    //view tkb of class
    public function viewTKBOfClass($class_name,Tkbofteachers $tkb,Weekdays $day,Tiethoc $tiet){
        $data = [];
        $data['day'] = $day->getAllDataWeekdays();
        $data['tiethoc'] = $tiet->getAllDataTietHoc();
        $data['tkbOfClass'] = $tkb->getDataTKBOfClass($class_name);
        return view('master.homePage.teacher-homePage.tkb_class',$data);
    }

    //view list studets
    public function viewListStudents(Request $request,InfoTeachers $infoTeachers,InfoStudents $infoStudents,Classes $class){
        $keyword = $request->keyword;
        $teacher_number = $request->session()->get('username');
        $check = $infoTeachers->getInfoTeacher($teacher_number);
        if($check){
            $data = [];
            $data['keyword'] = $keyword;
            $data['listStudents'] = [];
            $listStudents = [];
            $class_name = getClassName::getClassName($teacher_number,$infoTeachers,$class);
            foreach($class_name as $key => $item){
                 $infoStudent = $infoStudents->listInfoStudentsByClass($item,$keyword);
                 array_push($listStudents,$infoStudent);
            }
            foreach ($listStudents as $key => $val){
                foreach($val as $key2 => $val2){
                    array_push($data['listStudents'],$val2);
                }
            }
            return view('master.homePage.teacher-homePage.list_students',$data);
        }
        else{
            abort(404);
        }
    }

    //view result student
    public function viewResultOfStudents($student_number,InfoStudents $infoStudents,Classes $class,Subjects $subject,TypeOfPoint $type,PointOfStudent $point,Point_AVG $avg){
        $class_id = $infoStudents->getClassId($student_number);
        $check = $infoStudents->checkAddInfoStudents($student_number);
        if($check){
            $data = [];
            $data['infoStudent'] = $check;
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
            return view('master.homePage.teacher-homePage.result_student',$data);
        }
        else{
            return redirect()->route('teacher.list_students')->with('notification','Học sinh không tồn tại');
        }
    }



    public function viewAddPoint($student_number,InfoStudents $infoStudents,TypeOfPoint $typeofpoint){
        $checkStudent = $infoStudents->checkAddInfoStudents($student_number);
        if($checkStudent){
            $data = [];
            $data['infoStudent'] = $infoStudents->checkAddInfoStudents($student_number);
            $data['typeOfPoint'] = $typeofpoint->getAllData();
            return view('master.homePage.teacher-homePage.add_point',$data);
        }
        else{
            abort(404);
        }
    }

     //view list students trong class
     public function viewAddMultiPoint($class_name,InfoStudents $infoStudents, TypeOfPoint $typeofpoint){
        
        $data = [];
        $data['class'] = $class_name;
        $data['listStudents'] = $infoStudents->listInfoStudentsByClass($class_name);
        $data['typeOfPoint'] = $typeofpoint->getAllData();
        return view('master.homePage.teacher-homePage.add_multi_point',$data);
    }

    public function handlePostAddPoint($student_number,StoreAddPoint $request,InfoTeachers $infoTeachers,InfoStudents $infoStudents,TypeOfPoint $type,Point_AVG $avg){

            $teacher_number = $request->session()->get('username');
            $subject = $infoTeachers->getSubject($teacher_number);
            $subject_number = $subject['subject_number'];
            $subject_name = $subject['name'];
            //get data to form
            $point_id = $request->type_of_point;
            $coefficient = $type->getCoefficient($point_id);
            $coefficient = $coefficient['coefficient'];
            $point = $request->point;
            
            $dataPoint = [
                'student_number' => $student_number,
                'subject_number' => $subject_number,
                'point_id' => $point_id,
                'point' => $point,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $checkInsert = DB::table('pointofstudent')->insert($dataPoint);
            $point_avg = $avg->getPointAVG($student_number,$subject_name);
            //dd($subject_name);
            $pointAVG = $point_avg['point_avg'];
            $sumCoeff = $point_avg['sumCoeff'];
            $pointAVG = ($pointAVG*$sumCoeff + $point*$coefficient)/($sumCoeff+$coefficient);
            $sumCoeff = $sumCoeff+$coefficient;
            $dataUpdatePointAVG = [
                'point_avg' => $pointAVG,
                'sumCoeff' => $sumCoeff,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $checkUpdate = $avg->updatePointAVG($student_number,$subject_name,$dataUpdatePointAVG);
            if($checkInsert && $checkUpdate){
                return redirect()->route('teacher.list_students')->with('notification','Thêm điểm thành công cho học sinh có mã '.$student_number);
            }
    } 

    public function handlePostAddMultiPoint(StoreAddMultiPoint $request,InfoTeachers $infoTeachers,TypeOfPoint $type,Point_AVG $avg){
        $teacher_number = $request->session()->get('username');
        $subject = $infoTeachers->getSubject($teacher_number);
        $subject_number = $subject['subject_number'];
        $subject_name = $subject['name'];

        $points = $request->point;
        $point_id = $request->type_of_point;
        $coefficient = $type->getCoefficient($point_id);
        $coefficient = $coefficient['coefficient'];

        //insert point to PointOfStudent
        foreach($points as $key => $point){
            if(!is_null($point['point'])){
                PointOfStudent::create([
                    'student_number' => $point['student_number'],
                    'subject_number' => $subject_number,
                    'point_id' => $point_id,
                    'point' => $point['point'],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
    
                $point_avg = $avg->getPointAVG($point['student_number'],$subject_name);
                $sumCoeff = $point_avg['sumCoeff'];
                $pointAVG = $point_avg['point_avg'];
                $pointAVG = ($pointAVG*$sumCoeff + $point['point']*$coefficient)/($sumCoeff+$coefficient); 
                $sumCoeff += $coefficient; 
                
                Point_AVG::where('student_number', $point['student_number'])
                            ->where('subject', $subject_name)
                            ->update([
                                'point_avg' => $pointAVG,
                                'sumCoeff' => $sumCoeff,
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
            }
        }
        return redirect()->route('teacher.list_classes')->with('notification','Thêm điểm thành công');
    }

    //view add multi conduct
    public function viewAddMultiConduct($class_name,InfoStudents $infoStudents, TypeOfPoint $typeofpoint){
        
        $data = [];
        $data['class'] = $class_name;
        $data['listStudents'] = $infoStudents->listInfoStudentsByClass($class_name);
        return view('master.homePage.teacher-homePage.add_multi_conduct',$data);
    }

    //handle add multi conduct
    public function handleAddMultiConduct(Request $request){
        $data = $request->conduct;
        foreach($data as $val){
            if (!is_null($val['conduct'])) {
                InfoStudents::where('student_number', $val['student_number'])->update(['conduct' => $val['conduct']]);
            }
        }
        return redirect()->route('teacher.list_classes')->with('notification','Thêm hạnh kiểm thành công');
    }

    // Export excel list students
    public function studentsExport($class_id) 
    {
        $class = Classes::findOrFail($class_id);
        $infoStudents = InfoStudents::where('class', $class_id)->get();
        return Excel::download(new StudentsExport($infoStudents, $class), 'students_'.$class->class_name.'_'.date('d-m-Y').'.xlsx');
    }

}
