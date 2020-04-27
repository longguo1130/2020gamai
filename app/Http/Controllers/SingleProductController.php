<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;
use App\Product;
use App\ProductImages;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

use DB;
use File;
use Validator;
use Datatables;
use Log;
class SingleProductController extends Controller
{
    public function __construct()
    {

    }

    public function index($id)
    {
        //$id = $request->id;
        $product = Product::find($id);

        return view ('products.singleshow',['product'=>$product]);
    }
}
