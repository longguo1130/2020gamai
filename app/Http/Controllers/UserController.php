<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\UserImages;
use Illuminate\Http\Request;

use App\Exports\UsersExport;
use App\Exports\ProdcutsExport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Feedback;
use App\Bid;
use App\Message;
use App\ProductImages;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use Auth;
use DB;
use File;
use Validator;
use Datatables;
use Log;
use App\Membership;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
class UserController extends Controller
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

    /**
     * @param $id : user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile($id = 0)
    {

        $user = User::find(Auth::user()->id);

        $possible_time = time()-$user->membership_created_at;




        if($user->membership_type == 1){
            if ($possible_time>86400*365){
                $user->update(['bid_count'=>5000]);

            }
            else{

                if ($possible_time>2592000)
                    $user->update(['bid_count'=>$user->bid_count+Membership::where('id',$user->membership)->bid_limit]);
            }
        }
        elseif($user->membership_type == 2){
            if ($possible_time>86400*30){
                $user->update(['bid_count'=>5000]);
            }
        }


        $feedbacks = Feedback::where('to_user',Auth::user()->id)->where('feedback_type',0)->get();
        $count = Feedback::where('to_user',Auth::user()->id)->get();

        $user->rating = 0;
        foreach ($feedbacks as $feedback){
            $user->rating = $user->rating + $feedback->rating;
        }
        if ($user->rating != 0){

            $user->rating = round($user->rating/count($count),1);

        }




        $user->save();

        //todo : should not use user id for profile secure
        if($id == 0) $id = Auth::user()->id;
        $user = User::find($id);

        return view('user.profile', ['user'=>$user]);
    }

    public function profile_edit($id){
        $user = User::find($id);
        return view('user.profile_edit',['post'=>$user]);
    }

    public function store(Request $request ){
        $request->validate([
            'password' => 'confirmed',


        ]);


        $user = User::find($request->id);
        $user->fullname = $request->fullname;
        $user->address1 = $request->address1;

        $user->address2 = $request->address2;
        $user->mobile = $request->mobile;
        $user->email = $request->email1;
        $user->birthday = $request->birthday;
        $user->update_count = $user->update_count+1;
        $user->password = Hash::make($request->password);
        if ($user->update_count == 1){
            $user->verify_status = $user->verify_status + 10;
        }

        $user->save();

        $post_id = $request->id;
        if ($request->image){


            $profile_image = $request->image;
            UserImages::whereIn('id',$profile_image)->update(['user_id'=>$post_id]);
        }
        return redirect('profile');

    }
    public function profile_detail(){
        $products = Product::owner()->selling()->orderBy('created_at')->with('firstImage')->get();


        $selling_html = view('user.selling',['products'=>$products])->render();
//        $products = Product::owner()->sold()->orderBy('created_at')->with('firstImage')->get();
        $products = Bid::where('status',1)->get();
//        Carbon::createFromFormat("Y-m-d H:i:sO",$products[0]->updated_at);
//

        $sold_html = view('user.sold',['products'=>$products])->render();

        // favorites
        $products = Favorite::owner()->with('productInfo.firstImage')->get();



        $favor_html = view('user.favorite',['products'=>$products])->render();

        $reviews = Feedback::where('to_user',Auth::user()->id)->get();
        $review_html = view('user.review',['reviews'=>$reviews])->render();

        // bidding
//        $products = Bid::where('buyer_id', Auth::user()->id)->where('status',0)->orWhere('status',2)->orderBy('status','desc')->get();
//        $products_buyer = Bid::where('buyer_id', Auth::user()->id);
//        $products = $products_buyer->where('status',0)->orWhere('status',2)->orderBy('status','desc')->get();
        $products = Bid::where('status','<>',1)->where('buyer_id', Auth::user()->id)->orderBy('status','desc')->get();
        $bidding_html = view('user.bidding',['products'=>$products])->render();

        return response()->json([
            'status'=>true,
            'selling_html'=>$selling_html,
            'sold_html'=>$sold_html,
            'favor_html'=>$favor_html,
            'bidding_html'=>$bidding_html,
            'review_html'=>$review_html,
        ]);
    }
    public function upload_image(){

        $input = Input::all();

        if(Input::hasFile('file')) {
            /*
            $rules = array(
                'file' => 'mimes:jpg,jpeg,bmp,png,pdf|max:3000',
            );
            $validation = Validator::make($input, $rules);
            if ($validation->fails()) {
                return response()->json($validation->errors()->first(), 400);
            }
            */
            $file = Input::file('file');
            $filename = $file->getClientOriginalName();
            $upload_filename = time().'.'.$file->extension();

            $input['imagename'] = $upload_filename;
            $destinationPath = public_path('thumbnails');
            $img = Image::make($file->path());

            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.DIRECTORY_SEPARATOR.$input['imagename']);

            //
            $destinationPath = public_path('avatars');
            $upload_success = $file->move($destinationPath, $input['imagename']);

            if( $upload_success ) {
                $upload = UserImages::create([
                    "name" => $filename,
                    "path" => $upload_filename,
                    "extension" => pathinfo($filename, PATHINFO_EXTENSION),
                ]);
                $upload->save();
                $user = User::find(Auth::user()->id);
                $user->avatar = $upload_filename;
                $user->save();
                return response()->json([
                    "status" => "success",
                    "upload_id" => $upload->id
                ], 200);
            } else {
                return response()->json([
                    "status" => "error"
                ], 400);
            }
        } else {
            return response()->json('error: upload file not found.', 400);
        }

    }

    public function uploaded_image(Request $request){
        $upload_id = $request->input('upload_id');
        $upload = UserImages::find($upload_id);
        return response()->json([
            "status" => "success",
            "img_url" => asset('avatars/'.$upload->path),
            "thumb_url" => asset('thumbnails/'.$upload->path),
            "image_id" => $upload_id,
        ], 200);
    }

    public function chatting(){
        $user = User::find(Auth::user()->id);

//       $bid = Bid::where('seller_id',$user->id)->orWhere('buyer_id',$user->id)->where('status','<>',0)->having('status','<>',3)->get();
        $bid = Bid::where(function ($query) use ($user) {
            $query->where('seller_id',$user->id)->where('seller_status', 0)->where('status','<>',0);
        })->orWhere(function ($query) use ($user) {
            $query->where('buyer_id', $user->id)->where('buyer_status',0)->where('status','<>',0);
        })->get();


        $messages = Message::where('from_user', Auth::user()->id)->orderBy('created_at', 'ASC')->limit(100)->get();

        return view('user.chatting',['user'=>$user,'bid'=>$bid,'messages'=>$messages]);
    }

    public function social_success(Request $request){

        $fields = $this->validate($request,[
            'username' => 'required',
        ]);

        try{
            $user = User::find($request->id);
            $user->username = $request->username;
            $user->address1 = $request->location;
            $user->email_verified_at = now();
            $user->password = Hash::make($request->password);
            $user->save();
        }
        catch(\Exception $e){
            return view('user.social_success' ,['user'=>$user,'duplicate'=>'This username is already used']);
        }

        return redirect('profile');
    }

    public function excel(Request $request){
        if ($request->user=='user'){
//
            return Excel::download(new UsersExport, 'users.xlsx');
        }

        if ($request->user == 'product'){

            return Excel::download(new ProdcutsExport, 'products.xlsx');
        }

    }

    public function upload_id(Request $request){
        $file = $request->file('image');

        $filename = $file->getClientOriginalName();

        $upload_filename = time().'.'.$file->extension();

        $input['image'] = $upload_filename;
        $destinationPath = public_path('valid_ids');
        $img = Image::make($file->path());

        $img->save($destinationPath.DIRECTORY_SEPARATOR.$input['image']);
        User::find($request->id)->update(['valid_id'=>$upload_filename]);
        $output = array(
            'success' => 'Image uploaded successfully'
        );

        return response()->json($output);



    }

    public function change_password(Request $request){
        $user = User::where('id',$request->id)->first();

        return view('user.change_password',['user'=>$user]);

    }

    public function store_newpassword(Request $request){
        $user = User::where('id',$request->id)->first();

        if (Hash::check( $request->current_password, $user->password)) {
            //add logic here

            $request->validate([

                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);
             $user->update(['password'=> Hash::make($request->new_password)]);
             return redirect('profile');
        }
        else{
            return redirect()->back();
        }

    }

    public function make_deposit($id){

        $user = User::where('id',$id)->first();
        return view('user.make_deposit',['user'=>$user]);
    }

    public function store_deposit(Request $request){

        $user = User::where('id',$request->id)->first();
        $user->update(['deposit'=>$request->amount+$user->deposit]);
        return redirect('/');
    }

    public function membership($id){
        $user = User::where('id',$id)->first();
        $membership = Membership::all();
        return view('user.membershiptest',['user'=>$user,'membership'=>$membership]);
    }

    public function upgrade_membership(Request $request){
        $membership = Membership::where('id',$request->membership+1)->first();

        $user = User::where('id',$request->id)->first();

        if ($user->deposit > $membership->amount){

            $user->membership = $membership->id-1;
            $user->bid_count = $membership->bid_limit;
            $user->deposit = $user->deposit-$membership->amount;
            $user->save();
            $message = "You upgraded your membershp successfully";
            return view('user.membership',['user'=>$user,'membership'=>Membership::all(),'message'=>$message]);
        }
        else{
            $message = "You should make your deposit before upgrade to this membership";
            return view('user.make_deposit',['user'=>$user,'message'=>$message]);
        }

    }
    public function paypal_success(Request $request){
//        return redirect('profile');

        $user = User::where('id',$request->user_id)->first();
        $membership = Membership::where('id',$request->membership)->first();
        $user->membership = $request->membership;
        $user->bid_count = $user->bid_count + $membership->bid_limit;
        $user->membership_type = $request->type;
        $user->membership_created_at = time();
        $user->save();
        $success_html =  view('user.pay_success',['user'=>$user,'membership'=>$membership])->render();
        return response()->json([
            'status'=>true,
            'success_html'=>$success_html,
        ]);
    }


}
