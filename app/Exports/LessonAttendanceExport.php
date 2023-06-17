<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LessonAttendanceExport implements FromCollection, WithTitle, WithHeadings
{
    private $lesson_name;
    private $lesson_data;

    public function __construct($lesson_name, $lesson_data)
    {
        $this->lesson_name = $lesson_name;
        $this->lesson_data = $lesson_data;
    }

    public function collection()
    {
        return collect($this->lesson_data);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return substr($this->lesson_name, 0, 25);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Student Mobile',
            'Parent Mobile',
            'Email',
            'Code',
            'Attended at',
            'Complete Lesson',
        ];
    }
}
