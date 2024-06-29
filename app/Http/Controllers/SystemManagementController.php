<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemManagementController extends Controller
{
    public function index(){
        if (\Auth::user()->can('manage-System Management')) {
            return view('system_management.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
