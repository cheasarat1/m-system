<?php

namespace App\Http\Controllers;

use Auth;
use App\School;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('school.index');
    }

    public function create()
    {
        return view('school.create');
    }

    public function store(Request $request)
    {
        $school = School::create(
            [
                'level_id' => $request->input('level_id'),
                'zone_id' => $request->input('zone_id'),
                'village_id' => $request->input('village_id'),
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]
        );
        return response()->json(['success' => ($school) ? true : false], 200);
    }

    public function show(School $school)
    {
        //
    }

    public function edit(School $school)
    {
        return view('school.edit', ['school' => $school]);
    }

    public function update(Request $request, School $school)
    {
        $school->level_id = $request->level_id;
        $school->zone_id = $request->zone_id;
        $school->village_id = $request->village_id;
        $school->name = $request->name;
        $school->code = $request->code;
        return response()->json(['success' => ($school->save()) ? true : false], 200);
    }

    public function destroy(School $school)
    {
        return response()->json(['success' => ($school->delete()) ? true : false], 200);
    }

    public function select2(Request $request)
    {
        $schools = DB::table('schools')
            ->join('communes', 'communes.id', '=', 'schools.commune_id')
            ->join('districts', 'districts.id', '=', 'communes.district_id')
            ->join('provinces', 'provinces.id', '=', 'districts.province_id')
            ->where('code', 'LIKE', '%'.$request->input('term', '').'%')
            ->select([
                'schools.id',
                'schools.code as text'
            ]);

        //(Auth::user()->hasRole('District')) ? $schools->where('districts.id', '=', Auth::user()->district->id) : '';
        //(Auth::user()->hasRole('Province')) ? $schools->where('provinces.id', '=', Auth::user()->province->id) : '';

        return response()->json(['results' => $schools->get()], 200);
    }

    public function dataTable()
    {
        return Datatables::of(School::query())
            ->addColumn('action', function ($school){
                $edit = "<a href='". route("school.edit",$school->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
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

    public function code(Request $request)
    {
        $school = DB::table('schools')

            ->join('levels', 'levels.id', '=', 'schools.level_id')
            ->join('zones', 'zones.id', '=', 'schools.zone_id')
            ->join('communes', 'communes.id', '=', 'schools.commune_id')
            ->join('districts', 'districts.id', '=', 'communes.district_id')
            ->join('provinces', 'provinces.id', '=', 'districts.province_id')
            ->where('schools.id', '=', $request->code)
            ->select([
                'schools.id',
                'schools.name',
                'schools.code',
                'levels.name as level',
                'zones.name as zone',
                'communes.name as commune',
                'districts.name as district',
                'provinces.name as province'
            ]);

        return response()->json(['success' => true, 'school' => $school->get()], 200);
    }
}
