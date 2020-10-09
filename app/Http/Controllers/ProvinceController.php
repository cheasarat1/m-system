<?php

namespace App\Http\Controllers;

use App\Province;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProvinceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('province.index');
    }

    public function create()
    {
        return view('province.create');
    }

    public function store(Request $request)
    {
        $province = Province::create(['name' => $request->input('name')]);
        return response()->json(['success' => ($province) ? true : false], 200);
    }

    public function show(Province $province)
    {
        //
    }

    public function edit(Province $province)
    {
        return view('province.edit', ['province' => $province]);
    }

    public function update(Request $request, Province $province)
    {
        $province->name = $request->name;
        return response()->json(['success' => ($province->save()) ? true : false], 200);
    }

    public function destroy(Province $province)
    {
        return response()->json(['success' => ($province->delete()) ? true : false], 200);
    }

    public function select2(Request $request)
    {
        $provinces = Province::where('name', 'LIKE', '%'.$request->input('term', '').'%')->get(['id', 'name as text']);
        return response()->json(['results' => $provinces], 200);
    }

    public function dataTable()
    {
        return Datatables::of(Province::select('id', 'name'))
            ->addColumn('action', function ($province){
                $edit = "<a href='". route("province.edit",$province->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
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
