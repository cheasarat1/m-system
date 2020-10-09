<?php

namespace App\Http\Controllers;

use App\Village;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class VillageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('village.index');
    }

    public function create()
    {
        return view('village.create');
    }

    public function store(Request $request)
    {
        $village = Village::create(
            ['name' => $request->input('name'), 'commune_id' => $request->commune_id]
        );
        return response()->json(['success' => ($village) ? true : false], 200);
    }

    public function show(Village $village)
    {
        //
    }

    public function edit(Village $village)
    {
        return view('village.edit', ['village' => $village]);
    }

    public function update(Request $request, Village $village)
    {
        $village->name = $request->name;
        $village->commune_id = $request->commune_id;
        return response()->json(['success' => ($village->save()) ? true : false], 200);
    }

    public function destroy(Village $village)
    {
        return response()->json(['success' => ($village->delete()) ? true : false], 200);
    }

    public function select2(Request $request)
    {
        $villages = Village::where('name', 'LIKE', '%'.$request->input('term', '').'%')->where('commune_id', '=', $request->input('id'))->get(['id', 'name as text']);
        return response()->json(['results' => $villages], 200);
    }

    public function dataTable()
    {
        return Datatables::of(Village::select('id', 'name'))
            ->addColumn('action', function ($village){
                $edit = "<a href='". route("village.edit",$village->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
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
