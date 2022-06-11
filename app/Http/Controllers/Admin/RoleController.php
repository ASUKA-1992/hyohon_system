<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\RoleRequest; 

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('active_flg', 'desc')->get();
        return view('admin/role/index', compact('roles'));
    }

    public function create()
    {
        return view('admin/role/create');
    }

    public function store(RoleRequest $request)
    {
        Role::create([
          'name' => $request->name,
          'name_sub' => $request->name_sub,
          'active_flg' => true,
        ]);
        return redirect()->route('role.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('admin/role/edit')->with('role', $role);
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->name_sub = $request->name_sub;
        $role->active_flg = $request->active_flg;
        $role->save();
 
        return redirect()->route('role.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        
        return redirect()->route('role.index');
    }
}
