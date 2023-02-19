<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel, SkipsOnFailure, WithValidation, WithHeadingRow
{
    use SkipsFailures, Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            'lrn' => $row['lrn'],
            'student_no' => $row['student_no'],
            'email' => $row['email'],
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'suffix' => $row['suffix'],
            'birthday' => $row['birthday']
        ]);
    }

    public function rules(): array
    {
        return [
            'lrn' => 'required|digits:12|min:12|max:12|unique:students,lrn',
            'student_no' => 'required|unique:students,student_no',
            'email' => 'required|email|unique:students,email',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'birthday' => 'required|date'
        ];
    }
}
