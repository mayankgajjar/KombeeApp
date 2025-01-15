<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PermissionHandler;

class RoleController extends Controller
{
    use PermissionHandler;

    public function index()
    {
        $user = session('user'); // Get the user from session
        $token = session('token'); // Get the token from session

        if ($user && $token) {
            $permission = $this->getUserPermission($user->id);
            return view('role/role', compact('user', 'token','permission'));
        } else {
            return redirect()->route('login');
        }
    }

    public function add(){
        $user = session('user'); // Get the user from session
        $token = session('token'); // Get the token from session
        $id = "0";

        if ($user && $token) {
            $permission = $this->getUserPermission($user->id);
            return view('role/addEdit', compact('user', 'token','id','permission'));
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id){
        $user = session('user'); // Get the user from session
        $token = session('token'); // Get the token from session

        if ($user && $token) {
            $permission = $this->getUserPermission($user->id);
            return view('role/addEdit', compact('user', 'token','id','permission'));
        } else {
            return redirect()->route('login');
        }
    }

    public function permission($id) {
        $user = session('user'); // Get the user from session
        $token = session('token'); // Get the token from session

        if ($user && $token) {
            $permission = $this->getUserPermission($user->id);
            return view('role/permission', compact('user', 'token','id','permission'));
        } else {
            return redirect()->route('login');
        }
    }

    
}
