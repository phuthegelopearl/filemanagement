<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        if ($user->userType === 'admin'){
            return redirect()->route('admin.dashboard');
        }elseif($user->userType === 'user'){
            return redirect()->route('user.dashboard');
        }
    }
}
