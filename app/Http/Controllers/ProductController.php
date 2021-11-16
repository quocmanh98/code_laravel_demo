<?php

namespace App\Http\Controllers;

use App\category_product;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->input('select');
        $price = $request->input('price');

        if($price){
            switch ($price) {
                case '1':
                    $product = product::where('product_price_new', '<', 500000)->paginate(12);
                    break;

                case '2':
                    $product = product::whereBetween('product_price_new', [500000, 1000000])->paginate(12);
                    break;

                case '3':
                    $product = product::whereBetween('product_price_new', [1000000, 5000000])->paginate(12);
                    break;

                case '4':
                    $product = product::whereBetween('product_price_new', [5000000, 10000000])->paginate(12);
                    break;

                case '5':
                    $product = product::where('product_price_new', '>', 10000000)->paginate(12);
                    break;

                default:
                    $product = product::paginate(12);
                    break;
            }
        }else{
            if($request->input('s')){
                $keyword = $request->input('s');
            }else{
                $keyword = '';
            }
            $product = product::where('product_name','LIKE',"%$keyword%")->paginate(10);
        }

        if($filter){
            switch ($filter) {
                case '1':
                    $product = product::orderBy('product_name', 'desc')->paginate(12);
                    break;

                case '2':
                    $product = product::orderBy('product_name', 'asc')->paginate(12);
                    break;

                case '3':
                    $product = product::orderByRaw('(product_price_old - product_price_new) desc')->paginate(12);
                    break;

                case '4':
                    $product = product::orderByRaw('(product_price_old - product_price_new) asc')->paginate(12);
                    break;

                default:
                    $product = product::paginate(12);
                    break;
            }
        }

        $categoryProduct = category_product::all();
        return view('user.product.index', compact('categoryProduct', 'product'));
    }

    public function detail($slug)
    {
        $categoryProduct = category_product::all();
        $product = product::where(['product_slug' => $slug,'product_status'=>1])->first();
        if(!empty($product)){
            return view('user.product.detail',compact('categoryProduct','product'));
        }else{
            return redirect()->route('home.user');
        }
    }

    public function category(Request $request, $slug)
    {
        $categoryProduct = category_product::all();
        $category_by_product = DB::table('category_products')
            ->join('products', 'product_category_id', '=', 'category_products.category_id')
            ->where([
                ['category_products.category_slug', $slug],
                ['products.product_status', 1]
            ])->paginate(10);
        $item = category_product::where('category_slug', $slug)->first();
        if(!empty($category_by_product) && !empty($item)){
            return view('user.product.category', compact('categoryProduct', 'category_by_product', 'item'));
        }else{
            return redirect()->route('home.user');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
