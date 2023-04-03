<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Models\EmployeesModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $titlePage = 'Home';
        $user = EmployeesModel::find(Auth::user()->employee_id);
        return view('user.home', compact('titlePage', 'user'));
    }
}
