<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
	'prefix' => 'student',
	'namespace' => 'Login',
], function(){
	Route::get('/login','HandleLoginController@viewLogin')->name('viewLogin')->middleware('isAdminLogined');
	Route::post('/handle-login','HandleLoginController@handleLogin')->name('handleLogin');
	Route::post('/handle-logout','HandleLoginController@logout')->name('handleLogout');
});

Route::group([
	'prefix' => 'student',
	'namespace' => 'ForgetPassWord',
], function(){
	Route::get('/quen-mat-khau','handleForgetPassword@viewForgotPassword')->name('viewForgetPassword');
	Route::post('/handle-forgot-password','handleForgetPassword@handleForgetPassword')->name('handleForgetPassword');
});

Route::group([
	'prefix' => '',
	'namespace' => 'HomePage',
	'middleware' => ['web','adminLogined']
], function(){
	//view HomePage
	Route::get('admin/homePage','HomePageController@viewAdminHomePage')->name('admin_homePage')->middleware('checkRoleAdmin');
	Route::get('teachers/homePage','HomePageController@viewTeacherHomePage')->name('teacher_homePage')->middleware('checkRoleTeacher');
	Route::get('students/homePage','HomePageController@viewStudentHomePage')->name('student_homePage')->middleware('checkRoleStudent');
	//route view change password
	Route::get('change-password/{username}','HandleChangePassword@viewChangePassword')->name('change_password');
	Route::post('handle-change-password/{username}','HandleChangePassword@HandleChangePassword')->name('HandleChangePassword');
});

//route admin
Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'as' => 'admin.',
	'middleware' => ['web','adminLogined','checkRoleAdmin']
], function(){
	//thong - tin - ca - nhan
	Route::get('thong-tin-ca-nhan/{username}','AdminController@viewPersonalInfoAdmin')->name('personal_infoAdmin');
	//route of students
	Route::get('list-students', 'AdminController@viewListStudents')->name('list_students');
	Route::get('add-students', 'AdminController@viewAddStudents')->name('add_students');
	Route::get('edit-students/{student_number}', 'AdminController@viewEditInfoStudents')->name('edit_infoStudents');
	Route::post('handle-post-add-infoStudents', 'AdminController@handlePostAddInfoStudents')->name('handlePostAddInfoStudents');
	Route::post('handle-post-edit-infoStudents/{student_numner}', 'AdminController@handlePostEditInfoStudents')->name('handlePostEditInfoStudents');
	Route::get('handle-post-del-infoStudents/{student_numner}', 'AdminController@handlePostDelInfoStudents')->name('handlePostDelInfoStudents');
	Route::get('student-result/{student_numner}', 'AdminController@viewResultOfStudents')->name('result_student');
	Route::get('student-result-summary/{class_id}', 'AdminController@viewResultSummary')->name('result_summary');
	//route of teachers
	Route::get('list-teachers', 'AdminController@viewListTeachers')->name('list_teachers');
	Route::get('add-teachers', 'AdminController@viewAddTeachers')->name('add_teachers');
	Route::get('edit-teachers/{teacher_number}', 'AdminController@viewEditInfoTeachers')->name('edit_infoTeachers');
	Route::post('handle-post-add-infoTeachers', 'AdminController@handlePostAddInfoTeachers')->name('handlePostAddInfoTeachers');
	Route::post('handle-post-edit-infoTeachers/{teacher_number}', 'AdminController@handlePostEditInfoTeachers')->name('handlePostEditInfoTeachers');
	Route::get('handle-post-del-infoTeachers/{teacher_number}', 'AdminController@handlePostDelInfoTeachers')->name('handlePostDelInfoTeachers');
	Route::get('detail-infoTeacher/{teacher_number}', 'AdminController@viewDetailInfoTeacher')->name('detail_infoTeacher');
	Route::get('add-thoi-khoa-bieu/{teacher_number}', 'AdminController@viewAddTKBTeachers')->name('add_TKB_teacher');
	Route::get('handle-del-thoi-khoa-bieu/{id}', 'AdminController@handleDelTKBTeachers')->name('handle_del_TKB_teacher');
	Route::post('handle-add-thoi-khoa-bieu/{teacher_number}', 'AdminController@handleAddTKBTeachers')->name('handle_add_TKB_teacher');

	//list classes
	Route::get('list-classes', 'AdminController@viewListClasses')->name('list_classes');
	Route::get('list-students/{class_name}', 'AdminController@listStudentsOfClass')->name('listStudentsOfClass');
	Route::get('list-classes/tkb/{class_name}', 'AdminController@viewTKBOfClass')->name('tkb_of_class');
	Route::get('add-class', 'AdminController@viewAddClass')->name('add_class');
	Route::post('handle-add-class', 'AdminController@handleAddClass')->name('handleAddClass');
	Route::get('edit-class/{class_id}', 'AdminController@viewEditClass')->name('edit_class');
	Route::post('handle-edit-class', 'AdminController@handleEditClass')->name('handleEditClass');
	Route::get('handle-del-class/{class_id}', 'AdminController@handleDelClass')->name('handleDelClass');

	//list rooms
	Route::get('list-rooms', 'AdminController@viewListRooms')->name('list_rooms');
	Route::get('add-room', 'AdminController@viewAddRoom')->name('add_room');
	Route::post('handle-add-room', 'AdminController@handleAddRoom')->name('handleAddRoom');
	Route::get('handle-del-room/{room_name}', 'AdminController@handleDelRoom')->name('handleDelRoom');

	//list subject
	Route::get('list-subjects', 'AdminController@viewListSubjects')->name('list_subjects');
	Route::get('add-subject', 'AdminController@viewAddSubject')->name('add_subject');
	Route::get('edit-subject/{subject_id}', 'AdminController@viewEditSubject')->name('edit_subject');
	Route::post('handle-add-subject', 'AdminController@handleAddSubject')->name('handleAddSubject');
	Route::get('handle-del-subject/{subject_number}', 'AdminController@handleDelSubject')->name('handleDelSubject');
	Route::post('handle-edit-subject/{subject_id}', 'AdminController@handleEditSubject')->name('handleEditSubject');

	// import, export excel 
	Route::get('students/export/{class_id}', 'AdminController@studentsExport')->name('studentsExport');
	Route::get('teachers/export', 'AdminController@teachersExport')->name('teachersExport');
	Route::get('students_result_summary/export/{class_id}', 'AdminController@resultSummaryExport')->name('resultSummaryExport');

});

//route teacher
Route::group([
	'prefix' => 'teacher',
	'namespace' => 'Teachers',
	'as' => 'teacher.',
	'middleware' => ['web','adminLogined','checkRoleTeacher']
],function(){
	Route::get('thong-tin-ca-nhan/{username}','TeachersController@viewPersonalInfoTeacher')->name('personal_infoTeacher');
	Route::get('thong-tin-ca-nhan/edit/{username}','TeachersController@viewEditPersonalInfoTeacher')->name('edit_personal_infoTeacher');
	Route::post('handle-edit-thong-tin-ca-nhan/{username}','TeachersController@handleEditPersonalInfoTeacher')->name('handle_edit_personal_infoTeacher');
	Route::get('lich-giang-day','TeachersController@viewTKBTeacher')->name('tkb_teacher');
	//list classes đang giảng dạy
	Route::get('list-classes','TeachersController@viewListClasses')->name('list_classes');
	Route::get('list-students/{class_id}', 'TeachersController@listStudentsOfClass')->name('listStudentsOfClass');
	Route::get('list-classes/tkb/{class_name}', 'TeachersController@viewTKBOfClass')->name('tkb_of_class');
	//list student
	Route::get('list-Students','TeachersController@viewListStudents')->name('list_students');
	//add point for student
	Route::get('add-point/{student_number}','TeachersController@viewAddPoint')->name('add_point');
	Route::get('add-multi-point/{class_name}','TeachersController@viewAddMultiPoint')->name('add_multi_point');
	Route::post('handle-post-add-point/{student_number}', 'TeachersController@handlePostAddPoint')->name('handlePostAddPoint');
	Route::post('handle-post-add-multi-point', 'TeachersController@handlePostAddMultiPoint')->name('handlePostAddMultiPoint');
	Route::get('student-result/{student_numner}', 'TeachersController@viewResultOfStudents')->name('result_student');
	// add multi conduct
	Route::get('add-multi-conduct/{class_name}','TeachersController@viewAddMultiConduct')->name('add_multi_conduct');
	Route::post('handle-add-multi-conduct','TeachersController@handleAddMultiConduct')->name('handleAddMultiConduct');
	// import, export excel 
	Route::get('students/export/{class_id}', 'TeachersController@studentsExport')->name('studentsExport');
});


Route::group([
	'prefix' => 'student',
	'namespace' => 'Students',
	'as' => 'student.',
	'middleware' => ['web','adminLogined','checkRoleStudent']
],function(){
	Route::get('thong-tin-ca-nhan/{username}','StudentsController@viewPersonalInfoStudent')->name('personal_infoStudent');
	Route::get('thong-tin-ca-nhan/edit/{username}','StudentsController@viewEditPersonalInfoStudent')->name('edit_personal_infoStudent');
	Route::post('handle-edit-thong-tin-ca-nhan/{username}','StudentsController@handleEditPersonalInfoStudent')->name('handle_edit_personal_infoStudent');
	Route::get('result', 'StudentsController@viewResultOfStudent')->name('result_student');
	Route::get('thoi-khoa-bieu', 'StudentsController@viewTKBOfStudent')->name('tkb_student');
	Route::get('danh-sach-lop-hoc', 'StudentsController@listInfoStudentByClass')->name('listInfoStudentByClass');
	Route::get('giao-vien-giang-day', 'StudentsController@listTeachers')->name('listTeachers');
});