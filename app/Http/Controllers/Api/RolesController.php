<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Models\Roles;
use App\Models\RolePermission;

class RolesController extends Controller
{
    public function index()
    {
        try {
            $roles = Roles::all();
            return $this->sendResponse($roles, 'Role retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function store(RoleRequest $request)
    {
        try {
            $input = $request->all();
            $role = Roles::create($input);
            return $this->sendResponse($role, 'Role created successfully.',route('role'));
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $role = Roles::find($id);
            if (empty($role)) {
                return $this->sendError('Role not found.');
            }
            return $this->sendResponse($role, 'Role retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function update(RoleRequest $request, string $id)
    {
        try {
            $input = $request->all();
            $role = Roles::find($id);
            $role->name = $input['name'];
            $role->save();
            return $this->sendResponse($role, 'Role updated successfully.',route('role'));
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $role = Roles::find($id);
            if (empty($role)) {
                return $this->sendError('Role not found.');
            }
            $role->delete();
            return $this->sendResponse([], 'Role deleted successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function getAllPermission(){
        try {
            $permission = RolePermission::all();
            return $this->sendResponse($permission, 'Permission retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function SavePermission(Request $request){
        try {
            $input = $request->all();
            if(!empty($input['permission'])){
                $permission_array = $input['permission'];
                RolePermission::where('role_id',$input['role_id'])->delete();
                foreach($permission_array as $key => $value){
                    $insert_array = [
                        'role_id' => $input['role_id'],
                        'permission' => $value
                    ];
                    RolePermission::create($insert_array);
                }
            }
            return $this->sendResponse([], 'Role permission successfully.',route('role'));
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function getRolePermission($id){
        try {
            $permission = RolePermission::where('role_id',$id)->get();
            return $this->sendResponse($permission, 'Permission retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }
}
