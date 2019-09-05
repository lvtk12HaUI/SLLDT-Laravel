<header class="header">
    <div class="header-block header-block-collapse d-lg-none d-xl-none">
        <button class="collapse-btn" id="sidebar-collapse-btn">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <marquee>
        <h4>TRƯỜNG TRUNG HỌC CƠ SỞ <b>CÁT QUẾ A</b></h4>
    </marquee>

    <div class="header-block header-block-nav">
        <ul class="nav-profile">

            <li class="profile dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">
                    <div class="img" style="background-image: url('img/boy.png')"> </div>
                    <span class="name"> {{ Session::get('username') }} </span>
                </a>
                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                    <a class="dropdown-item" href="{{ route('teacher.personal_infoTeacher',Session::get('username')) }}">
                        <i class="fa fa-user icon"></i> Thông tin cá nhân </a>
                    <a class="dropdown-item" href="{{ route('change_password',Session::get('username')) }}">
                        <i class="fa fa-gear icon"></i> Đổi mật khẩu </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{route('handleLogout')}}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fa fa-power-off icon" style="color:#fd7e14;"></i> Đăng xuất 
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</header>