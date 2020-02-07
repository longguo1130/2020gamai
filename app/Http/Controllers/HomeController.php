<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Product;
use App\City;
use Auth;
use DB;


class HomeController extends Controller
{
    protected $paginate_product = 8;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         parent::__construct();
//         $this->middleware('auth');
     }

    /**
     * Show the application dashboard.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $query = $request->input('q');
        return view ('welcome',['query'=>$query]);
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * get list for city autocomplete
     */
    public function city_autocomplete(Request $request)
    {
        $data = City::select('city as value','id as data')->where("city","LIKE","%{$request->input('query')}%")
            ->get();

        return response()->json(['suggestions'=>$data]);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * to bring products by scrolling with ajax on home page
     * @throws \Throwable
     */
    public function bring_products(Request $request){
        $city_id = intval($request->input('city_id')) == 0 ? '%' : $request->input('city_id');
        $query = $request->input('query');
        $price_min = intval($request->input('price_min'));
        $price_max = intval($request->input('price_max'));
        $sort_id = $request->input('sort_id');
        $category_id = intval($request->input('category_id')) == 0 ? '%' : $request->input('category_id');



        $products = Product::where('status',0)->where('title','like','%'.$query.'%')
            ->where('category_id','like',$category_id)
            ->where('city_id','like',$city_id);
        if($price_max != 0 and $price_min != 0){
            $products = $products->whereBetween('price',[$price_min,$price_max]);
        }
        $products = $products->orderBy('created_at', 'desc')->with('firstImage')->paginate($this->paginate_product);

        // get favorites by the user
        $user_id = Auth::check() ? Auth::user()->id : null;
        $favorites = Favorite::where('user_id',$user_id)->pluck('product_id')->all();

        if ($request->ajax()) {
            $current_page = $products->currentPage();
            $last_page = $products->lastPage();
            return [
                'products' => view('products.ajax_page')->with(compact('products','user_id','favorites'))->render(),
                'next_page' => $current_page+1,
                'last_page' => $last_page,
            ];
        }
        return view('400');
    }
    public function show_detail(Request $request){

    }
}
