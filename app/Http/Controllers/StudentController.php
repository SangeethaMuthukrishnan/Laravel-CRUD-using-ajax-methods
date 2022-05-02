<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function index()
    {
    return view('students.index');
    }

    //fetching records from database after the Create,update, delete

     public function fetch_student()
     {
        $student = Student::all();
        return response()->json([
            'students'=>$student,
        ]);
     }
     //store method

    public function store(Request $request)
    {

        //validating input fields

        $validator= validator::make($request->all(),
            [
             'name'=>'required|max:191',
             'email'=>'required|max:180',
              'phone'=>'required|max:180',
              'course'=>'required|max:180'
            ]);

        // if validation fails returns error message

        if($validator->fails()) {
            return response()->json([
                'status' => '400',
                'errors' => $validator->messages(),
            ]);

        }

        // validation pass, save the input data

        else
        {
            $student = new Student();
            $student->name=$request->input('name');
            $student->email=$request->input('email');
            $student->phone=$request->input('phone');
            $student->course=$request->input('course');
            $student->save();
            return response()->json([
                'status'=>'230',
                'message'=>'Student added successfully'
            ]);
        }
    }

    //student_edit method

      public function edit($id)
      {
        $student = Student::find($id);

     //if we get the right data, returns success response

        if($student)
        {
            return response()->json([
                'status'=>'200',
                'student'=>$student,
            ]);
         }
        //or it is not working,then returns error message
        else
        {
            return response()->json([
                'status'=>'404',
                'message'=>'Data not found'
            ]);
        }
    }

    // student_data_update_method

    public function update(Request $request,$id)
    {

    //validation checks for input fields

        $validator = validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|max:180',
            'phone' => 'required|max:180',
            'course' => 'required|max:180'
        ]);
     //if validation fails

        if ($validator->fails()) {
            return response()->json([
                'status' => '400',
                'errors' => $validator->messages(),
            ]);
        }
        // validation rule passes- then update the data using 'Student' model
        else
        {
            $student = Student::find($id);

        //if we get the right data and validation passes, then updating data here

            if ($student)
            {
                $student->name = $request->input('name');
                $student->email = $request->input('email');
                $student->phone = $request->input('phone');
                $student->course = $request->input('course');
                $student->update();
                return response()->json([
                    'status' => '200',
                    'message' => 'Student updated successfully'
                ]);
            }

            else
            {
                return response()->json([
                    'status' => '404',
                    'message' => 'Data not found'
                ]);
            }

        }
    }

    // delete_student record

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return response()->json([
            'status' => '200',
            'message' => 'Student data deleted successfully',
        ]);
    }









}
