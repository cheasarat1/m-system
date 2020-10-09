<?php

namespace App\Http\Controllers;

use Auth;
use App\District;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DistrictController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('district.index');
    }

    public function create()
    {
        return view('district.create');
    }

    public function store(Request $request)
    {
        $province = District::create(
            ['name' => $request->input('name'), 'province_id' => $request->province_id]
        );
        return response()->json(['success' => ($province) ? true : false], 200);
    }

    public function show(District $district)
    {
        //
    }

    public function edit(District $district)
    {
        return view('district.edit', ['district' => $district]);
    }

    public function update(Request $request, District $district)
    {
        $district->name = $request->name;
        $district->province_id = $request->province_id;
        return response()->json(['success' => ($district->save()) ? true : false], 200);
    }

    public function destroy(District $district)
    {
        return response()->json(['success' => ($district->delete()) ? true : false], 200);
    }

    public function select2(Request $request)
    {
        $districts = District::where('name', 'LIKE', '%'.$request->input('term', '').'%')
            ->where('province_id', '=', Auth::user()->province_id)
            ->get(['id', 'name as text']);
        return response()->json(['results' => $districts], 200);
    }

    public function dataTable()
    {
        return Datatables::of(District::select('id', 'name'))
            ->addColumn('action', function ($district){
                $edit = "<a href='". route("district.edit",$district->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
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
