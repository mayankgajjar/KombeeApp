<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionHandler;


class DashboardController extends Controller
{
    use PermissionHandler;

    public function index()
    {
        $user = session('user'); // Get the user from session
        $token = session('token'); // Get the token from session

        if ($user && $token) {
            $permission = $this->getUserPermission($user->id);
            return view('home', compact('user', 'token','permission'));
        } else {
            return redirect()->route('login');
        }
    }


}
