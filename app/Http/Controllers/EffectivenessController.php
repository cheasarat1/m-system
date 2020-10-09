<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EffectivenessController extends Controller
{
    public function effectiveness(Request $request)
    {

        $scoresI = DB::table('scores')
            ->join('questions', 'questions.id', '=', 'scores.question_id')
            ->join('evaluations', 'evaluations.id', '=', 'scores.evaluation_id')
            ->join('schools', 'schools.id', '=', 'evaluations.school_id')
            ->whereIn('questions.id', [7, 24, 69, 168, 173, 86, 92, 179, 186, 189, 192, 225])
            ->where('schools.id', '=', $request->school)
            ->where('evaluations.id', '=', $request->evaluation)
            ->select(
                'questions.id as id',
                'questions.name as name',
                'scores.score1 as score1',
                'scores.score2 as score2',
                'scores.score3 as score3',
                'scores.total as total'
            )
            ->get();

        $scoresII = DB::table('scores')
            ->join('questions', 'questions.id', '=', 'scores.question_id')
            ->join('evaluations', 'evaluations.id', '=', 'scores.evaluation_id')
            ->join('schools', 'schools.id', '=', 'evaluations.school_id')
            ->whereIn('questions.id', [3, 11, 18, 146, 151, 156, 211, 216, 221])
            ->where('schools.id', '=', $request->school)
            ->where('evaluations.id', '=', $request->evaluation)
            ->select(
                'questions.id as id',
                'questions.name as name',
                'scores.score1 as score1',
                'scores.score2 as score2',
                'scores.score3 as score3',
                'scores.total as total'
            )
            ->get();

        return response()->json([
            'effective' => view('evaluation.effective', [
                'sectionI' => $scoresI,
                'sectionII' => $scoresII
            ])->render()
        ]);
    }

    public function print()
    {
        return view('print');
    }
}
