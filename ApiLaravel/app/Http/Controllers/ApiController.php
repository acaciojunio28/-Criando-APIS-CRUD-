<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\api;

class ApiController extends Controller
{
    public function getAllStudents() {
      $students = api::get()->toJson(JSON_PRETTY_PRINT);
      return response($students, 200);
      }
  
      public function createStudent(Request $request) {
    $student = new api;
    $student->name = $request->name;
    $student->email = $request->email;
    $student->msg = $request->msg;
    $student->save();

    return response()->json([
        "message" => "cadastrado com sucesso."
    ], 201);
      }
  
      public function getStudent($id) {
        if (api::where('id', $id)->exists()) {
          $student = api::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
          return response($student, 200);
        } else {
          return response()->json([
            "message" => "Estudante não existe."
          ], 404);
        }
      }
  
      public function updateStudent(Request $request, $id) {
        if (api::where('id', $id)->exists()) {
          $student = api::find($id);
          $student->name = is_null($request->name) ? $student->name : $request->name;
          $student->email = is_null($request->email) ? $student->email : $request->email;
          $student->msg = is_null($request->msg) ? $student->msg : $request->msg;
          $student->save();
  
          return response()->json([
              "message" => "Atualizado com sucesso."
          ], 200);
          } else {
          return response()->json([
              "message" => "Estudante não existe."
          ], 404);
      }
    }
      public function deleteStudent ($id) {
        if(api::where('id', $id)->exists()) {
          $student = api::find($id);
          $student->delete();
  
          return response()->json([
            "message" => "Deletado com Sucesso"
          ], 202);
        } else {
          return response()->json([
            "message" => "Estudante não existe."
          ], 404);
      }
  }
}