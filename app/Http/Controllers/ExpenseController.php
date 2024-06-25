<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function management()
    {
        return view('expenses.index');
    }

    public function index()
    {
        return view('expenses.index');
    }
}
