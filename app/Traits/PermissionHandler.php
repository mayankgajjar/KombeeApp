<?php

namespace App\Traits;

trait PermissionHandler
{
    public function getUserPermission($user_id) {
        $UserData = \App\Models\User::with(['role'])->find($user_id)->toArray();

        if (!$UserData) {
            throw new \Exception("User not found.");
        }
        $all_permission = ['show_supplier', 'add_supplier', 'edit_supplier', 'delete_supplier', 
        'show_customer', 'add_customer', 'edit_customer', 'delete_customer','show_role',
        'add_user','edit_user','delete_user'
        ];
        
        $roleId_array = array_column($UserData['role'], "role_id");
        if(in_array('1',$roleId_array)){
            return $all_permission;
        } else {
            $permissionData = \App\Models\RolePermission::where('role_id',$roleId_array)->get()->toArray();
            return array_unique(array_column($permissionData, "permission"));   
        }
    }
}