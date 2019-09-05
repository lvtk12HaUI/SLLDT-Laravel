<aside class="sidebar" style="">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <div class="logo" >
                    <a href="{{ route('student_homePage') }}"><img src="img/logo1.png" alt="err" height="100%" width="auto"></a>
                </div>
            </div>
        </div>
        <nav class="menu">
            <p class="title-menu sidebar-menu" style="color: #988439">Danh mục quản lý</p>
            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                <li class="sub-item"><a href="{{ route('student.result_student') }}">Bảng điểm</a></li>
                <li class="sub-item"><a href="{{ route('student.tkb_student') }}">Thời khóa biểu</a></li>
                <li class="sub-item"><a href="{{ route('student.listInfoStudentByClass') }}">Danh sách lớp</a></li>
                <li class="sub-item"><a href="{{ route('student.listTeachers') }}">Giáo viên giảng dạy</a></li>
            </ul>
        </nav>
    </div>
</aside>