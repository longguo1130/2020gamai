<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Feedback;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;
use App\Bid;
use App\User;
use App\Product;
use App\ProductImages;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use DB;
use File;
use Validator;
use Datatables;
use Log;

class BidderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $success = "";
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $bid = Bid::where('product_id',$product->id)->orderBy("updated_at","desc")->orderBy("created_at","desc")->get();
        $check = DB::table('bids')->where('product_id', $product_id)->where('buyer_id', Auth::user()->id)->get();

        if (count($check) > 0){

            return view('bidder.show',['product'=>$product,'bid'=>$bid,'success'=>$success]);
        }
        else
        return view('bidder.create',['product'=>$product,'bid'=>$bid,'success'=>$success]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'bid_price' => 'required|numeric|max:'.Auth::user()->bid_count,
            'comments'=> 'required|max:255',
            'duration' => 'required|not_in:0',


        ]);

        $bid = new Bid;
        $bid->bid_price = $request->bid_price;
        $bid->buyer_id = $request->buyer_id;
        $bid->seller_id = $request->seller_id;
        $bid->product_id = $request->product_id;
        $bid->comments = $request->comments;
        $bid->price = $request->price;
        $bid->duration = $request->duration;
        $bid->block = 0;
        $bid->seller_status=0;
        $bid->buyer_status=0;
        $bid->save();
        Auth::user()->update(['bid_count'=>Auth::user()->bid_count-$request->bid_price]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('bidder.edit', []);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $bid = Bid::find($id);
        $product = Product::where('id', $bid->product_id)->first();


        return view('bidder.edit', ['product'=>$product,'bid'=>$bid]);

    }

    public function accept(Request $request ,$id){

        $update = [
            'status'=>2
        ];
        Bid::where('product_id',$id)->where('buyer_id',$request->buyer_id)->update($update);

        $product = Product::find($id);

        $product->status = 2;
        $product->save();

        return view('user.profile',['user'=>Auth::user()]);


    }

    public function cancel($id){
        $product = Product::find($id);
        $product->status = 0;
        $product->save();
        $update = [
            'status'=>0
        ];
        Bid::where('product_id',$id)->where('status',2)->update($update);
        return view('user.profile',['user'=>Auth::user()]);

    }

    public function complete($id){
        $product = Product::find($id);
        $product->status = 1;
        $product->save();
        $update = [
            'status'=>1
        ];
        Bid::where('product_id',$id)->where('status',2)->update($update);
        $bid = Bid::where('product_id',$id)->where('status',1)->first();
        $user = User::where('id',$bid->buyer_id)->first();
        $user->update(['bid_count'=>$bid->bid_price+$user->bid_count]);

        Bid::where('product_id',$id)->where('status','<>',1)->delete();
        $buyer =  User::where('id',$bid->buyer_id)->first();
        $buyer->transaction_count = $buyer->transaction_count+1;
        if ( fmod($buyer->transaction_count,10)==0){

            if ($buyer->verify_status<100){
                $buyer->verify_status = $buyer->verify_status+5;
                if ($buyer->verify_status==50)
                    $buyer->bid_count = $buyer->bid_count +5000;
                elseif ($buyer->verify_status>50)
                    $buyer->bid_count = $buyer->bid_count +10000;
                elseif ($buyer->verify_status>90)
                    $buyer->bid_count = $buyer->bid_count +5000;
                elseif($buyer->verify_status>100)
                    $buyer->bid_count = 100000-$buyer->bid_count ;
            }

        }
        $buyer->save();
        $seller =  User::where('id',$bid->seller_id)->first();
        $seller->transaction_count = $seller->transaction_count+1;
        if ( fmod($seller->transaction_count,10)==0){

            if ($seller->verify_status<100) {
                $seller->verify_status = $seller->verify_status + 5;
                if ($seller->verify_status == 50)
                    $seller->bid_count = $seller->bid_count + 5000;
                elseif ($seller->verify_status > 50)
                    $seller->bid_count = $seller->bid_count + 10000;
                elseif ($buyer->verify_status > 90)
                    $seller->bid_count = $seller->bid_count + 5000;
                elseif ($seller->verify_status > 100)
                    $seller->bid_count = 100000 - $seller->bid_count;
            }
        }

        $seller->save();

        return view('user.feedback',['bid'=>$bid]);
    }

    public function provide_feedback($id){
        $bid = Bid::find($id)->first();
        return view('user.feedback',['bid'=>$bid]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $update = [
            'bid_price'=>$request->input('bid_price'),
            'duration'=>$request->input('duration'),
            'comments'=>$request->input('comments')
        ];
        Bid::where('id',$id)->update($update);
        $bid = Bid::where('id',$id)->first();

        $product = Product::where('id',$bid->product_id)->first();
        $bid = Bid::where('product_id',$product->id)->orderBy("updated_at","desc")->orderBy("created_at","desc")->get();
        $success = "You edited your bid successfully";
        return view('bidder.show',['product'=>$product,'bid'=>$bid,'success'=>$success]);


    }

    public function feedback(Request $request){
       $bid = Bid::find($request->id);
       $feedback = Feedback::create();
       $feedback->from_user = Auth::user()->id;

       $feedback->to_user = $bid->seller_id==Auth::user()->id?$bid->buyer_id:$bid->seller_id;

       $feedback->feedback_type = $request->feedback_type;
       $feedback->rating = $request->rating;
       $feedback->comments = $request->comments;
       $feedback->product_id = $bid->product_id;
       $feedback->save();

       return redirect('profile');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bid = Bid::find($id);
        $user = User::where('id',$bid->buyer_id)->first();
        $user->update(['bid_count'=>$user->bid_count+$bid->bid_price]);
        $product = Product::where('id',$bid->product_id)->first();
        $bid->delete();
        $success = "You deleted your bid successfully.";
        $bids = Bid::where('product_id',$product->id)->get();

//        return redirect()->back();
        return view('products.show_logged',['product'=>$product,'bid'=>$bids,'success'=>$success]);
    }

    public function show_review($id){
        $user = User::find($id);
        return view('user.review_detail',['review'=>$user]);
    }

}
