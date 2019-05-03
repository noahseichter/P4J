<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\Evaluation;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = User::all()->sortBy('last_name');

        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $user = User::findOrFail($id);

        $students = $user->students;

        $all_students = collect(Student::all())->whereNotIn('id', collect($students)->pluck('id'))->sortBy('first_name');

        return view('user.show')->with('user', $user)->with('students', $students)->with('all_students', $all_students);
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

        $user = User::findOrFail($id);

        return view('user.edit')->with('user', $user);
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

        $user = User::findOrFail($id);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'site' => $request->site,
            'email' => $request->email
        ]);

        return redirect()->route('user.show', [$id]);
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
        $user = User::destroy($id);

        return redirect()->route('user.index');
    }

    public function addStudent(Request $request, $user_id) {

        $user = User::findOrFail($user_id);

        $student = Student::findOrFail($request->student);

        $user->students()->save($student);

        return redirect()->route('user.show', [$user_id]);
    }

    public function removeStudent($user_id, $student_id) {

        $user = User::findOrFail($user_id);

        $student = Student::findOrFail($student_id);

        $user->students()->detach($student);

        return redirect()->route('user.show', [$user_id]);
    }
    
    public function statistics($student_id, $domain_number) {
	    
	    $user = User::findOrFail($student_id);
	    
	    $form_array = json_decode(file_get_contents(public_path().'/json/domains.json'),true)[$domain_number];
	    
	    return view('user.statistics')->with('user', $user)->with('domain_number', $domain_number)->with('form_array', $form_array);
    }
}
