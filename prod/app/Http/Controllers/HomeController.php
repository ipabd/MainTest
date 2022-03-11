<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {  ///для проверки задания
        $res = onmsql(DB::select("SELECT count(*) as cou FROM statuses"));
        if (!$res->cou) {
            DB::beginTransaction();
            try {
                DB::insert("INSERT INTO statuses (id ,name , status) values (?,?,?)", [1,'Доступен	', 'available']);
                DB::insert("INSERT INTO statuses (id ,name , status) values (?,?,?)", [2,'Не доступен	', 'unavailable']);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                echo $e->getMessage();
            }
        }

        $res = onmsql(DB::select("SELECT count(*) as cou FROM permissions"));
        if (!$res->cou) {
            DB::beginTransaction();
            try {
                DB::insert("INSERT INTO permissions (id ,name) values (?,?)", [1, 'ADD_PROD']);
                DB::insert("INSERT INTO permissions (id ,name) values (?,?)", [2, 'UPDATE_ARTICLE']);
                DB::insert("INSERT INTO permissions (id ,name) values (?,?)", [3, 'UPDATE_PROD']);
                DB::insert("INSERT INTO permissions (id ,name) values (?,?)", [4, 'DELETE_PROD']);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                echo $e->getMessage();
            }
        }

        $res = onmsql(DB::select("SELECT count(*) as cou FROM roles"));
        if (!$res->cou) {
            DB::beginTransaction();
            try {
                DB::insert("INSERT INTO roles (id ,name) values (?,?)", [1, 'Admin']);
                DB::insert("INSERT INTO roles (id ,name) values (?,?)", [2, 'Moderator']);
                DB::insert("INSERT INTO roles (id ,name) values (?,?)", [3, 'Guest']);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                echo $e->getMessage();
            }
        }


        $res = onmsql(DB::select("SELECT count(*) as cou FROM permission_role"));
        if (!$res->cou) {
            DB::beginTransaction();
            try {
                DB::insert("INSERT INTO permission_role (role_id ,permission_id) values (?,?)", [1, 1]);
                DB::insert("INSERT INTO permission_role (role_id ,permission_id) values (?,?)", [1, 2]);
                DB::insert("INSERT INTO permission_role (role_id ,permission_id) values (?,?)", [1, 3]);
                DB::insert("INSERT INTO permission_role (role_id ,permission_id) values (?,?)", [1, 4]);
                DB::insert("INSERT INTO permission_role (role_id ,permission_id) values (?,?)", [2, 3]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                echo $e->getMessage();
            }
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Gate::denies('edit', new Product))
            $product = Product::status()->get();
        else $product = Product::all();

        $data = [];
        foreach ($product as $i => $prod) {
            if (!empty($prod->data)) {
                $dat = json_decode($prod->data);
                $data[] = object_to_array($dat);
            } else $data[] = $prod->data;
        }
        return view('home', compact('product', 'data'));
    }


    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        if (!empty($product->data)) {
            $data = json_decode($product->data);
            $data = object_to_array($data);
        } else $data = $product->data;
        return view('show', compact('product', 'data'));
    }
}
