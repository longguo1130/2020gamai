<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Bid;

use App\ProductImages;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use DB;
use File;
use Validator;
use Datatables;
use Log;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth',['except' =>['show']]);
    }

    public function index()
    {

        $products = Product::paginate(8);
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'title' => 'required|max:255',
            'city_id'=> 'required|max:255',
            'transaction_type' => 'required|not_in:0',
            'category_id' => 'required|numeric|not_in:0',
            'price' => 'required|numeric',
            'text' => 'required|max:255',

        ]);
        $post = new Product;
        $post->title = $request->title;
        $post->city_id = $request->city_id;
        $post->price = $request->price;
        $post->category_id = $request->category_id;
        $post->transaction_type = $request->transaction_type;
        $post->text = $request->text;
        $post->user_id = Auth::user()->id;
        $post->seller = Auth::user()->username;
        $post->save();
        $post_id = $post->id;
        if (!empty($request->image)){
            $product_image_ids = $request->image;
            ProductImages::whereIn('id',$product_image_ids)->update(['product_id'=>$post_id]);
        }
       else{
           $product = new ProductImages();
           $product->path = "no-image.png";
           $product->name = "no_image";
           $product->extension = "png";
           $product->product_id = $post_id;
           $product->save();
       }


//        return redirect()->back();

        return view('products.create_success',['product'=>$post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $product = Product::find($id);

//        $bid = DB::table('bids')->where('product_id', $id)->orderByRaw('created_at - updated_at DESC')->get();
//        $bid = DB::table('bids')->where('product_id', $id)->orderBy("created_at","desc")->get();
        $bid = DB::table('bids')->where('product_id', $id)->orderBy("status","desc")->orderBy("updated_at","desc")->orderBy("created_at","desc")->get();

        $check = array();
        $success = "";

        if (Auth::check())
        {
            if ($product->user_id == Auth::user()->id){
                if ($product->status == 1){
                    $bid = Bid::where('product_id',$product->id)->where('status',1)->get();
                    return view('bidder.sold',['product'=>$product,'bid'=>$bid]);
                }
                return view('bidder.seller',['product'=>$product,'bid'=>$bid]);
            }
            $check = DB::table('bids')->where('product_id', $id)->where('buyer_id', Auth::user()->id)->get();
        }

        if (count($check) > 0){
            return view('bidder.show',['product'=>$product,'bid'=>$bid,'success'=>$success]);
        }
        else{
            $view = Auth::check() ? 'products.show_logged' : 'products.show';
            return view ($view,['product'=>$product,'bid'=>$bid,'success'=>""]);
        }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Product::find($id);

        $postImage = $post->images;

        return view('products.edit', ['post' => $post, 'postImage' => $postImage]);
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

        $request->validate([
            'title' => 'required|max:255',

            'transaction_type' => 'required|not_in:0',
            'category_id' => 'required|numeric|not_in:0',
            'price' => 'required|numeric',
            'text' => 'required|max:255',

        ]);


       $post = Product::find($request->id);

        $post->title = $request->title;

        $post->price = $request->price;
        $post->category_id = $request->category_id;
        $post->transaction_type = $request->transaction_type;
        $post->text = $request->text;

        $post->save();

        $postId = $post->id;

        $productImages = ProductImages::where('product_id', $postId)->get();

        if ($request->file('image') != null) {
            $images = $request->file('image');

            foreach ($productImages as $productImage) {
                Storage::delete($productImage->images);
                $productImage->delete();
            }

            $images = $request->file('image');
            //$postFind = Product::where('title' , $post->title)->first();
            foreach ($images as $image) {
                $postImage = new ProductImages;
                $path = $image->store('public/product_images');
                $postImage->productId = $postId;
                $postImage->images = $path;
                $postImage->save();

            }

        }



        //Session::flash('flash_message', 'Task successfully added!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Product::find($id);
        Storage::delete($post->images);
        $post->delete();

        return redirect('/');
    }


    /**
     *
     */
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
            $img->resize(128, 128, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.DIRECTORY_SEPARATOR.$input['imagename']);

            //
            $destinationPath = public_path('images');
            $upload_success = $file->move($destinationPath, $input['imagename']);

            if( $upload_success ) {
                $upload = ProductImages::create([
                    "name" => $filename,
                    "path" => $upload_filename,
                    "extension" => pathinfo($filename, PATHINFO_EXTENSION),
                ]);
                $upload->save();

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
        $upload = ProductImages::find($upload_id);
        return response()->json([
            "status" => "success",
            "img_url" => asset('images/'.$upload->path),
            "thumb_url" => asset('thumbnails/'.$upload->path),
            "image_id" => $upload_id,
        ], 200);
    }

    /**
     * @param Request $request
     * set favorite on selected product
     */
    public function set_favorite(Request $request){
        $user_id = $request->user_id;
        $product_id = $request->product_id;

        $favor = Favorite::where('user_id',$user_id)->where('product_id',$product_id)->first();
        if(is_null($favor)){
            $favor = new Favorite;
            $favor->user_id = $user_id;
            $favor->product_id = $product_id;
            $favor->save();
            $status = 'checked';
        }else{
            $favor->delete();
            $status = 'none';
        }

        return response()->json(['status'=>$status, 'product_id'=>$product_id]);
    }
}
