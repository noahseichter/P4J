<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\Evaluation;
use Illuminate\Http\Request;

class StudentController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['index', 'show']]);
        $this->middleware('student', ['except' => ['index']]);
    }

    protected $redirectTo = '/student';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $students = Student::all()->sortBy('last_name');
        } else {
            $students = auth()->user()->students;   
        }
        
        foreach($students as $student) {
	        
	        $fall = array();
		    $winter = array();
		    $spring = array();
	        
	        for($i = 1; $i <= 5; $i++) {
		    	
		    	$eval = Evaluation::where('student_id', '=', $student->id)->where('semester', '=', 'fall')->where('domain', '=', $i)->first();
		    	if ($eval) {
			    	$fall[$i] = ( $eval->status === 1) ? 'Complete' : 'In Progress';
		    	} else {
			    	$fall[$i] = 'X';
		    	}
		    	
		    	$eval = Evaluation::where('student_id', '=', $student->id)->where('semester', '=', 'winter')->where('domain', '=', $i)->first();
		    	if ($eval) {
			    	$winter[$i] = ( $eval->status === 1) ? 'Complete' : 'In Progress';
		    	} else {
			    	$winter[$i] = 'X';
		    	}
		    	
		    	$eval = Evaluation::where('student_id', '=', $student->id)->where('semester', '=', 'spring')->where('domain', '=', $i)->first();
		    	if ($eval) {
			    	$spring[$i] = ( $eval->status === 1) ? 'Complete' : 'In Progress';
		    	} else {
			    	$spring[$i] = 'X';
		    	}
		        
	        }
	        
	        $student['fall'] = $fall;
	        $student['winter'] = $winter;
	        $student['spring'] = $spring;
	        
        }
        
        return view('student.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

         return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $student = Student::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'birth_date' => $request['birth_date'],
            'site' => $request['site'],
            'start_date' => $request['start_date'],
            'class' => $request['class'],
            'EL' => ($request['EL'] === 'on') ? 1 : 0,
            'EC' => ($request['EC'] === 'on') ? 1 : 0,
            'IEP_Speech' => ($request['IEP_Speech'] === 'on') ? 1 : 0
        ]);

        return redirect()->route('student.show', [$student->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return redirect()->route('student.domain.index', [$id, 1]);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $student = Student::findOrFail($id);

        return view('student.edit')->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $student = Student::findOrFail($id);

        $student->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'birth_date' => $request['birth_date'],
            'site' => $request['site'],
            'start_date' => $request['start_date'],
            'class' => $request['class'],
            'EL' => ($request['EL'] === 'on') ? 1 : 0,
            'EC' => ($request['EC'] === 'on') ? 1 : 0,
            'IEP_Speech' => ($request['IEP_Speech'] === 'on') ? 1 : 0
        ]);

        return redirect()->route('student.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Student::destroy($id);

        return redirect()->route('student.index');
    }

    public function showUsers($student_id) {

        $student = Student::findOrFail($student_id);
        $teachers = $student->teachers;

        $domain_number = 6;

        $all_users = collect(User::all())->whereNotIn('id', collect($teachers)->pluck('id'))->sortBy('first_name');
        
        return view('student.teacher')->with('student', $student)->with('teachers', $teachers)->with('all_users', $all_users)->with('domain_number', $domain_number);
    }

    public function addUser(Request $request, $student_id) {

        $student = Student::findOrFail($student_id);

        $user = User::findOrFail($request->user);

        $student->teachers()->save($user);

        return redirect()->route('student.user.show', [$student_id]);
    }

    public function removeUser($student_id, $user_id) {

        $user = User::findOrFail($user_id);

        $student = Student::findOrFail($student_id);

        $user->students()->detach($student);

        return redirect()->route('student.user.show', [$student_id]);
    }
}
