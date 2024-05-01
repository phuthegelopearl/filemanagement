<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\User;
// Import the User model

class AdminController extends Controller
{
    public function __invoke(Request $request)
    {
        $files = File::all();
        $users = User::where('userType', 'user')->get();
        return view('dashboard', [
            'users'=> $users,
            'files'=> $files
        ]);
    }


}
