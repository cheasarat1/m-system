<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('question.index');
    }

    public function create()
    {
        return view('question.create', [
            'questions' => Question::where('question_id', '=', 0)->with('childrenQuestions')->get()
        ]);
    }

    public function store(Request $request)
    {
        $question = Question::create([
            'name' => $request->name,
            'question_id' => (empty($request->question_id)) ? 0 : $request->question_id,
            'order' => (empty($request->order)) ? 1 : $request->order
        ]);

        return response()->json(['success' => ($question) ? true : false], 200);
    }

    public function show(Question $question)
    {
        //
    }

    public function edit(Question $question)
    {
        return view('question.edit', [
            'editQuestion' => $question,
            'questions' => Question::where('question_id', '=', 0)->with('childrenQuestions')->get()
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $question->name = $request->name;
        $question->question_id = (empty($request->question_id)) ? 0 : $request->question_id;
        $question->order = (empty($request->order)) ? 1 : $request->order;

        return response()->json(['success' => ($question->save()) ? true : false], 200);
    }

    public function destroy(Question $question)
    {
        //
    }

    public function dataTable()
    {
        $questions = DB::table('questions as question')
            ->leftjoin('questions as parent', 'parent.id', '=', 'question.question_id')
            ->select([
                'question.id',
                'question.name',
                'parent.name as parent',
                'question.order'
            ]);

        return Datatables::of($questions)
            ->addColumn('action', function ($question){
                $edit = "<a href='". route("question.edit",$question->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
                $delete = "<a href='' class='tip remove btn btn-danger btn-xs' title='delete'><i class='fa fa-trash-o'></i></a>";

                $button = "<div class='text-center'>";
                $button .= "<div class='btn-group'>";
                $button .= $edit;
                $button .= $delete;
                $button .= "</div>";
                $button .= "</div>";
                return $button;
            })
            ->make(true);
    }
}
