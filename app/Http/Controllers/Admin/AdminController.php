<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{StorePostInfoStudnets,StorePostInfoTeachers,StoreAddTKBTeachers,StoreAddRooms,StoreAddClasses, StoreAddSubject}; 
use App\Models\{Accounts,InfoStudents,Classes,InfoTeachers,Subjects,Tkbofteachers,Weekdays,Tiethoc,Rooms,PointOfStudent,TypeOfPoint,Point_AVG};
use Illuminate\Support\Facades\DB;
use App\Exports\StudentsExport;
use App\Exports\TeachersExport;
use App\Exports\ResultSummaryExport;
use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{
    //view hien thi personal_infoAdmin
    public function viewPersonalInfoAdmin($username,Request $request){
        $user = $request->session()->get('username');
        if($user === $username){
            $data = [];
            $data['name'] = $user;
    		return view('master.homePage.admin-homePage.personal_infoAdmin',$data);
        }
        else{
            abort(404);
        }
	}
    //View hien thi info students
    public function viewListStudents(Request $request,InfoStudents $infoStudents){
        $keyword = $request->keyword;
        $data = [];
        $data['infoStudents'] = $infoStudents->listInfoStudents($keyword);
        $data['keyword'] = $keyword;
        return view('master.homePage.admin-homePage.list_students',$data);
    }

    //View add info students
    public function viewAddStudents(Classes $class){
        $data = [];
        $data['classes'] = $class->getAllDataClasses();
        return view('master.homePage.admin-homePage.add_students',$data);
    }

    //View edit info students
    public function viewEditInfoStudents($student_number,InfoStudents $infoStudents,Classes $class){
        $check = $infoStudents->checkAddInfoStudents($student_number);
        if($check){
            $data = [];
            $data['infoStudent'] = $check;
            $data['classes'] = $class->getAllDataClasses();
            return view('master.homePage.admin-homePage.edit_infoStudents',$data);
        }
        else{
            return redirect()->route('admin.list_students')->with('notification','Học sinh không tồn tại');
        }
    }

    //view result of student
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
            return view('master.homePage.admin-homePage.result_students',$data);
        }
        else{
            return redirect()->route('admin.list_students')->with('notification','Học sinh không tồn tại');
        }
    }

    //View hien thi info teachers
    public function viewListTeachers(Request $request,InfoTeachers $infoTeachers){
        $keyword = $request->keyword;
        $data = [];
        $data['infoTeachers'] = $infoTeachers->listInfoTeachers($keyword); 
        $data['keyword'] = $keyword;
        return view('master.homePage.admin-homePage.list_teachers',$data);
    }

    //view add teacher
    public function viewAddTeachers(Subjects $subject,Classes $class){
        $data = [];
        $data['subjects'] = $subject->getAllDataSubjects();
        $data['classes'] = $class->getAllDataClasses();
        return view('master.homePage.admin-homePage.add_teachers',$data);
    }

    //view edit teacher
    public function viewEditInfoTeachers($teacher_number,InfoTeachers $infoTeachers,Subjects $subject,Classes $class){
        $check = $infoTeachers->checkAddInfoTeachers($teacher_number);
        if($check){
            $data = [];
            $data['infoTeacher'] = $check;
            $data['subjects'] = $subject->getAllDataSubjects();
            $data['classes'] = $class->getAllDataClasses();
            return view('master.homePage.admin-homePage.edit_infoTeachers',$data);
        }
        else{
            return redirect()->route('admin.list_teachers')->with('notification','Giáo viên không tồn tại');
        }
    }

    //view detail Info Teacher
    public function viewDetailInfoTeacher($teacher_number,InfoTeachers $infoTeachers,Subjects $subject,Tkbofteachers $tkb,Weekdays $day,Tiethoc $tiet){
        $check = $infoTeachers->getInfoTeacher($teacher_number);
        if($check){
            $data = [];
            $data['infoTeacher'] = $check;
            $data['InfoTkb'] = $tkb->getDataTKBOfTeacher($teacher_number);
            $data['day'] = $day->getAllDataWeekdays();
            $data['tiethoc'] = $tiet->getAllDataTietHoc();
            return view('master.homePage.admin-homePage.detail_infoTeacher',$data);
        }
        else{
            return redirect()->route('admin.list_teachers')->with('notification','Giáo viên không tồn tại');
        }
    }

    //view add tkb teachers
    public function viewAddTKBTeachers($teacher_number,InfoTeachers $infoTeachers,Classes $class,Weekdays $day,Tiethoc $tiet){
        $check = $infoTeachers->getInfoTeacher($teacher_number);
        if($check){
            $data = [];
            $data['infoTeacher'] = $check;
            $data['classes'] = $class->getAllDataClasses();
            $data['weekdays'] = $day->getAllDataWeekdays();
            $data['tiethoc'] = $tiet->getAllDataTietHoc();
            return view('master.homePage.admin-homePage.add_tkb_teachers',$data);
        }
        else{
            return redirect()->route('admin.list_teachers')->with('notification','Giáo viên không tồn tại');
        }
    }

     //view edit tkb teachers
     public function viewEditTKBTeachers($id, InfoTeachers $infoTeachers, Classes $class, Weekdays $day, Tiethoc $tiet){
        $infoTKB = Tkbofteachers::findOrFail($id);
        $infoTeacher = $infoTeachers->getInfoTeacher($infoTKB->teacher_number);
        $classes = $class->getAllDataClasses();
        $weekdays = $day->getAllDataWeekdays();
        $tiethoc = $tiet->getAllDataTietHoc();
        return view('master.homePage.admin-homePage.edit_tkb_teacher', compact('infoTKB', 'infoTeacher', 'classes', 'weekdays', 'tiethoc'));
    }

    //handle del tkb
    public function handleDelTKBTeachers($id){
        $teacher_number = Tkbofteachers::findOrFail($id)->teacher_number;
        if(Tkbofteachers::findOrFail($id)->delete()){
            return redirect()->route('admin.detail_infoTeacher', $teacher_number)->with('notification', 'Xoá lịch giảng dạy thành công');
        }
        else {
            abort(404);
        }
    }

    //view list classes
    public function viewListClasses(Classes $class){
        $infoClasses = $class->getAllDataClasses();
        $data = [];
        $data['infoClasses'] = $infoClasses;
        return view('master.homePage.admin-homePage.list_classes',$data);
    }

    //view add class
    public function viewAddClass(Rooms $room){
        $data = [];
        $data['antiRoom'] = $room->listAntiRooms();
        return view('master.homePage.admin-homePage.add_class',$data);
    }

    //view edit class
    public function viewEditClass($class_id , Rooms $room){
        $data = [];
        $data['class'] = Classes::where('id', $class_id)->first();
        $data['antiRoom'] = $room->listAntiRooms();
        return view('master.homePage.admin-homePage.edit_class',$data);
    }

    //view tkb of class
    public function viewTKBOfClass($class_name,Tkbofteachers $tkb,Weekdays $day,Tiethoc $tiet){
        $data = [];
        $data['day'] = $day->getAllDataWeekdays();
        $data['tiethoc'] = $tiet->getAllDataTietHoc();
        $data['tkbOfClass'] = $tkb->getDataTKBOfClass($class_name);
        return view('master.homePage.admin-homePage.tkb_class',$data);
    }

    //view list students of class
    public function listStudentsOfClass($class_id,InfoStudents $infoStudents){
        $data = [];
        $data['class'] = $data['class'] = Classes::where('id', $class_id)->first();
        $data['listStudents'] = $infoStudents->listInfoStudentsByClass2($class_id);
        return view('master.homePage.admin-homePage.list_students_of_class',$data);

    }

    //view list rooms
    public function viewListRooms(Rooms $room){
        $data = [];
        $data['listRooms'] = $room->getAllDataRooms();
        return view('master.homePage.admin-homePage.list_rooms',$data);
    }

    //view add room
    public function viewAddRoom(){
        return view('master.homePage.admin-homePage.add_room');
    }

    //view add subject
    public function viewAddSubject(){
        return view('master.homePage.admin-homePage.add_subject');
    }

    //handle add subject
    public function handleAddSubject(Request $request){
        $check = Subjects::where('subject_number', $request->subject_number)->first();
        if($check){
            return redirect()->back()->withInput()->with('notification', 'Mã môn học đã tồn tại');
        }
        Subjects::create([
            'subject_number' => $request->subject_number,
            'name' => $request->subject_name,
            'lop_6' => $request->lop_6 ?? 0,
            'lop_7' => $request->lop_7 ?? 0,
            'lop_8' => $request->lop_8 ?? 0,
            'lop_9' => $request->lop_9 ?? 0
        ]);
        return redirect()->route('admin.list_subjects')->with('notification', 'Thêm môn học thành công');
    }

    //handle del subject
     public function handleDelSubject($subject_number){
         $delSubject = Subjects::where('subject_number', $subject_number)->delete();
         if($delSubject){
            return redirect()->route('admin.list_subjects')->with('notification', 'Xoá môn học thành công');
         }
         else{
             abort(404);
         }
    }

    //view edit subject
    public function viewEditSubject($subject_id){
        $subject = Subjects::where('id', $subject_id)->first();
        return view('master.homePage.admin-homePage.edit_subject', compact('subject'));
    }

    //handle edit subject
    public function handleEditSubject(Request $request, $subject_id){
        $oldSubject = Subjects::find($subject_id);
        if($request->subject_number != $oldSubject->subject_number){
            $check = Subjects::where('subject_number', $request->subject_number)->first();
            if($check){
                return redirect()->back()->withInput()->with('notification', 'Mã môn học đã tồn tại');
            }
        }
        $updateSubject = Subjects::where('id', $subject_id)->update([
            'subject_number' => $request->subject_number,
            'name' => $request->subject_name,
            'lop_6' => $request->lop_6 ?? 0,
            'lop_7' => $request->lop_7 ?? 0,
            'lop_8' => $request->lop_8 ?? 0,
            'lop_9' => $request->lop_9 ?? 0
        ]);
        if($updateSubject){
           return redirect()->route('admin.list_subjects')->with('notification', 'Cập nhật môn học thành công');
        }
        else{
            abort(404);
        }
   }

    //view list subjects
    public function viewListSubjects(Subjects $subject){
        $data = [];
        $data['subjects'] = $subject->getAllDataSubjects();
        return view('master.homePage.admin-homePage.list_subjects',$data);
    }

    //handel students
    public function handlePostAddInfoStudents(StorePostInfoStudnets $request, InfoStudents $infoStudents, Classes $class, Subjects $subject){
        //du lieu dươc lay tu form gui len
        $student_number = $request->student_number;
        $student_name = $request->student_name;
        $birthday = $request->birthday;
        $gender = $request->gender;
        $id_class = $request->class;
        $class_id = $class->getClassId($id_class);
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;

        $infoStudent = $infoStudents->checkAddInfoStudents($student_number);

        if($infoStudent){
            return back()->withInput()->with('notification','Mã học sinh đã tồn tại');
        }
        else{
            //data of table InfoStudents
            $dataInfoStudents = [
                'student_number' => $student_number,
                'student_name' => $student_name,
                'birthday' => $birthday,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'class' => $id_class,
                'address' => $address,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ];
            //data of table Accounts
            $dataAccounts = [
                'username' => $student_number,
                'password' => '123456',
                'role' => 1, // 0 : Account for student
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ];
            //insert data to table inforstudents
            $checkInsertInfoStudents = DB::table('infostudents')->insert($dataInfoStudents);
            //insert data to table Accounts
            if($checkInsertInfoStudents){
                $checkInsertAccounts = DB::table('accounts')->insert($dataAccounts);
                $sub = $subject->getDataByClass($class_id);
                foreach($sub as $key => $val){
                    $dataPointAVG = [
                        'student_number' => $student_number,
                        'subject' => $val['name'],
                        'point_avg' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null
                    ];
                    DB::table('point_avg')->insert($dataPointAVG);
                }
                // $checkInsertPointAVG = DB::
            }
                //if insert thanh cong thi chuyen huong ve trang list_students va hien thi ra notification insert thanh cong
            if($checkInsertInfoStudents && $checkInsertAccounts){
                return redirect()->route('admin.list_students')->with('notification','Đã thêm thành công một học sinh mới');
            }
        }
    }

    public function handlePostEditInfoStudents($student_number,StorePostInfoStudnets $request, InfoStudents $infoStudents,Accounts $account){
        //kiem tr student co ton tai trong DB thi moi cho sửa
        $info = $infoStudents->checkAddInfoStudents($student_number);
        if($info){
            $student_number_after = $request->student_number;
            $student_name = $request->student_name;
            $birthday = $request->birthday;
            $gender = $request->gender;
            $class = $request->class;
            $email = $request->email;
            $phone = $request->phone;
            $address = $request->address;

            $dataEditInfo = [
                'student_number' => $student_number_after,
                'student_name' => $student_name,
                'birthday' => $birthday,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'class' => $class,
                'address' => $address,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if($student_number === $student_number_after){
                $dataEditInfo2 = [
                'student_name' => $student_name,
                'birthday' => $birthday,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'class' => $class,
                'address' => $address,
                'updated_at' => date('Y-m-d H:i:s')
                ];
                $checkEditInfo = $infoStudents->updateInfoStudents($student_number,$dataEditInfo2);
                if($checkEditInfo){
                    return redirect()->route('admin.list_students')->with('notification','Đã sửa thành công');
                }
                else{
                    return redirect()->route('admin.edit_infoStudents',$student_number);
                }
            }
            else{
                $checkStudentNumber = $infoStudents->checkStudentNumber($student_number_after);
                if($checkStudentNumber){
                    return redirect()->route('admin.edit_infoStudents',$student_number)->with('error','Mã học sinh đã tồn tại');
                }
                else{
                    $checkEditInfo2 = $infoStudents->updateInfoStudents_2($student_number,$dataEditInfo);
                    if($checkEditInfo2){
                        $dataEditAccount = [
                            'username' => $student_number_after,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $checkEditAcc = $account->updateAccounts($student_number,$dataEditAccount);
                        if($checkEditInfo2 && $checkEditAcc){
                            return redirect()->route('admin.list_students')->with('notification','Đã sửa thành công');
                        }
                    }
                }
            }
        }

    }

    public function handlePostDelInfoStudents($student_number,InfoStudents $infoStudents,Accounts $account,PointOfStudent $point,Point_AVG $avg){
        $info = $infoStudents->checkAddInfoStudents($student_number);
        if($info){
            $checkDelAcc = $account->delAccounts_1($student_number);
            if($checkDelAcc){
                $checkDelInfo = $infoStudents->delInfoStudents($student_number);
                $checkDelPoint = $point->delPoint($student_number);
                $checkDelPointAVG = $avg->delPointAVG($student_number);
            }
            if($checkDelAcc && $checkDelInfo && $checkDelPoint && $checkDelPointAVG){
                return redirect()->route('admin.list_students')->with('notification','Đã xóa thành công');
            }
        }
        else{
            return redirect()->route('admin.list_students')->with('error','Học sinh không tồn tại');
        }

    }
    //end handle students

    //handle teachers
    public function handlePostAddInfoTeachers(StorePostInfoTeachers $request, InfoTeachers $infoTeachers){
        $teacher_number = $request->teacher_number;
        $teacher_name = $request->teacher_name;
        $birthday = $request->birthday;
        $gender = $request->gender;
        $subject_number = $request->subject_number;
        $is_gvcn = $request->is_gvcn;
        $is_gvcn = $is_gvcn === 'on' ? 1 : 0;
        $class = $request->class;
        $class = $is_gvcn == 1 ? $class : null;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $infoTeacher = $infoTeachers->checkAddInfoTeachers($teacher_number);

        if($infoTeacher){
            return back()->withInput()->with('notification','Mã giáo viên đã tồn tại');
        }
        else{
            if($class){
                $checkClass = $infoTeachers->checkClass($class);
                if($checkClass){
                    return back()->withInput()->with('classExists','Lớp này đã có giáo viên chủ nhiệm');
                }
            }
            //data of table InfoStudents
            $dataInfoTeachers = [
                'teacher_number' => $teacher_number,
                'teacher_name' => $teacher_name,
                'birthday' => $birthday,
                'subject_number' => $subject_number,
                'is_gvcn' => $is_gvcn,
                'class' => $class,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'address' => $address,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ];
            //data of table Accounts
            $dataAccounts = [
                'username' => $teacher_number,
                'password' => '123456',
                'role' => 0, // 0 : Account for teacher
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ];
            //insert data to table inforstudents
            $checkInsertInfoTeachers = DB::table('infoteachers')->insert($dataInfoTeachers);
            //insert data to table Accounts
            if($checkInsertInfoTeachers){
                $checkInsertAccounts = DB::table('accounts')->insert($dataAccounts);
            }
                //if insert thanh cong thi chuyen huong ve trang list_students va hien thi ra notification insert thanh cong
            if($checkInsertInfoTeachers && $checkInsertAccounts){
                return redirect()->route('admin.list_teachers')->with('notification','Đã thêm thành công một giáo viên mới');
            }
        }
    }

    public function handlePostEditInfoTeachers($teacher_number,StorePostInfoTeachers $request, InfoTeachers $infoTeachers,Accounts $account){
        //kiem tr student co ton tai trong DB thi moi cho sửa
        $info = $infoTeachers->checkAddInfoTeachers($teacher_number);
        if($info){
            $teacher_number_after = $request->teacher_number;
            $teacher_name = $request->teacher_name;
            $birthday = $request->birthday;
            $gender = $request->gender;
            $subject_number = $request->subject_number;
            $is_gvcn = $request->is_gvcn;
            $is_gvcn = $is_gvcn === 'on' ? 1 : 0;
            $class = $request->class;
            $class = $is_gvcn == 1 ? $class : null;
            $email = $request->email;
            $phone = $request->phone;
            $address = $request->address;

            $dataEditInfo = [
                'teacher_number' => $teacher_number_after,
                'teacher_name' => $teacher_name,
                'birthday' => $birthday,
                'subject_number' => $subject_number,
                'is_gvcn' => $is_gvcn,
                'class' => $class,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'address' => $address,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if($teacher_number === $teacher_number_after){
                $dataEditInfo2 = [
                'teacher_name' => $teacher_name,
                'birthday' => $birthday,
                'subject_number' => $subject_number,
                'is_gvcn' => $is_gvcn,
                'class' => $class,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'address' => $address,
                'updated_at' => date('Y-m-d H:i:s')
                ];
                $checkEditInfo = $infoTeachers->updateInfoTeachers($teacher_number,$dataEditInfo2);
                if($checkEditInfo){
                    return redirect()->route('admin.list_teachers')->with('notification','Đã sửa thành công');
                }
                else{
                    return redirect()->route('admin.edit_infoTeachers',$teacher_number);
                }
            }
            else{
                $checkTeacherNumber = $infoTeachers->checkTeacherNumber($teacher_number_after);
                if($checkTeacherNumber){
                    return redirect()->route('admin.edit_infoTeachers',$teacher_number)->with('error','Mã giáo viên đã tồn tại');
                }
                else{
                    $checkEditInfo2 = $infoTeachers->updateInfoTeachers_2($teacher_number,$dataEditInfo);
                    if($checkEditInfo2){
                        $dataEditAccount = [
                            'username' => $teacher_number_after,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $checkEditAcc = $account->updateAccounts($teacher_number,$dataEditAccount);
                        if($checkEditInfo2 && $checkEditAcc){
                            return redirect()->route('admin.list_teachers')->with('notification','Đã sửa thành công');
                        }
                    }
                }
            }
        }

    }

    public function handlePostDelInfoTeachers($teacher_number,InfoTeachers $infoTeachers,Accounts $account,Tkbofteachers $tkb){
        $info = $infoTeachers->checkAddInfoTeachers($teacher_number);
        if($info){
            $checkDelAcc = $account->delAccounts_2($teacher_number);
            $checkDelTKB = $tkb->delTKBOfTeacher($teacher_number);
            if($checkDelAcc && $checkDelTKB){
                $checkDelInfo = $infoTeachers->delInfoTeachers($teacher_number);
            }
            if($checkDelAcc && $checkDelInfo && $checkDelTKB){
                return redirect()->route('admin.list_teachers')->with('notification','Đã xóa thành công');
            }
        }
        else{
            return redirect()->route('admin.list_teachers')->with('error','Giáo viên không tồn tại');
        }

    }

    public function handleAddTKBTeachers($teacher_number,StoreAddTKBTeachers $request,InfoTeachers $infoTeachers,Tkbofteachers $tkb){
        $info = $infoTeachers->checkAddInfoTeachers($teacher_number);
        if($info){
            $class = $request->class;
            $weekday = $request->weekdays;
            $tiethoc = $request->tiethoc;


            $checkAddData = $tkb->CheckData($class,$weekday,$tiethoc);
            if($checkAddData){
                $weekday += 1;
                return redirect()->back()->with('error',"Tiết học ".$tiethoc." vào thứ ".$weekday." của lớp ".$class." đã tồn tại.Vui lòng nhập lại");
            }

            $checkTKBTeacher = Tkbofteachers::where([
                                'teacher_number' => $teacher_number,
                                'weekdays_id' =>  $weekday,
                                'tiethoc_id' => $tiethoc
                                ])->first();
            if($checkTKBTeacher){
                $weekday += 1;
                return redirect()->back()->with('error',"Tiết học ".$tiethoc." vào thứ ".$weekday." của giáo viên đã tồn tại.Vui lòng nhập lại");
            }

            $dataOfTKBTeacher = [
                'teacher_number' => $teacher_number,
                'class' => $class,
                'weekdays_id' => $weekday,
                'tiethoc_id' => $tiethoc,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $checkInsertTKB = DB::table('tkbofteachers')->insert($dataOfTKBTeacher);

            if($checkInsertTKB){
                return redirect()->route('admin.detail_infoTeacher',$teacher_number)->with('notification','Đã thêm lịch giảng dạy thành công');
            }
        }  
    }

    //handle add class
    public function handleAddClass(StoreAddClasses $request,Classes $class,Rooms $room){
        $class_name = $request->class_name;
        $class_name = strtoupper($class_name);
        $class_id = $request->class_id;
        $room_id = $request->room_id;

        $check = $class->checkClassName($class_name);
        if($check){
            return back()->withInput()->with('notification','Tên lớp đã tồn tại');
        }
        $dataInsert = [
            'class_name' => $class_name,
            'class_id' => $class_id,
            'room_id' => $room_id,
            // 'created_at' => date('Y-m-d H:i:s')
        ];

        $checkInsertClass = DB::table('classes')->insert($dataInsert);

        if($checkInsertClass){
            $checkUpdateRoom = $room->updateStatus1($room_id);
            return redirect()->route('admin.list_classes')->with('notification','Đã thêm thành công một lớp học mới');
        }
        else{
            return back();
        }
    }

    //handle edit class
    public function handleEditClass(StoreAddClasses $request, Classes $class) {
        $check = $class->checkClassName($request->class_name);
        if($check && $check['class_name'] !== $request->class_name){
            return back()->withInput()->with('notification','Tên lớp đã tồn tại');
        }
        else {
            Classes::where('id', $request->id)->update([
                'class_name' => $request->class_name,
                'class_id' => $request->class_id,
                'room_id' => $request->room_id
            ]);
            
            Rooms::where('id', $check['room_id'])->update(['status' => 0]);

            Rooms::where('id', $request->room_id)->update(['status' => 1]);

            return redirect()->route('admin.list_classes')->with('notification','Đã sửa thành công một lớp học mới');
        }

    }

    //handle del class
    public function handleDelClass($class_id,Accounts $account,InfoStudents $infoStudents,Classes $class,Tkbofteachers $tkb,Rooms $room,PointOfStudent $point,Point_AVG $avg){
        $class_name = $class->getClassName($class_id);
        $class_name = $class_name['class_name'];
        $checkClass = $class->checkClassId($class_id);
        $room_id = $class->getRoomId($class_id);
        $studentsNumber = $infoStudents->getStudentsNumber($class_id);
        if($checkClass){
            $checkDelStudent = $infoStudents->delStudentsByClass($class_id);
            if($checkDelStudent){
                foreach($studentsNumber as $key => $val){
                    $account->delAccounts_1($val['student_number']);
                    $point->delPoint($val['student_number']);
                    $avg->delPointAVG($val['student_number']);
     
                }
                $tkb->delTKBByClass($class_name);
                $checkDelClass = $class->delClass($class_id);
                $checkUpdateRoom = $room->updateStatus2($room_id);
                if($checkDelClass && $checkUpdateRoom){
                    return redirect()->route('admin.list_classes')->with('notification','Đã xóa thành công');
                }
            }
        }
        else{
            return redirect()->route('admin.list_classes')->with('error','Lớp học không tồn tại');
        }
    }

    //handle add room
    public function handleAddRoom(StoreAddRooms $request,Rooms $room){
        $room_name = $request->room_name;
        $room_name = strtoupper($room_name);
        $check = $room->checkData($room_name);
        if($check){
            return back()->withInput()->with('notification','Phòng đã tồn tại');
        }
        $dataInsert = [
            'name' => $room_name,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $checkInsertRooms = DB::table('rooms')->insert($dataInsert);

        if($checkInsertRooms){
            return redirect()->route('admin.list_rooms')->with('notification','Đã thêm thành công một phòng học mới');
        }
        else{
            return back();
        }
    }

    //handle del room
    public function handleDelRoom($room_name,Rooms $room,Classes $class){
        $checkRoom = $room->checkData($room_name);
        if($checkRoom){
            $class_id = $room->getClassIdByRoom($room_name);
            if($class_id){
                $checkStudent = $room->checkStudent($room_name);
                if($checkStudent){
                    return redirect()->route('admin.list_rooms')->with('error','Phòng học có học sinh. Không thể xóa');
                }
                else{
                    $checkDelRoom = $room->delRoom($room_name);
                    $checkDelClass = $class->delClass($class_id['id']);
                    if($checkDelRoom){
                        return redirect()->route('admin.list_rooms')->with('notification','Đã xóa thành công');
                    }
                }
            }else{
                $checkDelRoom = $room->delRoom($room_name);
                if($checkDelRoom){
                    return redirect()->route('admin.list_rooms')->with('notification','Đã xóa thành công');
                }
            }
            
        }
        else{
            return redirect()->route('admin.list_rooms')->with('error','Phòng học không tồn tại');
        }
    }

    // Export excel list students
    public function studentsExport($class_id) 
    {
        $class = Classes::findOrFail($class_id);
        $infoStudents = InfoStudents::where('class', $class_id)->get();
        return Excel::download(new StudentsExport($infoStudents, $class), 'students_'.$class->class_name.'_'.date('d-m-Y').'.xlsx');
    }

    // Export excel list teachers
    public function teachersExport(InfoTeachers $infoTeachers) 
    {
        $infoTeachers = $infoTeachers->listInfoTeachers(); 
        return Excel::download(new TeachersExport($infoTeachers), 'teachers'.'_'.date('d-m-Y').'.xlsx');
    }

    // Export excel result summary
    public function resultSummaryExport($class_id) 
    {
        $infoClass = Classes::where('id', $class_id)->first();
        if ($infoClass->class_id == Classes::LOP6) {
            $infoSubjects = Subjects::where('lop_6', $infoClass->class_id)->get();
        }
        else if ($infoClass->class_id == Classes::LOP7) {
            $infoSubjects = Subjects::where('lop_7', $infoClass->class_id)->get();
        }
        else if ($infoClass->class_id == Classes::LOP8) {
            $infoSubjects = Subjects::where('lop_8', $infoClass->class_id)->get();
        }
        else if ($infoClass->class_id == Classes::LOP9) {
            $infoSubjects = Subjects::where('lop_9', $infoClass->class_id)->get();
        }
        else {
            abort(404);
        }
        $infoPoint = InfoStudents::where('class', $class_id)->get();
        foreach ($infoPoint as $val) {
            $sumPoint = 0;
            foreach ($val->pointAVG as $point) {
                $sumPoint += $point->point_avg;
            }
            $pointAVG = $sumPoint/count($val->pointAVG); 
            $val->point_avg = $pointAVG; 
            $hocLuc = "";
            if ($pointAVG >= Point_AVG::LOAI_GIOI) {
                foreach ($val->pointAVG as $point) {
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
                foreach ($val->pointAVG as $point) {
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
                foreach ($val->pointAVG as $point) {
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
                foreach ($val->pointAVG as $point) {
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
            $val->hocLuc = $hocLuc; 
        }
        return Excel::download(new ResultSummaryExport($infoClass, $infoSubjects, $infoPoint), 'student_result'.'_'.date('d-m-Y').'.xlsx');
    }

    //view student result summary
    public function viewResultSummary($class_id) {
        $infoClass = Classes::where('id', $class_id)->first();
        if ($infoClass->class_id == Classes::LOP6) {
            $infoSubjects = Subjects::where('lop_6', $infoClass->class_id)->get();
        }
        else if ($infoClass->class_id == Classes::LOP7) {
            $infoSubjects = Subjects::where('lop_7', $infoClass->class_id)->get();
        }
        else if ($infoClass->class_id == Classes::LOP8) {
            $infoSubjects = Subjects::where('lop_8', $infoClass->class_id)->get();
        }
        else if ($infoClass->class_id == Classes::LOP9) {
            $infoSubjects = Subjects::where('lop_9', $infoClass->class_id)->get();
        }
        else {
            abort(404);
        }
        $infoPoint = InfoStudents::where('class', $class_id)->get();
        foreach ($infoPoint as $val) {
            $sumPoint = 0;
            foreach ($val->pointAVG as $point) {
                $sumPoint += $point->point_avg;
            }
            $pointAVG = $sumPoint/count($val->pointAVG); 
            $val->point_avg = $pointAVG; 
            $hocLuc = "";
            if ($pointAVG >= Point_AVG::LOAI_GIOI) {
                foreach ($val->pointAVG as $point) {
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
                foreach ($val->pointAVG as $point) {
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
                foreach ($val->pointAVG as $point) {
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
                foreach ($val->pointAVG as $point) {
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
            $val->hocLuc = $hocLuc; 
        }
        return view('master.homePage.admin-homePage.result_summary', compact('infoClass', 'infoSubjects', 'infoPoint'));
        
    }
}
