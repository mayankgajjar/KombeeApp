<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersHobbie;
use App\Models\UsersRole;
use App\Models\UsersFiles;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $users = User::where('id','!=',$request->user()->id)->get();
            return $this->sendResponse($users, 'User retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $input = $request->all();
            $input['name'] = $input['firstname']." ".$input['lastname'];
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            if(!empty($user->id)){
                $userId = $user->id;

                if(!empty($input['hobbie'])){
                    $hobbie_array = $input['hobbie'];
                    $insert_array = [];

                    foreach ($hobbie_array as $value) {
                        $insert_array[] = [
                            'user_id' => $userId,
                            'hobbie' => $value,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                    UsersHobbie::insert($insert_array);
                }

                if(!empty($input['role'])){
                    $role_array = $input['role'];
                    $role_insert_array = [];

                    foreach ($role_array as $value) {
                        $role_insert_array[] = [
                            'user_id' => $userId,
                            'role_id' => $value,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                    UsersRole::insert($role_insert_array);
                }

                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $key => $image) {
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images'), $imageName);
                        $imageList = [
                            'user_id' => $userId,
                            'file_name' => $imageName,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                        UsersFiles::create($imageList);
                    }
                }
            }
            return $this->sendResponse($user, 'User created successfully.',route('users'));
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $user = User::with(['hobbie','role','file'])->find($id);
            if (empty($user)) {
                return $this->sendError('User not found.');
            }
            return $this->sendResponse($user, 'User retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function update(UserRequest $request, string $id)
    {
        try {
            $input = $request->all();
            $user = User::find($id);
            $user->firstname = $input['firstname'];
            $user->lastname = $input['lastname'];
            $user->name = $input['firstname']." ".$input['lastname'];
            $user->email = $input['email'];
            $user->contact_number = $input['contact_number'];
            $user->postcode = $input['postcode'];
            $user->gender = $input['gender'];
            $user->state_id = $input['state_id'];
            $user->city_id = $input['city_id'];
            $user->save();

            if(!empty($input['hobbie'])){
                UsersHobbie::where('user_id',$id)->delete();
                $hobbie_array = $input['hobbie'];
                $insert_array = [];

                foreach ($hobbie_array as $value) {
                    $insert_array[] = [
                        'user_id' => $id,
                        'hobbie' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                UsersHobbie::insert($insert_array);
            }

            if(!empty($input['role'])){
                UsersRole::where('user_id',$id)->delete();
                $role_array = $input['role'];
                $role_insert_array = [];

                foreach ($role_array as $value) {
                    $role_insert_array[] = [
                        'user_id' => $id,
                        'role_id' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                UsersRole::insert($role_insert_array);
            }

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $key => $image) {
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    $imageList = [
                        'user_id' => $userId,
                        'file_name' => $imageName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    UsersFiles::create($imageList);
                }
            }

            return $this->sendResponse($user, 'User updated successfully.',route('users'));
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            if (empty($user)) {
                return $this->sendError('User not found.');
            }
            $user->delete();
            return $this->sendResponse([], 'User deleted successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function DeleteImage($id) {
        try {
            $user = UsersFiles::find($id);
            if (empty($user)) {
                return $this->sendError('File not found.');
            }
            $user->delete();
            return $this->sendResponse([], 'File deleted successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }


}
