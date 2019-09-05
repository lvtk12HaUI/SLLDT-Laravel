<?php

namespace App\Http\Controllers\HomePage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Accounts;

class HomePageController extends Controller
{
	public function viewAdminHomePage(){  
    	return view('master.homePage.admin-homePage.admin-homePage');
    }

	public function viewTeacherHomePage(){  
    	return view('master.homePage.teacher-homePage.teacher-homePage');
    }

    public function viewStudentHomePage(){  
    	return view('master.homePage.student-homePage.student-homePage');
	}

}
