<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <div class="logo">
                    <a href="{{ route('admin_homePage') }}"><img src="img/logo1.png" alt="err" height="100%" width="auto"></a>
                </div>
            </div>
        </div>
        <nav class="menu">
            <p class="title-menu sidebar-menu">Danh mục quản lý</p>
            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                <p class="title-menu sidebar-menu title-category"><i class="far fa-calendar-alt"></i> Quản lý thông tin</p>
                <li class="sub-item"><a href="{{ route('admin.list_teachers') }}">Danh sách giáo viên</a></li>
                <li class="sub-item"><a href="{{ route('admin.list_students') }}">Danh sách học sinh</a></li>
                <li class="sub-item"><a href="{{ route('admin.list_classes') }}">Danh sách lớp học</a></li>
                <li class="sub-item"><a href="{{ route('admin.list_subjects') }}">Danh sách môn học</a></li>
                <li class="sub-item"><a href="{{ route('admin.list_rooms') }}">Danh sách phòng học</a></li>
            </ul>
        </nav>
    </div>
</aside>