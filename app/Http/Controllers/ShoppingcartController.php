<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoppingcart;

class ShoppingcartController extends Controller
{
    public function index(){
        return view('shoppingcart');
    }

    public static function save($request){
        $shoppingCart = new Shoppingcart;
        $shoppingCart->user_id =  $request['user_id'];
        $shoppingCart->save();
    }
}
