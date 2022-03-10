<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //dd('дддд');

        if (Gate::denies('edit', new Product))
            $product = Product::status()->get();
        else $product = Product::all();

        $data = [];
        foreach ($product as $i => $prod) {
            if (!empty($prod->DATA)) {
                $dat = json_decode($prod->DATA);
                $data[] = object_to_array($dat);
            } else $data[] = $prod->DATA;
        }
        return view('home', compact('product', 'data'));
    }


    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        if (!empty($product->DATA)) {
            $data = json_decode($product->DATA);
            $data = object_to_array($data);
        } else $data = $product->DATA;
        return view('show', compact('product', 'data'));
    }
}
