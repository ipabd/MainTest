<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendJob;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('add', new Product)) {
            return redirect()->route('home')->with('error', 'Нет прав.');
        }
        $status = Status::all();
        return view('admin.product.create', compact('status'));
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
            'name' => 'required|unique:products|min:10',
            'article' => 'required|string|max:255|regex:/^[A-Za-z0-9]+$/|unique:products',
        ]);



        if (!empty($request->nam)) {
            foreach ($request->nam as $i => $v) {
                $obj[] = [$v, $request->zn[$i]];
            }
            $obj = json_encode($obj);
        } else $obj = null;

        $data = [
            'article' => $request->article,
            'name' => $request->name,
            'status' => $request->status,
            'data' => $obj
        ];
        $product = Product::create($data);
        ///почта
        //return redirect()->route('send', ['prod' => $request->NAME]);
        ///через job
        dispatch(new SendJob($request->article))->onQueue('newprod')->delay(10);;
        return redirect()->route('home')->with('success', "Продукт добавлен $request->name");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        if (Gate::denies('edit', new Product)) {
            return redirect()->route('home')->with('error', 'Нет прав.');
        }

        $readonl = "";
        if (Gate::denies('editarticle', new Product)) {
            $readonl = "readonly='readonly'";
        }

        $product = Product::find($id);
        $status = Status::all();
        if (!empty($product->data)) {
            $data = json_decode($product->data);
            $data = object_to_array($data);
        } else $data = $product->data;
        return view('admin.product.edit', compact('product', 'status', 'data', 'readonl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:10',
            'article' => 'required|string|max:255|regex:/^[A-Za-z0-9]+$/|',
        ]);
        if (!empty($request->nam)) {
            foreach ($request->nam as $i => $v) {
                $obj[] = [$v, $request->zn[$i]];
            }
            $obj = json_encode($obj);
        } else $obj = null;

        $data = [
            'article' => $request->article,
            'name' => $request->name,
            'status' => $request->status,
            'data' => $obj
        ];
        $product = Product::find($id);
        $product->update($data);
        return redirect()->route('home')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('destroy', new Product)) {
            return redirect()->route('home')->with('error', 'Нет прав.');
        }
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('home')->with('success', 'Продукт удален.');
    }
}
