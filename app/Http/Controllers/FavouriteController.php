<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;
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

class FavouriteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request ){
        echo $request->id;
        echo Auth::user()->id;
    }

}
