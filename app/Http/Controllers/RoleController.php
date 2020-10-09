<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('role.index');
    }

    public function create()
    {
        return view('role.create', ['permissions' => Permission::all()]);
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->input('name')]);
        ($request->permissions <> '') ? $role->permissions()->attach($request->permissions) : '';
        return response()->json(['success' => ($role) ? true : false], 200);
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        return view('role.edit', ['role' => $role, 'permissions' => Permission::all()]);
    }

    public function update(Request $request, Role $role)
    {
        $role->name = $request->name;
        $role->save();
        ($request->permissions <> '') ? $role->permissions()->sync($request->permissions) : '';
        return response()->json(['success' => ($role) ? true : false], 200);
    }

    public function destroy(Role $role)
    {
        return response()->json(['success' => ($role->delete()) ? true : false], 200);
    }

    public function dataTable()
    {
        return Datatables::of(Role::query())
            ->addColumn('action', function ($role){
                $edit = "<a href='". route("role.edit",$role->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
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
