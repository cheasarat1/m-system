<?php

namespace App\Http\Controllers;

use Auth;
use App\Zone;
use App\Level;
use App\School;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function effectiveness(Request $request)
    {
        if ($request->ajax()) {
            $evaluations = DB::table('evaluations')
                ->join('schools', 'schools.id', '=', 'evaluations.school_id')
                ->join('levels', 'levels.id', '=', 'schools.level_id')
                ->join('zones', 'zones.id', '=', 'schools.zone_id')
                ->join('communes', 'communes.id', '=', 'schools.commune_id')
                ->join('districts', 'districts.id', '=', 'communes.district_id')
                ->join('provinces', 'provinces.id', '=', 'districts.province_id')
                ->join('users', 'users.id', '=', 'evaluations.created_by')
                ->select([
                    'evaluations.date as date',
                    'evaluations.effective',
                    DB::raw('FIND_IN_SET(evaluations.effective, (SELECT GROUP_CONCAT(evaluations.effective ORDER BY evaluations.effective DESC) FROM evaluations)) as rank'),
                    'evaluations.id',
                    'schools.code',
                    'schools.id as school',
                    'schools.name',
                    'levels.name as level',
                    'zones.name as zone',
                    DB::raw("CONCAT(provinces.name, ' ', districts.name, ' ', communes.name) as location")
                ])
                ->orderBy('evaluations.effective', 'DESC');

                (Auth::user()->hasRole('district')) ? $evaluations->where('users.district_id', '=', Auth::user()->district->id) : '';
                (Auth::user()->hasRole('province')) ? $evaluations->where('users.province_id', '=', Auth::user()->province->id) : '';
                (Auth::user()->hasRole('evaluation')) ? $evaluations->where('evaluations.created_by', '=', Auth::user()->id) : '';

                (!empty($request->start)) ? $evaluations->where('evaluations.date', '>=', Carbon::createFromFormat('d-m-Y', $request->start)->format('Y-m-d')) : '' ;
                (!empty($request->end)) ? $evaluations->where('evaluations.date', '<=', Carbon::createFromFormat('d-m-Y', $request->end)->format('Y-m-d')) : '' ;

                (!empty($request->level)) ? $evaluations->where('levels.id', '=', $request->level) : '' ;
                (!empty($request->zone)) ? $evaluations->where('zones.id', '=', $request->zone) : '' ;
                (!empty($request->orientation)) ? $evaluations->whereBetween('evaluations.effective', explode(',', $request->orientation)) : '' ;

            return Datatables::of($evaluations)->make(true);
        }
        
        return view('report.effectiveness', [
            'levels' => Level::select('id', 'name')->get(),
            'zones' => Zone::select(['id', 'name'])->get()
        ]);
    }

    public function detail(Request $request)
    {

        $school = DB::table('schools')
            ->join('communes', 'communes.id', '=', 'schools.commune_id')
            ->join('districts', 'districts.id', '=', 'communes.district_id')
            ->join('provinces', 'provinces.id', '=', 'districts.province_id')
            ->join('levels', 'levels.id', '=', 'schools.level_id')
            ->join('zones', 'zones.id', '=', 'schools.zone_id')
            ->where('schools.id', '=', $request->school)
            ->select(
                'schools.code as code',
                'schools.name as school',
                'communes.name as commune',
                'districts.name as district',
                'provinces.name as province',
                'levels.name as level',
                'zones.name as zone'
            )
            ->first();

        $ones = DB::table('scores')
            ->join('questions', 'questions.id', '=', 'scores.question_id')
            ->join('evaluations', 'evaluations.id', '=', 'scores.evaluation_id')
            ->join('schools', 'schools.id', '=', 'evaluations.school_id')
            ->where('schools.id', '=', $request->school)
            ->where('evaluations.id', '=', $request->evaluation)
            ->whereIn('questions.id', [7, 24, 69, 168, 173, 86, 92, 179, 186, 189, 192, 225])
            ->select(
                'questions.id as id',
                'questions.name as name',
                'scores.score1 as score1',
                'scores.score2 as score2',
                'scores.score3 as score3',
                'scores.total as total'
            )
            ->get();

        $two = DB::table('scores')
            ->join('questions', 'questions.id', '=', 'scores.question_id')
            ->join('evaluations', 'evaluations.id', '=', 'scores.evaluation_id')
            ->join('schools', 'schools.id', '=', 'evaluations.school_id')
            ->where('schools.id', '=', $request->school)
            ->where('evaluations.id', '=', $request->evaluation)
            ->whereIn('questions.id', [3, 11, 18, 146, 151, 156, 211, 216, 221])
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
            'detail' => view('report.detail', [
                'school' => $school,
                'ones' => $ones,
                'two' => $two
            ])->render()
        ]);
    }

    public function total(Request $request)
    {
        if ($request->ajax()) {

            $id = (!empty($request->id)) ? $request->id : 230 ;

            $scores = DB::table('scores')
                ->join('questions', 'questions.id', '=', 'scores.question_id')
                ->join('evaluations', 'evaluations.id', '=', 'scores.evaluation_id')
                ->join('schools', 'schools.id', '=', 'evaluations.school_id')
                ->join('levels', 'levels.id', '=', 'schools.level_id')
                ->join('zones', 'zones.id', '=', 'schools.zone_id')
                ->join('communes', 'communes.id', '=', 'schools.commune_id')
                ->join('districts', 'districts.id', '=', 'communes.district_id')
                ->join('provinces', 'provinces.id', '=', 'districts.province_id')
                ->join('users', 'users.id', '=', 'evaluations.created_by')
                ->where('questions.id', '=', $id)
                ->select([
                    'evaluations.id',
                    'schools.code',
                    'schools.name as school',
                    'levels.name as level',
                    'zones.name as zone',
                    DB::raw("CONCAT(provinces.name, ' ', districts.name, ' ', communes.name) as location"),
                    'scores.total',
                    DB::raw("FIND_IN_SET(scores.total, (SELECT GROUP_CONCAT(scores.total ORDER BY scores.total DESC) FROM scores where scores.question_id='$id')) as rank"),
                    'evaluations.date as date'
                ])
                ->orderBy('scores.total', 'DESC');

            (Auth::user()->hasRole('district')) ? $scores->where('users.district_id', '=', Auth::user()->district->id) : '';
            (Auth::user()->hasRole('province')) ? $scores->where('users.province_id', '=', Auth::user()->province->id) : '';

            (!empty($request->level)) ? $scores->where('levels.id', '=', $request->level) : '' ;
            
            (!empty($request->zone)) ? $scores->where('zones.id', '=', $request->zone) : '' ;

            (!empty($request->start)) ? $scores->where('evaluations.date', '>=', Carbon::createFromFormat('d-m-Y', $request->start)->format('Y-m-d')) : '' ;

            (!empty($request->end)) ? $scores->where('evaluations.date', '<=', Carbon::createFromFormat('d-m-Y', $request->end)->format('Y-m-d')) : '' ;

            (!empty($request->orientation)) ? $scores->whereBetween('scores.total', explode(',', $request->orientation)) : '' ;

            (empty($request->duplicate)) ? $scores = $scores->orderBy('evaluations.date', 'DESC')->get()->keyBy('code')->unique() : '' ;

            return Datatables::of($scores)->make(true);
        }
        
        return view('report.total', [
            'levels' => Level::select('id', 'name')->get(),
            'zones' => Zone::select(['id', 'name'])->get(),
            'questions' => Question::where('question_id', '=', 0)->with('childrenQuestions')->get()
        ]);
    }
}
