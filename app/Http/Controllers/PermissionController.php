<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('permission.index');
    }

    public function create()
    {
        return view('permission.create', ['roles' => Role::all()]);
    }

    public function store(Request $request)
    {
        $permission = Permission::create(['name' => $request->input('name')]);
        if ($request->roles <> '') {
            foreach ($request->roles as $key=>$value) {
                $role = Role::find($value); 
                $role->permissions()->attach($permission);
            }
        }
        return response()->json(['success' => ($permission) ? true : false], 200);
    }

    public function show(Permission $permission)
    {
        //
    }

    public function edit(Permission $permission)
    {
        return view('permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->name = $request->name;
        return response()->json(['success' => ($permission->save()) ? true : false], 200);
    }

    public function destroy(Permission $permission)
    {
        return response()->json(['success' => ($permission->delete()) ? true : false], 200);
    }

    public function dataTable()
    {
        return Datatables::of(Permission::query())
            ->addColumn('action', function ($permission){
                $edit = "<a href='". route("permission.edit",$permission->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
                $delete = "<a href='". route("permission.destroy",$permission->id) ."' class='tip remove btn btn-danger btn-xs' title='delete'><i class='fa fa-trash-o'></i></a>";

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
