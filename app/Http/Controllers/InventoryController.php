<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index()
    {
        $connectedUser = auth()->user();
        $inventory = Inventory::where('user_id', '=', $connectedUser->id)->get();

        return view('inventory', [
            'inventory' => $inventory,
            'connectedUser' => $connectedUser
        ]);
    }
}