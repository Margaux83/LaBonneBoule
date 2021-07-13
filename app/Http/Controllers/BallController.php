<?php

namespace App\Http\Controllers;

use App\Models\Ball;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BallController extends Controller
{
    public function index(){
        $balls = DB::table('balls')
            ->select(DB::raw('id, name'))
            ->where('isdeleted', '=', 0)
            ->get();
        return view('balls',['balls'=>$balls]);
    }

    public function save(Request $request)
    {
        $ball = new Ball;
        $ball->name = $request->name;
        $ball->image =  $request->image;
        $ball->save();

        return redirect('/balls')->with('status', 'Message posted');
    }

    public function update(Request $request)
    {
        $ball_id =$request->ball_id;
        $ball = Ball::find($ball_id);
        return view('updateball',['ball'=>$ball]);

    }

    public function delete(Request $request)
    {
        $ball_id =$request->ball_id;
        $ball = Ball::find($ball_id);
        $ball->isdeleted = 1;
        $ball->save();
        return redirect('balls')->with('status', 'Ball deleted');

    }
    public function store(Request $request)
    {

        $ball_id =$request->ball_id;

        $ball = Ball::find($ball_id);
        $ball->name = $request->name;
        $ball->image = $request->image;

        $ball->save();
        return redirect('balls')->with('status', 'Ball updated');
    }

    public function ball(Request $request){


        $ball_id = $request->ball_id;
        $ball = Ball::find($ball_id);
        return view('ball',['ball'=>$ball]);

    }

}
