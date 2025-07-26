<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('created_at', 'DESC')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'privileges' => 'required',
            'status' => 'required',
        ]);
        

        // dd($request->privileges);
        $privileges = implode(',', $request->privileges);
        // dd($privileges);
        $data['privileges'] = $privileges.',admin,logout';

        Role::create($data);

        return redirect()->route('roles.index')->with('success', 'New Role Added');

    }

    public function edit($id)
    {
        $data = Role::where('id', $id)->first();
        return view('admin.roles.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $data = $this->validate($request, [
            'name' => 'required',
            'privileges' => 'required',
            'status' => 'required',
        ]);
        

        // dd($request->privileges);
        $privileges = implode(',', $request->privileges);
        // dd($privileges);
        $data['privileges'] = $privileges.',admin,logout';
        $role->update($data);


        return redirect()->route('roles.index')->with('success', 'Role Data Updated');

    }
    public function destroy($id) {

        $data = Role::findOrFail( $id );
        $data->delete();
        return redirect()->route('roles.index')->with('danger', 'Role Deleted');
    }
}
