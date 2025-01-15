<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Roles;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure the user exists first
        $user = User::firstOrCreate([
            'email' => 'admin@gmail.com', // Check by email to avoid duplicates
        ], [
            'firstname' => 'Mayank',
            'lastname' => 'Gajjar',
            'name' => 'Mayank Gajjar',
            'contact_number' => '1234567890',
            'gender' => 'male',
            'password' => bcrypt('123456'),  // Use bcrypt for secure password hashing
            'state_id' => '12',
            'city_id' => '1041',
            'postcode' => '395005',
        ]);

        // Fetch the created user ID
        $userId = $user->id;

        // Ensure the 'Admin' role exists
        $role = Roles::firstOrCreate([
            'name' => 'Admin', // Check by role name to avoid duplicates
        ]);

        // Fetch the created role ID
        $roleId = $role->id;

        // Insert into the users_role pivot table to assign the 'Admin' role to the user
        DB::table('users_role')->insert([
            'user_id' => $userId,
            'role_id' => $roleId,
        ]);
    }
}
