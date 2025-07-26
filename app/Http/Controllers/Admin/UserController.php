<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Exports\CustomerExport;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->orderBy('created_at', 'DESC')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles =  Role::where('status',1)->get();
        return view('admin.users.create',compact('roles'));
    }


    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required',
            'role_id' => 'required',
        ]);
        $hashedPassword = Hash::make($request->password, [
            'rounds' => 10,
        ]);
        $data['password'] = $hashedPassword;
       
        User::create($data);

        return redirect()->route('users.index')->with('success', 'New Staff Added');

    }

    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        $roles =  Role::where('status',1)->get();
        return view('admin.users.edit', compact('data','roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'nullable',
            'role_id' => 'required',
        ]);
        
        if($request->password != ''){
            $hashedPassword = Hash::make($request->password, [ 'rounds' => 10, ]);
            $data['password'] = $hashedPassword;
        }
        else{
            $data['password'] = $user['password'];
        }
        // dd($data);
        $user->update($data);


        return redirect()->route('users.index')->with('success', 'User Staff Updated');

    }
    public function destroy($id) {

        $data = User::findOrFail( $id );
        $data->delete();
        return redirect()->route('users.index')->with('danger', 'Staff Deleted');
    }
    public function deleteregisteredusers($id) {
        $data = Customer::findOrFail( $id );
        $data->delete();
        return redirect()->route('registeredusers')->with('danger', 'Customer Deleted');
    }

    public function registeredusers(){
        $users = Customer::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.users.registeredusers', compact('users'));
    }

    public function export_reg_user(Request $request){
        return Excel::download(new CustomerExport, 'registered_users.xlsx');
    }
}
