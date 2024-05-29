<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function stock_inventory(){
        return view('inventory.index');
    }
}
