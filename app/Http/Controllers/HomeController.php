<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Product;
use App\City;
use Auth;
use DB;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;



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
//         dd(env('PUSHER_APP_KEY'));
//
     }

    /**
     * Show the application dashboard.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        dd(env('PUSHER_APP_KEY'));
//        dd('asdf');

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
//        $city_id = intval($request->input('city_id')) == 0 ? '%' : $request->input('city_id');
//        dd($request->input('city_id'));
        $query = $request->input('query');
        $city_id = $request->input('city_id');
        $price_min = intval($request->input('price_min'));
        $price_max = intval($request->input('price_max'));
        $sort_id = $request->input('sort_id');

        $category_id = intval($request->input('category_id')) == 0 ? '%' : $request->input('category_id');



        $products = Product::where('status',0)->where('title','like','%'.$query.'%')
            ->where('category_id','like',$category_id)
            ->where('location','like','%'.$city_id.'%');
        if($price_max != 0 and $price_min != 0){
            $products = $products->whereBetween('price',[$price_min,$price_max]);
        }
        switch ($sort_id){
            case '0':
                $products = $products->orderBy('created_at', 'desc');
                break;
            case '1':
                $products = $products->orderBy('created_at', 'asc');
                break;
            case '2':
                $products = $products->orderBy('price', 'asc');
                break;
            case '3':
                $products = $products->orderBy('price', 'desc');
                break;


        }
        $products = $products->with('firstImage')->paginate($this->paginate_product);



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

    public function about_us(){
        return view('about_us');
    }

    public function contact_us(){
        return view('contact_us');
    }
    public function contact_send(Request $request){

        Mail::to('gamai@gamai.ph')->send(new MailtrapExample($request));
        return redirect('/');
    }
    public function term_condition(){
        return view('terms_condition');

    }

    public function police(){
        return view('police');

    }
    public function support(){
        return view('support_test');
    }

    function substrwords($text, $maxchar, $end='...') {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i      = 0;
            while (1) {
                $length = strlen($output)+strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                }
                else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        }
        else {
            $output = $text;
        }
        return $output;
    }
}
