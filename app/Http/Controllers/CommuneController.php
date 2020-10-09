<?php

namespace App\Http\Controllers;

use App\Commune;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CommuneController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('commune.index');
    }

    public function create()
    {
        return view('commune.create');
    }

    public function store(Request $request)
    {
        $commune = Commune::create(
            ['name' => $request->input('name'), 'district_id' => $request->district_id]
        );
        return response()->json(['success' => ($commune) ? true : false], 200);
    }

    public function show(Commune $commune)
    {
        //
    }

    public function edit(Commune $commune)
    {
        return view('commune.edit', ['commune' => $commune]);
    }

    public function update(Request $request, Commune $commune)
    {
        $commune->name = $request->name;
        $commune->district_id = $request->district_id;
        return response()->json(['success' => ($commune->save()) ? true : false], 200);
    }

    public function destroy(Commune $commune)
    {
        return response()->json(['success' => ($commune->delete()) ? true : false], 200);
    }

    public function select2(Request $request)
    {
        $communes = Commune::where('name', 'LIKE', '%'.$request->input('term', '').'%')->where('district_id', '=', $request->input('id'))->get(['id', 'name as text']);
        return response()->json(['results' => $communes], 200);
    }

    public function dataTable()
    {
        return Datatables::of(Commune::select('id', 'name'))
            ->addColumn('action', function ($commune){
                $edit = "<a href='". route("commune.edit",$commune->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
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
