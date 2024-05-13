<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemManagementController extends Controller
{
    public function index(){
        return view('system_management.index');
    }
}
