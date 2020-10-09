<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class LevelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(
                Level::select(['id', 'name', 'description'])
            )
            ->addColumn('action', function ($level){
                $edit = "<a href='". route("level.edit",$level->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
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

        return view('level.index');
    }

    public function create()
    {
        return view('level.create');
    }

    public function store(Request $request)
    {
        $level = Level::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return response()->json(['success' => ($level) ? true : false], 200);
    }

    public function show(Level $level)
    {
        //
    }

    public function edit(Level $level)
    {
        return view('level.edit', ['level' => $level]);
    }

    public function update(Request $request, Level $level)
    {
        $level->name = $request->name;
        $level->description = $request->description;
        return response()->json(['success' => ($level->save()) ? true : false], 200);
    }

    public function destroy(Level $level)
    {
        return response()->json(['success' => ($level->delete()) ? true : false], 200);
    }

    public function select2(Request $request)
    {
        $level = Level::where('name', 'LIKE', '%'.$request->input('term', '').'%')->get(['id', 'name as text']);
        return response()->json(['results' => $level], 200);
    }
}
