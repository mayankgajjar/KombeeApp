<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of data to be exported.
     */
    public function collection()
    {
        return User::with(['role', 'hobbie', 'state', 'city'])
            ->where('id', '!=', session('user')->id)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'full_name' => $user->firstname . ' ' . $user->lastname,
                    'email' => $user->email,
                    'contact_number' => $user->contact_number,
                    'gender' => ucfirst($user->gender),
                    'postcode' => $user->postcode,
                    'state' => $user->state->name ?? 'N/A',
                    'city' => $user->city->name ?? 'N/A',
                    'hobbies' => implode(', ', $user->hobbie->pluck('hobbie')->toArray()),
                ];
            });
    }

    /**
     * Return the headings for the export.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Email',
            'Contact Number',
            'Gender',
            'Postcode',
            'State',
            'City',
            'Hobbies',
        ];
    }
}
