<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TeachersExport implements FromView
{
    public function __construct($infoTeachers) {
    	$this->infoTeachers = $infoTeachers;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('master.homePage.exports.teachers', [
            'infoStudents' => $this->infoTeachers,
        ]);
    }
}
