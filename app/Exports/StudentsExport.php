<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    protected $students;

    public function __construct($students)
    {
        // Convert comma-separated string to an array
        $this->students = explode(',', $students);
    }

    public function collection()
    {
        return Student::whereIn('uuid', $this->students)
                      ->select('name', 'email', 'phone', 'gender', 'date_of_birth', 'status', 'package', 'duration') // Add needed columns
                      ->get();
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Phone', 'Gender', 'Date of Birth', 'Status', 'Package', 'Duration'];
    }
}


