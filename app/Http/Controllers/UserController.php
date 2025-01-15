<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private function getObject($postID){

        $student = User::where('id', $postID)
               ->where('role', 'student')
               ->first();

        if (!$student) {
            abort(404, 'Post not found');
        }
    
        return $student;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $students = User::where('role','student')->get();
        return response()->json($students,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,  $userID)
    {
        $student = $this->getObject($userID);

        return response()->json($student,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $userID)
    {
        $student = $this->getObject($userID);

        $validated = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_initial'=>'required',
            'student_No'=>'required',
            'age'=>'required|integer|min:0|max:100',
            'address'=>'required',
            'username' => 'required|max:255',

        ]);

        $student->update($validated);
        return response()->json($student,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $userID)
    {
        $student = $this->getObject($userID);
        $student->delete();
        return response()->json(['message'=>'user has been delete'],200);
    }
}
