<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showEmployees()
    {
        return \View::make('employees');
    }
}
