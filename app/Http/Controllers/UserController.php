<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shoppingcartball;
use App\Models\Inventory;

class UserController extends Controller
{
    public function addUserBalance(Request $request) 
    {
        $user = auth()->user();
        
        $shoppingCartBalls = Shoppingcartball::where('shoppingcart_id', '=', $request->shoppingcart_id)->get();

        foreach ($shoppingCartBalls as $key => $shoppingCartBall) {
            $ballBought = new Inventory;
            $ballBought->user_id = $user->id;
            $ballBought->ball_id = $shoppingCartBall->ball_id;
            $ballBought->save();

            $shoppingCartBall->delete();
        }

        $user->balance = 0;
        $user->balance_needed = 0;
        $user->save();

        return redirect()->route('inventory'); 

        //Not functionnal
        $user->checkoutCharge($user->balance_needed, 'Balance', 1);

        return redirect('/shoppingcart');
        /*
        try {
            $user->charge($user->balance_needed, 'pm_card_threeDSecure2Required');
        } catch (IncompletePayment $exception) {
            $exception->payment->status;

            dd($exception->payment->status);
        
            if ($exception->payment->requiresPaymentMethod()) {
                // ...
            } elseif ($exception->payment->requiresConfirmation()) {
                // ...
            }
        }
        */
    }
}