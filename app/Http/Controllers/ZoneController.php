<?php

namespace App\Http\Controllers;

use App\Zone;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ZoneController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('zone.index');
    }

    public function create()
    {
        return view('zone.create');
    }

    public function store(Request $request)
    {
        $zone = Zone::create(
            ['name' => $request->input('name'), 'description' => $request->input('description')]
        );
        return response()->json(['success' => ($zone) ? true : false], 200);
    }

    public function show(Zone $zone)
    {
        //
    }

    public function edit(Zone $zone)
    {
        return view('zone.edit', ['zone' => $zone]);
    }

    public function update(Request $request, Zone $zone)
    {
        $zone->name = $request->name;
        $zone->description = $request->description;
        return response()->json(['success' => ($zone->save()) ? true : false], 200);
    }

    public function destroy(Zone $zone)
    {
        return response()->json(['success' => ($zone->delete()) ? true : false], 200);
    }

    public function select2(Request $request)
    {
        $provinces = Zone::where('name', 'LIKE', '%'.$request->input('term', '').'%')->get(['id', 'name as text']);
        return response()->json(['results' => $provinces], 200);
    }

    public function dataTable()
    {
        return Datatables::of(Zone::query())
            ->addColumn('action', function ($zone){
                $edit = "<a href='". route("zone.edit",$zone->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
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
