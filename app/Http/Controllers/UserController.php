<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use App\Mail\MailTest;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],

        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        Mail::to($user->email)->send(new MailTest($user));


        // Fire the Registered event
        return redirect()->route('users.index')->with('message', 'User Created Successfully');
    }

    public function edit($id){
        $user=User::findOrFail($id);
        return view('admin.users.role', compact('user'));
    }
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    // Validate and update the user
    $user->update([
        'name' => $request->input('name'),
    ]);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}

    public function destroy($id)
    {
                $user=User::findOrFail($id);
                $user->delete();


            // return response()->json(['message' => 'User Deleted']);
            return back()->with(['message' => 'Role Deleted']);


    }



}
