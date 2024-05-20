<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
// use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
        // return response()->json(['message'=> 'Role created successfully', 'roles' => $roles], 201);
    }
    public function create()
    {
        return view('admin.roles.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);
        $roles = Role::all();
        return redirect()->route('roles.index')->with('message', 'Role Created Successfully');
        // return response()->json(['message' => 'Role stored successfully', 'roles' => $roles], 201);
    }
    public function show(Request $request,$id)
    {

        $tablesArr = [];
        $breadcrumbs = [];
        $pageConfigs = ['pageHeader' => true];
        if ($id) {
            $role = Role::find($id);

            $tables = DB::select('SHOW TABLES');
            foreach ($tables as $table) {
                $host = $request->getHttpHost();
                // dd('Tables_in_' . env('DB_DATABASE'));
                if ($host == 'localhost') {
                    $tablesArr[$table->Tables_in_mineology_server] = $table->Tables_in_mineology_server;
                } else {
                    $tablesArr[$table->Tables_in_themeimplement] = $table->Tables_in_themeimplement;
                }
            }

            // Tables_in_themeimplement
            // Tables_in_themeImplement
            // dd($tablesArr);

            $filterArr = [];
            if ($tablesArr['users']) {
                $filterArr['users'] = 'users';
            }
            $permissionData = new Permission();
            return view('admin.roles.view', ['pageConfigs' => $pageConfigs, 'role' => $role, 'accessData' => $filterArr, 'permissionData' => $permissionData]);
        } else {
            return Redirect::back()->with('error', 'ID not selected or not found.!');
        }



        /* $permissions = Permission::all();
        return view('role.roles.edit', compact('role', 'permissions')); */
    }
    public function edit(Request $request,$id)
    {

        $tablesArr = [];
        $breadcrumbs = [];
        $pageConfigs = ['pageHeader' => true];
        if ($id) {
            $role = Role::find($id);

            $tables = DB::select('SHOW TABLES');
            foreach ($tables as $table) {
                $host = $request->getHttpHost();
                // dd('Tables_in_' . env('DB_DATABASE'));
                if ($host == 'localhost') {
                    $tablesArr[$table->Tables_in_mineology_server] = $table->Tables_in_mineology_server;
                } else {
                    $tablesArr[$table->Tables_in_themeimplement] = $table->Tables_in_themeimplement;
                }
            }

            // Tables_in_themeImplement
            // dd($tablesArr);

            $filterArr = [];
            if ($tablesArr['users']) {
                $filterArr['users'] = 'users';
            }
            $permissionData = new Permission();
            return view('admin.roles.edit', ['pageConfigs' => $pageConfigs, 'role' => $role, 'accessData' => $filterArr, 'permissionData' => $permissionData]);
        } else {
            return Redirect::back()->with('error', 'ID not selected or not found.!');
        }



        /* $permissions = Permission::all();
        return view('role.roles.edit', compact('role', 'permissions')); */
    }
    /* public function update(Request $request, role $role)
    {

        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $role->update($validated);
        return redirect()->route('role.roles.index')->with('message', 'Role Updated Successfully');
    } */

    public function update(Request $request, string $id)
    {
        $param = $request->all();
        $role = Role::find($param['id']);
        $validator = Validator::make($param, [
            'name' => ['required', 'string', 'max:20', 'unique:roles,name,' . $role->id],
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $role_id = $param['id'];

        if (!empty($param['permission'])) {
            Permission::where('role_id', $role_id)->delete();
            foreach ($param['permission'] as $key => $value) {
                $value['module'] = $key;
                $value['role_id'] = $role_id;
                Permission::create($value);
            }
            // dd($param['permission']);
        } else {
            Permission::where('role_id', $role_id)->delete();
        }
        if (!empty($param)) {

            $role = Role::find($param['id']);
            unset($param['id']);
            $isUpdated = $role->update($param);
            if ($isUpdated) {
                return redirect()->route('roles.index')->with('success', 'Updated Successfully.!');
            } else {
                return Redirect::back()->with('error', 'Something Wrong happend.!');
            }
        } else {
            return Redirect::back()->with('error', 'ID not selected or not found.!');
        }
    }
    public function destroy(Role $role)
    {

            $role->delete();
            return back()->with(['message' => 'Role Deleted']);

    }

}
