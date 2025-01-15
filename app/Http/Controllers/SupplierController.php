<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PermissionHandler;

class SupplierController extends Controller
{
    use PermissionHandler;

    public function index()
    {
        $user = session('user'); // Get the user from session
        $token = session('token'); // Get the token from session

        if ($user && $token) {
            $permission = $this->getUserPermission($user->id);
            return view('supplier/supplier', compact('user', 'token','permission'));
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
            return view('supplier/addEdit', compact('user', 'token','id','permission'));
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id){
        $user = session('user'); // Get the user from session
        $token = session('token'); // Get the token from session

        if ($user && $token) {
            $permission = $this->getUserPermission($user->id);
            return view('supplier/addEdit', compact('user', 'token','id','permission'));
        } else {
            return redirect()->route('login');
        }
    }
}
