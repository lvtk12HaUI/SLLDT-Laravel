<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResultSummaryExport implements FromView
{

    public function __construct(object $infoClass, object $infoSubjects, object $infoPoint) {
    	$this->infoClass = $infoClass;
        $this->infoSubjects = $infoSubjects;
        $this->infoPoint = $infoPoint;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('master.homePage.exports.result_summary', [
            'infoClass' => $this->infoClass,
            'infoSubjects' => $this->infoSubjects,
            'infoPoint' => $this->infoPoint
        ]);
    }
}

