<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentsExport implements FromView
{
    public function __construct(object $infoStudents, object $class) {
    	$this->infoStudents = $infoStudents;
        $this->class = $class;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('master.homePage.exports.students', [
            'infoStudents' => $this->infoStudents,
            'class' => $this->class
        ]);
    }
}
