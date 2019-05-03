<?php

namespace App\Http\Controllers;

use App\Student;
use App\Criteria;
use App\Evaluation;
use App\User;
use Illuminate\Http\Request;

class DomainController extends Controller
{
	
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($student_id, $domain_number)
    {
        //

        $form_array = json_decode(file_get_contents(public_path().'/json/domains.json'),true)[$domain_number];

        $student = Student::findOrFail($student_id);
        $teachers = $student->teachers;

        $fall = $student->evaluations->where('domain', $domain_number)->where('semester', 'fall')->sortByDesc('id')->sortByDesc('created_at')->first();
        if ($fall) {
            foreach($fall->criterion as $crit) {
                $fall[$crit->field_name] = $crit->score; 
            }
            unset($fall['criterion']);
            $user = User::findOrFail($fall->user_id);
            $fall['user_name'] = $user->first_name.' '.$user->last_name;
        }
        $winter = $student->evaluations->where('domain', $domain_number)->where('semester', 'winter')->sortByDesc('id')->sortByDesc('created_at')->first();
        if ($winter) {
            foreach($winter->criterion as $crit) {
                $winter[$crit->field_name] = $crit->score; 
            }
            unset($winter['criterion']);
            $user = User::findOrFail($winter->user_id);
            $winter['user_name'] = $user->first_name.' '.$user->last_name;
        }
        $spring = $student->evaluations->where('domain', $domain_number)->where('semester', 'spring')->sortByDesc('id')->sortByDesc('created_at')->first();
        if ($spring) {
            foreach($spring->criterion as $crit) {
                $spring[$crit->field_name] = $crit->score; 
            }
            unset($spring['criterion']);
            $user = User::findOrFail($spring->user_id);
            $spring['user_name'] = $user->first_name.' '.$user->last_name;
        }
        

        $all_users = collect(User::all())->whereNotIn('id', collect($teachers)->pluck('id'))->sortBy('first_name');

       return view('student.show')->with('student', $student)->with('teachers', $teachers)->with('all_users', $all_users)->with('form_array', $form_array)->with('fall_all', $fall)->with('winter_all', $winter)->with('spring_all', $spring)->with('domain_number', $domain_number);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($student_id, $domain_number, $semester)
    {
        //

        $form_array = json_decode(file_get_contents(public_path().'/json/domains.json'),true)[$domain_number];

        $criteria = $form_array['Criteria'];

        $title = $form_array['domain_name'];

        $student = Student::findOrFail($student_id);
        if ($domain_number != 4) {
            return view('domain.create')->with('student', $student)->with('domain', $domain_number)->with('criteria', $criteria)->with('title', $title)->with('semester', $semester);
        }

        $fall = $student->evaluations->where('domain', $domain_number)->where('semester', 'fall')->sortByDesc('id')->sortByDesc('created_at')->first();
        if ($fall) {
            foreach($fall->criterion as $crit) {
                $fall[$crit->field_name] = $crit->score; 
            }
            unset($fall['criterion']);
        }
    
        $spring = $student->evaluations->where('domain', $domain_number)->where('semester', 'spring')->sortByDesc('id')->sortByDesc('created_at')->first();
        if ($spring) {
            foreach($spring->criterion as $crit) {
                $spring[$crit->field_name] = $crit->score; 
            }
            unset($spring['criterion']);
        }

        if ($semester === 'spring') {
            return view('domain.create')->with('student', $student)->with('domain', $domain_number)->with('criteria', $criteria)->with('title', $title)->with('semester', $semester)->with('fall', $fall);
        } else {
            return view('domain.create')->with('student', $student)->with('domain', $domain_number)->with('criteria', $criteria)->with('title', $title)->with('semester', $semester)->with('spring', $spring);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $student_id, $domain_id)
    {
        $action = $request->action;
        
        $status = ($action === 'save') ? 0 : 1;
		
		
		
        $eval = Evaluation::create([
            'domain' => $domain_id,
            'semester' => $request->semester,
            'user_id' => auth()->user()->id,
            'student_id' => $student_id,
            'status' => $status,
            'created_at' => $request->date,
            'class' => $request->class,
            'comments' => ($request->comments == null) ? '' : $request->comments
        ]);

        foreach($request->all() as $key => $value) {

            if ( $key === '_token' || $key === 'action' || $key === 'semester' || $key === 'date' || $key === 'class' || $key === 'comments' ) continue;

            $value = ($value == null) ? 0 : $value;

            Criteria::create([
                'evaluation_id' => $eval->id,
                'field_name' => $key,
                'score' => $value
            ]);

        }
        
        return redirect()->route('student.domain.index', [$student_id, $domain_id]);
        
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($student_id, $domain_id)
    {
        //
        $eval = Evaluation::findOrFail($domain_id);
        $semester = $eval->semester;

        $domain_number = $eval->domain;
        $form_array = json_decode(file_get_contents(public_path().'/json/domains.json'),true)[$domain_number];

        $criteria = $form_array['Criteria'];

        $title = $form_array['domain_name'];

        $eval = Evaluation::findOrFail($domain_id);
        if ($eval) {
            foreach($eval->criterion as $crit) {
                $eval[$crit->field_name] = $crit->score; 
            }
            unset($eval['criterion']);
        }

        $student = Student::findOrFail($eval->student_id);

        if ($domain_number !=4) {
            return view('domain.edit')->with($semester, $eval)->with('student', $student)->with('criteria', $criteria)->with('title', $title)->with('domain', $domain_number)->with('semester', $semester)->with('eval', $eval);
        }

        if ($semester == 'fall') {
            $spring = $student->evaluations->where('domain', $domain_number)->where('semester', 'spring')->sortByDesc('id')->sortByDesc('created_at')->first();
            if ($spring) {
                foreach($spring->criterion as $crit) {
                    $spring[$crit->field_name] = $crit->score; 
                }
                unset($spring['criterion']);
            }
            return view('domain.edit')->with('fall', $eval)->with('student', $student)->with('criteria', $criteria)->with('title', $title)->with('domain', $domain_number)->with('semester', $semester)->with('eval', $eval)->with('spring', $spring);
        } else {
            $fall = $student->evaluations->where('domain', $domain_number)->where('semester', 'fall')->sortByDesc('id')->sortByDesc('created_at')->first();
            if ($fall) {
                foreach($fall->criterion as $crit) {
                    $fall[$crit->field_name] = $crit->score; 
                }
                unset($fall['criterion']);
            }
            return view('domain.edit')->with('spring', $eval)->with('student', $student)->with('criteria', $criteria)->with('title', $title)->with('domain', $domain_number)->with('semester', $semester)->with('eval', $eval)->with('fall', $fall);
        }


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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $id)
    {
        //
        $domain = Evaluation::findOrFail($id)->domain;

        Evaluation::destroy($id);

        return redirect()->route('student.domain.index', [$user_id, $domain]);
    }
}
