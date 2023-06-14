<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\lecturers;
use App\Models\student;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Mail as FacadesMail;

class HomeController extends Controller
{
    private $im;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application welcome.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('welcome');
    }
    public function index(Request $request)
    {   
        $lecturers = User::where('level', 1)->count();
        $students = User::where('level', 2)->count();
        $department = count(department::all());
        
        // dd(count($department));
        // dd($students);
        return view('dashboard',compact('lecturers', 'students','department'));
    }
    public function student(Request $request){
        $students = DB::table('users')
            ->select('*')
            ->join('student', 'student.id_student', '=', 'users.id')
            ->join('department', 'department.id', '=', 'student.department')
            ->get();
            // dd($students);
            $department = department::all();
            // dd($department);
        return view('admin.student',compact('students','department'));
    }
    public function create(Request $request){
        $validatedData  = $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
        ]);
        // dd($request->all());        
        $name = $request->get('name');
        $username = $request->get('username');
        $email = $request->get('email');
        $password = Hash::make($request->get('password'));
        $level = 2;
        $department = $request->get('department');
        $scores = $request->get('grade');
        $id =  DB::table('users')->insertGetId([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'level' => $level,
        ]);
        DB::table('student')->insert([
            'department' => $department,
            'scores' => $scores,
            'id_student' => $id,
        ]);
        return redirect()->route('admin.student');
    }
    public function delete($id){
        User::where('id',$id)->delete();
        student::where('id_student',$id)->delete();
        return redirect()->route('admin.student');
    }
    public function update($id,Request $request){
        
        
        $user = User::where("id", $id)->update([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
        ]);
        
        if($request->department == "Chọn Khoa"){
            $student = student::where("id_student", $id)->update([
                "scores" => $request->grade,
            ]);
        }
        
        return redirect()->route('admin.student');

    }

    public function change_language($language)
    {
        Session::put('language', $language);
        return redirect()->back();
    }
    public function viewMail($id){
        $students = DB::table('users')
        ->select('*')
        ->join('student', 'student.id_student', '=', 'users.id')
        ->join('department', 'department.id', '=', 'student.department')
        ->get();
        // dd($students);
        $department = department::all();
        // dd($department);
    return view('admin.mail',compact('students','department'));
    }
    public function sendMail($id){
        $student = User::find($id);
        // dd($student);
        $students = DB::table('users')
            ->select('*')
            ->join('student', 'student.id_student', '=', 'users.id')
            ->join('department', 'department.id', '=', 'student.department')
            ->where('student.id_student','=', $id)
            ->get();
            $department = department::all();
        $mailData = [
            'title' =>'Điểm số của sinh viên',
            'body' => '',
            'students'=> $students,
            'department'=> $department,
        ];
        Mail::to($students[0]->email)->send(new DemoMail($mailData));
        return redirect()->route('admin.student');
    }
    public function department(){
        $department = department::all();
        // dd($department);
        return view('admin.department',compact('department'));
    }
    public function create_department(Request $request){
        DB::table('department')->insert([
            'department' => $request->get('department'),
        ]);
        return redirect()->route('admin.department');
    }
    public function delete_department($id){
        department::where('id',$id)->delete();
        return redirect()->route('admin.department');
    }
    public function edit_department($id,Request $request){
        department::where("id", $id)->update([
            "department" => $request->department,
        ]);
        // dd($request->department);
        return redirect()->route('admin.department');
    }


}
