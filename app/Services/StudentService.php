<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentService
{
    public function getAllStudents()
    {
        $students = Student::all();
        return $students;
    }

    public function getStudentById($id)
    {
        $student = Student::find($id);
        if (!$student) {
            abort(404, 'Student not found');
        }
        return $student;
    }

    public function createStudent(array $data)
    {
        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:student,email',
            'phone' => 'required|string|max:20',
            'language' => 'required|string|max:10',
        ])->validate();

        $student = Student::create($data);
        return $student;
    }
    
    public function updateStudent($id, array $data)
    {
        $student = Student::find($id);
        if (!$student) {
           abort(404, 'Student not found');
        }

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:student,email,' . $id,
            'phone' => 'required|string|max:20',
            'language' => 'required|string|max:10',
        ])->validate();
        
        $student->update($data);
        return $student;
    }

    public function updateStudentPartial($id, array $data)
    {
        $student = Student::find($id);
        if (!$student) {
            abort(404, 'Student not found');
        }

        Validator::make($data, [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:student,email,' . $id,
            'phone' => 'sometimes|string|max:20',
            'language' => 'sometimes|string|max:10',
        ])->validate();
        
        $student->update($data);
        return $student;
    }
    
    public function deleteStudent($id)
    {
        $student = Student::find($id);
        if (!$student) {
            abort(404, 'Student not found');
        }
        $student->delete();
        return $student;
    }
}
