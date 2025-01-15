<?php
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\AuthUserRequest;
use Session;
 
 
class AuthenticationController extends Controller
{
    public function login(AuthUserRequest $request)
    {
        try {
            $credentials = [
                'email'    => $request->email,
                'password' => $request->password
            ];

            if (Auth::attempt($credentials)) {
                $token = Auth::user()->createToken('passportToken')->accessToken;
                $user_res = ['user' => Auth::user(), 'token' => $token];

                session()->put('user', $user_res['user']);
                session()->put('token', $user_res['token']);

                return $this->sendResponse($user_res, 'login successful.',route('dashboard'));
            } else {
                return $this->sendError('Error.','Unauthorised.');
            }
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $request->user()->token()->revoke();
            return $this->sendResponse([], 'Successfully logged out.',route('logout'));
        }
        return $this->sendError('Error.','Unable to log out. User not authenticated..');
    }
}