<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoppingcart;
use App\Models\Shoppingcartball;
use App\Models\User;

class CartController extends Controller
{

    public function shoppingcart()
    {
        $user_id = auth()->user()->id;
        $shoppingCart = Shoppingcart::where('user_id', '=', $user_id)->get();

        $shoppingElements = [];
        if (count($shoppingCart)) {
            $shoppingElementsFounded = Shoppingcartball::where('shoppingcart_id', '=', $shoppingCart[0]->id)->get();
        };

        foreach ($shoppingElementsFounded as $key => $shoppingElementFounded) {
            $shoppingElements[$shoppingElementFounded->ball_id] = [
                'element' => $shoppingElementFounded,
                'count' => Shoppingcartball::where('ball_id', '=', $shoppingElementFounded->ball_id)->count()
            ];
        }

        return view('shoppingcart', [
            'shoppingElements' => $shoppingElements
        ]);
    }

    public static function save($request){
        $shoppingCart = new Shoppingcart;
        $shoppingCart->user_id =  $request['user_id'];
        $shoppingCart->save();
    }

    public function addToCart(Request $request)
    {
        $ball_id = $request->ball_id;
        $user_id = auth()->user()->id;
        $shoppingCart = Shoppingcart::where('user_id', '=', $user_id)->get();

        if (count($shoppingCart)) {
            $shoppingCartSelected = $shoppingCart[0];
        }else {
            $shoppingCartSelected = new Shoppingcart;
            $shoppingCartSelected->user_id = $user_id;
            $shoppingCartSelected->save();
        }

        $shoppingCartBall = new Shoppingcartball;
        $shoppingCartBall->shoppingcart_id = $shoppingCartSelected->id;
        $shoppingCartBall->ball_id = $ball_id;
        $shoppingCartBall->save();

        return redirect()->route('balls');
    }

    public function addToCartFromCart(Request $request)
    {
        $ball_id = $request->ball_id;
        $user_id = auth()->user()->id;
        $shoppingCart = Shoppingcart::where('user_id', '=', $user_id)->get();

        $shoppingCartSelected = $shoppingCart[0];

        $shoppingCartBall = new Shoppingcartball;
        $shoppingCartBall->shoppingcart_id = $shoppingCartSelected->id;
        $shoppingCartBall->ball_id = $ball_id;
        $shoppingCartBall->save();

        return redirect()->route('shoppingcart');
    }

    public function removeToCartFromCart(Request $request)
    {
        $ball_id = $request->ball_id;
        $user_id = auth()->user()->id;
        $shoppingCart = Shoppingcart::where('user_id', '=', $user_id)->get();

        $shoppingCartSelected = $shoppingCart[0];

        $shoppingCartBall = Shoppingcartball::where('shoppingcart_id', '=', $shoppingCartSelected->id)
            ->where('ball_id', '=', $ball_id)
            ->first();
        $shoppingCartBall->delete();

        return redirect()->route('shoppingcart');
    }

    public function deleteToCart(Request $request)
    {
        $ball_id = $request->ball_id;
        $user_id = auth()->user()->id;
        $shoppingCart = Shoppingcart::where('user_id', '=', $user_id)->get();

        $shoppingCartSelected = $shoppingCart[0];

        $shoppingCartBalls = Shoppingcartball::where('shoppingcart_id', '=', $shoppingCartSelected->id)
            ->where('ball_id', '=', $ball_id)
            ->get();
        foreach ($shoppingCartBalls as $key => $shoppingCartBall) {
            $shoppingCartBall->delete();
        }

        return redirect()->route('shoppingcart');
    }

    public function deleteCart(Request $request)
    {
        $user_id = auth()->user()->id;
        $shoppingCarts = Shoppingcart::where('user_id', '=', $user_id)->get();

        foreach ($shoppingCarts as $key => $shoppingCart) {
            $shoppingCartBalls = Shoppingcartball::where('shoppingcart_id', '=', $shoppingCart->id)->get();

            foreach ($shoppingCartBalls as $key => $shoppingCartBall) {
                $shoppingCartBall->delete();
            }
        }
           
        return redirect()->route('shoppingcart'); 
    }

    /*
    public function removeCart(Request $request)
    {
        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        return redirect()->route('cart.list');
    }
    */
}
