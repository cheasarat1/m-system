<?php

namespace App\Http\Controllers;

use Auth;
use App\Score;
use App\Question;
use Carbon\Carbon;
use App\Evaluation;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $evaluations = DB::table('evaluations')
                ->join('users', 'users.id', '=', 'evaluations.created_by')
                ->join('schools', 'schools.id', '=', 'evaluations.school_id')
                ->select([
                    'evaluations.id',
                    'evaluations.date',
                    'evaluations.created_at',
                    'schools.name as school',
                    'users.name as user'
                ]);

            (Auth::user()->hasRole('district')) ? $evaluations->where('users.district_id', '=', Auth::user()->district->id) : '';
            (Auth::user()->hasRole('province')) ? $evaluations->where('users.province_id', '=', Auth::user()->province->id) : '';
            (Auth::user()->hasRole('evaluation')) ? $evaluations->where('evaluations.created_by', '=', Auth::user()->id) : '';

            if (empty($request->duplicate)) {
                $evaluations = $evaluations->orderBy('evaluations.date', 'ASC')
                    ->get()
                    ->keyBy('school')
                    ->unique();
            }

            return Datatables::of($evaluations)
                ->addColumn('action', function ($evaluation){
                    $edit = "<a href='". route("evaluation.edit",$evaluation->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
                    $delete = "<a href='' class='tip remove btn btn-danger btn-xs' title='delete'><i class='fa fa-trash-o'></i></a>";

                    $button = "<div class='text-center'>";
                    $button .= "<div class='btn-group'>";
                    $button .= ($evaluation->created_at >= Carbon::now()->subDay()) ? $edit : '';
                    $button .= ($evaluation->created_at >= Carbon::now()->subDay()) ? $delete : '';
                    $button .= "</div>";
                    $button .= "</div>";
                    return $button;
                })
                ->make(true);
        }

        return view('evaluation.index');
    }

    public function create()
    {
        return view('evaluation.create', [
            'questions' => Question::where('question_id', '=', 0)->with('childrenQuestions')->get()
        ]);
    }

    public function store(Request $request)
    {
        $evaluation = Evaluation::create([
            'school_id' => $request->school_id,
            'date' => date('Y-m-d H:i:s'),
            'total' => $request->total
        ])->id;

        $scores = $request->input('scores');
        foreach ($scores as $score) {
            $score['evaluation_id'] = $evaluation;
            Score::create($score);
        }

        return response()->json(['success' => true, 'evaluation' => $evaluation], 200);
    }

    public function show(Evaluation $evaluation)
    {
        //
    }

    public function edit(Evaluation $evaluation)
    {
        return view('evaluation.edit', [
            'questions' => Question::where('question_id', '=', 0)->with('childrenQuestions')->get(),
            'evaluation' => $evaluation
        ]);
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $evaluation->total = $request->total;
        $evaluation->save();

        $scores = $request->input('scores');
        foreach ($scores as $score) {
            Score::where('evaluation_id', '=', $evaluation->id)
                ->where('question_id', '=', $score['question_id'])
                ->update($score);
        }
        
        return response()->json(['success' => true], 200);
    }

    public function destroy(Evaluation $evaluation)
    {
        //
    }

    public function effective(Request $request)
    {
        Evaluation::where('id', '=', $request->id)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->update(['effective' => $request->effective]);
        return '';
    }
}
