<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StudentService;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(app(StudentService::class)->getAllStudents(), 200);
    }

    public function show($id)
    {
        return response()->json(app(StudentService::class)->getStudentById($id), 200);
    }
    
    public function store(Request $request)
    {
        return response()->json(app(StudentService::class)->createStudent($request->all()), 201);
    }
    
    public function update(Request $request, $id)
    {
        return response()->json(app(StudentService::class)->updateStudent($id, $request->all()), 200);
    }
    
    public function updatePartial(Request $request, $id)
    {
        return response()->json(app(StudentService::class)->updateStudentPartial($id, $request->all()), 200);
    }
    
    public function destroy($id)
    {
        return response()->json(app(StudentService::class)->deleteStudent($id), 204);
    }
}
