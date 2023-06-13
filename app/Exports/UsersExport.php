<?php

namespace App\Exports;

use App\Models\User;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class UsersExport extends DefaultValueBinder implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithCustomValueBinder
{
    use Exportable;

    private $course;

    public function __construct($course)
    {
        $this->course = $course;
    }

    public function query()
    {
        return User::query()->with('group')->where('course_id', $this->course->id);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Student Mobile',
            'Parent Mobile',
            'Email',
            'Password',
            'Code',
            'Created at',
            'Group Name'
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        return parent::bindValue($cell, $value);
    }

    public function map($student): array
    {
        if (strlen(substr($student->email, 0, strpos($student->email, '@'))) > 6) {
            $password = substr($student->email, 0, strpos($student->email, '@')) . $student->code;
        } else {
            $password = $student->code . substr($student->email, 1, 3);
        }

        return [
            $student->name ?? "",
            $student->mobile ?? "",
            $student->parent_mobile ?? "",
            $student->email,
            (string)$password,
            strtoupper($student->code),
            $student->created_at->format('d/m/Y'),
            !is_null($student->group) ? $student->group->name : '',
        ];
    }
}
