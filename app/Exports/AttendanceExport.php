<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AttendanceExport implements WithMultipleSheets
{
    use Exportable;

    protected $lessons;

    public function __construct($lessons)
    {
        $this->lessons = $lessons;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->lessons as $key => $lesson) {
            $sheets[] = new LessonAttendanceExport($key, $lesson);
        }


        return $sheets;
    }
}
