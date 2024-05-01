<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
// Import the User model

class AdminController extends Controller
{
    public function __invoke(Request $request)
    {
        $files = File::all();
        return view('dashboard', compact('files'));
    }


}
