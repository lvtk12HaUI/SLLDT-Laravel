<aside class="sidebar" style="">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <div class="logo" >
                    <a href="{{ route('teacher_homePage') }}"><img src="img/logo1.png" alt="err" height="100%" width="auto"></a>
                </div>
            </div>
        </div>
        <nav class="menu">
            <p class="title-menu sidebar-menu" style="color: #988439">Danh mục quản lý</p>
            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                <p class="title-menu sidebar-menu title-category"><i class="far fa-calendar-alt"></i> Quản lý thông tin</p>
                <li class="sub-item"><a href="{{ route('teacher.tkb_teacher') }}">Lịch giảng dạy</a></li>
                <li class="sub-item"><a href="{{ route('teacher.list_classes') }}">Danh sách lớp</a></li>
                <li class="sub-item"><a href="{{ route('teacher.list_students') }}">Danh sách học sinh</a></li>
            </ul>
        </nav>
    </div>
</aside>