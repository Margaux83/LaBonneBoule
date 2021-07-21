<?php

namespace App\Http\Controllers;

use App\Models\Ball;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BallController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Affichage des boules qui ne sont pas supprimées (isdeleted = 0)
0     */
    public function index(){
        $balls = DB::table('balls')
            ->select(DB::raw('id, name, description, price'))
            ->where('isdeleted', '=', 0)
            ->get();
        return view('balls',['balls'=>$balls]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Ajout d'une boule dans la base de données
     */
    public function save(Request $request)
    {
        $ball = new Ball;
        $ball->name = $request->name;
        $ball->image =  $request->image;
        $ball->description =  $request->description;
        $ball->price =  $request->price;
        $ball->save();

        return redirect('/balls')->with('status', 'Message posted');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Récupération de l'id d'une boule pour sa modification
     */
    public function update(Request $request)
    {
        $ball_id =$request->ball_id;
        $ball = Ball::find($ball_id);
        return view('updateball',['ball'=>$ball]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Suppression d'une boule (on passe le champ isdeleted à 1)
     */
    public function delete(Request $request)
    {
        $ball_id =$request->ball_id;
        $ball = Ball::find($ball_id);
        $ball->isdeleted = 1;
        $ball->save();
        return redirect('balls')->with('status', 'Ball deleted');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Modification des informations d'une boule
     */
    public function store(Request $request)
    {
        $ball_id =$request->ball_id;

        $ball = Ball::find($ball_id);
        $ball->name = $request->name;
        $ball->image = $request->image;
        $ball->description = $request->description;
        $ball->price = $request->price;

        $ball->save();
        return redirect('balls')->with('status', 'Ball updated');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Affichage des informations de la boule sélectionnée
     */
    public function ball(Request $request){
        $ball_id = $request->ball_id;
        $ball = Ball::find($ball_id);
        return view('ball',['ball'=>$ball]);
    }

    public function  addToCart(Request $request)
    {
        $ball_id =$request->ball_id;

        $ball = Ball::find($ball_id);


    }

}
