<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PermissionHandler;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use PermissionHandler;

    public function index()
    {
        $user = session('user'); // Get the user from session
        $token = session('token'); // Get the token from session

        if ($user && $token) {
            $permission = $this->getUserPermission($user->id);
            return view('user/user', compact('user', 'token','permission'));
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
            return view('user/addEdit', compact('user', 'token','id','permission'));
        } else {
            return redirect()->route('login');
        }
    }

    
    public function edit($id){
        $user = session('user'); // Get the user from session
        $token = session('token'); // Get the token from session

        if ($user && $token) {
            $permission = $this->getUserPermission($user->id);
            return view('user/addEdit', compact('user', 'token','id','permission'));
        } else {
            return redirect()->route('login');
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route("login");
    }

    public function exportPdf()
    {
        // Fetch user data (example: all users)
        $users = User::with(['role', 'hobbie','state','city'])->where('id','!=',session('user')->id)->get();;

        // Pass data to the PDF view
        $pdf = Pdf::loadView('pdf.users', compact('users'))
            ->setPaper('a4', 'landscape') // Use landscape orientation for wide tables
            ->setOption('margin-top', '10mm')
            ->setOption('margin-bottom', '10mm')
            ->setOption('margin-left', '10mm')
            ->setOption('margin-right', '10mm');

        // Return the PDF for download
        return $pdf->download('users.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportCsv() 
    {
    $users = User::with(['role', 'hobbie', 'state', 'city'])
                 ->where('id', '!=', session('user')->id)
                 ->get();

    $filename = "users.csv";

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    $columns = ['ID', 'Full Name', 'Email', 'Contact Number', 'Gender', 'Postcode', 'State', 'City', 'Hobbies'];

    $callback = function () use ($users, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($users as $user) {
            $row = [
                $user->id,
                $user->firstname . ' ' . $user->lastname,
                $user->email,
                $user->contact_number,
                $user->postcode,
                ucfirst($user->gender),
                $user->state->name ?? 'N/A',
                $user->city->name ?? 'N/A',
                implode(', ', $user->hobbie->pluck('hobbie')->toArray()),
            ];
            fputcsv($file, $row);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}
