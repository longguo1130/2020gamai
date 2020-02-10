<?php

namespace App\Http\Controllers;

use App\Category;
use App\Feedback;
use Illuminate\Http\Request;
use App\User;
use App\Bid;
use App\Message;
use App\Product;
use App\City;
use Illuminate\Support\Facades\Hash;
use App\Moderator;

class ModeratorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('moderator');
    }
    public function home(Request $request){
        $user = User::get();

        return view('moderator.index',['users'=>$user]);
    }
    public function user_valid_id(Request $request){
        $user = User::find($request->id);
        if ($request->accept ==1){
            $user->update(['valid_id_status'=>1,'verify_status'=>$user->verify_status+10]);

        }
        else{
            $user->update(['valid_id_status'=>2,'valid_id'=>null]);
        }
        return redirect('moderator');

    }

    public  function user_edit(Request $request){
        $user = User::find($request->id);
        return view('moderator.user_edit',['user'=>$user]);
    }
    public function user_store(Request $request){

        $user = User::find($request->id);

        $user->bid_count = $request->bid_count;

        $user->save();

        return redirect('moderator');

    }

}
