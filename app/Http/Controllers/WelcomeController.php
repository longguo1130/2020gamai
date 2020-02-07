<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\productImages;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
      
        $post = Product::find($id);
        //$postImage = ProductImages::where('productId',$id)->get();
        $postImage = DB::table('productImages')->where('productId',$id)->get();
        return view('welcome',['post'=>$post,'postImage'=>$postImage]);
    }
}