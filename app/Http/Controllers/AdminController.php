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

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function home(Request $request){

        return view('admin.admin');
    }

    public function admin_detail(){

        $users = User::get();
        $users_html = view('admin.users',['users'=>$users])->render();
        $bids = Bid::get();
        $bidding_html = view('admin.bidding',['bids'=>$bids])->render();
        $messages = Message::get();
        $message_html = view('admin.messages',['messages'=>$messages])->render();
        $products = Product::get();
        $product_html = view('admin.products',['products'=>$products])->render();
        $reviews = Feedback::get();
        $review_html = view('admin.review',['reviews'=>$reviews])->render();
        $category = Category::get();
        $category_html = view('admin.category',['category'=>$category])->render();
        $city = City::get();
        $city_html = view('admin.city',['city'=>$city])->render();
        return response()->json([
            'status'=>true,
            'users_html'=>$users_html,
            'bidding_html'=>$bidding_html,
            'message_html'=>$message_html,
            'product_html'=>$product_html,
            'review_html'=>$review_html,
            'category_html'=>$category_html,
            'city_html'=>$city_html,

        ]);
    }

    public  function user_edit(Request $request){
        $user = User::find($request->id);
        return view('admin.user_edit',['user'=>$user]);
    }

    public function user_store(Request $request){

        $user = User::find($request->id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->verify_status = $request->verify_status;
        $user->rating = $request->rating;
        $user->transaction_count = $request->transaction_count;
        $user->bid_count = $request->bid_count;
        $user->user_role = $request->user_role;
        $user->save();

        return redirect('admin');

    }

    public  function user_delete(Request $request){

        User::find($request->id)->delete();

        return redirect()->back();

    }

    public function user_valid_id(Request $request){
        $user = User::find($request->id);
        if ($request->accept ==1){
            $user->update(['valid_id_status'=>1,'verify_status'=>$user->verify_status+10]);

        }
        else{
            $user->update(['valid_id_status'=>2,'valid_id'=>null]);
        }
        return redirect('admin');

    }

    public function verify_email(Request $request){
        $user = User::where('id',$request->id)->first();
        $user->email_verified_at = now();
        $user->verify_status = $user->verify_status + 5;
        $user->save();
        return redirect()->back();
    }

    public function create_user(){
        return view('admin.create_user');
    }

    public function store_newuser(Request $request){
        $user =  User::create([

            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'avatar' => "default.png",
            'userrole'=> $request['userrole'],
            'verify_status'=>5,

            'bid_count'=>5000,

        ]);

        return redirect('admin');
    }

    public function moderator($user , $type){

        $moderator = new Moderator();
        $moderator->user_id = $user;
        $moderator->type = $type;
        $moderator->save();
        return redirect('admin');



    }

}
