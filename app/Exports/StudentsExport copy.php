<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Student::select('id', 'name', 'email', 'phone', 'gender', 'date_of_birth', 'status', 'package', 'duration')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Phone', 'Gender', 'Date of Birth', 'Status', 'Package', 'Duration'];
    }
}

