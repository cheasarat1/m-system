<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = DB::table('users')
                ->leftJoin('provinces', 'provinces.id', '=', 'users.province_id')
                ->leftJoin('districts', 'districts.id', '=', 'users.district_id')
                ->where('users.created_by', '=', Auth::user()->id)
                ->select([
                    'users.id',
                    'users.name',
                    'provinces.name as province',
                    'districts.name as district',
                ]);

            return Datatables::of($users)
                ->addColumn('action', function ($user){
                    $edit = "<a href='". route("user.edit",$user->id) ."' class='edit tip btn btn-warning btn-xs' title=''><i class='fa fa-edit'></i></a>";
                    $changePassword = "<a href='". route("user.change-password",$user->id) ."' class='change-password tip btn btn-warning btn-xs' title=''><i class='fa fa-key'></i></a>";
                    $delete = "<a href='' class='tip remove btn btn-danger btn-xs' title='delete'><i class='fa fa-trash-o'></i></a>";

                    $button = "<div class='text-center'>";
                    $button .= "<div class='btn-group'>";
                    $button .= $edit;
                    $button .= $changePassword;
                    $button .= $delete;
                    $button .= "</div>";
                    $button .= "</div>";
                    return $button;
                })
                ->make(true);
        }

        return view('user.index');
    }

    public function create()
    {
        $roles = Role::select(['id', 'name']);

        (Auth::user()->hasRole('admin')) ? $roles->whereIn('name', ['ministry', 'evaluation']) : '' ;
        (Auth::user()->hasRole('ministry')) ? $roles->whereIn('name', ['province', 'evaluation']) : '' ;
        (Auth::user()->hasRole('province')) ? $roles->whereIn('name', ['district', 'evaluation']) : '' ;
        (Auth::user()->hasRole('district')) ? $roles->whereIn('name', ['commune', 'evaluation']) : '' ;
        (Auth::user()->hasRole('commune')) ? $roles->whereIn('name', ['evaluation', 'school']) : '' ;

        return view('user.create', ['roles' => $roles->get()]);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'province_id' => ($request->province_id) ? $request->province_id : Auth::user()->province_id,
            'district_id' => ($request->district_id) ? $request->district_id : Auth::user()->district_id,
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);
        ($request->roles <> '') ? $user->roles()->attach($request->roles) : '';
        return response()->json(['success' => ($user) ? true : false], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::select(['id', 'name']);

        (Auth::user()->hasRole('admin')) ? $roles->whereIn('name', ['ministry', 'evaluation']) : '' ;
        (Auth::user()->hasRole('ministry')) ? $roles->whereIn('name', ['province', 'evaluation']) : '' ;
        (Auth::user()->hasRole('province')) ? $roles->whereIn('name', ['district', 'evaluation']) : '' ;
        (Auth::user()->hasRole('district')) ? $roles->whereIn('name', ['evaluation', 'school']) : '' ;

        return view('user.edit', ['user' => $user, 'roles' => $roles->get()]);
    }

    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->province_id = ($request->province_id) ? $request->province_id : Auth::user()->province_id ;
        $user->district_id = ($request->district_id) ? $request->district_id : Auth::user()->district_id;
        $user->save();
        ($request->roles <> '') ? $user->roles()->sync($request->roles) : $user->roles()->detach();
        return response()->json(['success' => ($user) ? true : false], 200);
    }

    public function destroy(User $user)
    {
        return response()->json(['success' => ($user->delete()) ? true : false], 200);
    }

    public function changePassword(Request $request, $id)
    {
        return ($request->isMethod('post')) ? response()->json(['success' => (User::find($id)->update(['password' => Hash::make($request->password)])) ? true : false], 200) : view('user.change_password', ['id' => $id]) ;
    }

}
