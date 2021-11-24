<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class StorehouseController extends Controller
{
    public function get_add_item()
    {
        $value = Cookie::get('token');
        $category = Http::withToken($value)->get(env('BACKEND_URL') . 'CategoryStorehouses/categorystorehouse')->json();

        $unit = Http::withToken($value)->get(env('BACKEND_URL') . 'Units/units')->json();

        return view('Storehouse.Additem', ['category' => $category, 'units' => $unit]);
    }
    public function post_add_item(Request $request)
    {

        $request->validate([
            'name_p' => 'required',
            'weight' => 'required',
            'categoryUnit' => 'required',
            'categoryStorehouse' => 'required',
        ]);
        $value = Cookie::get('token');
        $response = Http::withToken($value)->post(env('BACKEND_URL') . 'Storehouse/add_material/', [
            'name' => ucfirst($request->input('name_p')),
            'description' => ucfirst($request->input('description')),
            'weight' => intval($request->input('weight')),
            'expiry_date' => $request->input('expiry_date'),
            'type_spray' => ucfirst($request->input('type_spray')),
            'application' => ucfirst($request->input('application')),
            'CategoryStorehouseId' => intval($request->input('categoryStorehouse')),
            'UnitId' => intval($request->input('categoryUnit'))
        ])->json();
        return redirect('/storehouse');
    }
    public function get_storehouse()
    {

        $value = Cookie::get('token');
        $category = Http::withToken($value)->get(env('BACKEND_URL') . 'CategoryStorehouses/categorystorehouse')->json();

        $material = Http::withToken($value)->get(env('BACKEND_URL') . 'Storehouse/all_material')->json();
        //return $material;
        return view('Storehouse.StoreHouse', ['category' => $category, 'material' => $material]);
    }
    public function get_one_category_item(Request $request)
    {
        $value = Cookie::get('token');
        $category = Http::withToken($value)->get(env('BACKEND_URL') . 'CategoryStorehouses/categorystorehouse')->json();
        $material = Http::withToken($value)->get(env('BACKEND_URL') . 'Storehouse/category/' . $request->input('category'))->json();
        //return $material;
        return view('Storehouse.StoreHouse', ['category' => $category, 'material' => $material]);
    }
    public function delete_item($iditem)
    {
        $value = Cookie::get('token');
        $item_to_delete = Http::withToken($value)->delete(env('BACKEND_URL') . 'Storehouse/' . $iditem);


        if ($item_to_delete == 'Sukces') {
            session()->flash('message', 'Towar usunięty z bazy danych');
            return redirect('/storehouse');
        } else {
            session()->flash('message', 'Błąd usuwania towaru z bazy danych');
            return redirect('/storehouse');
        }
    }

    public function one_item_storehouse($id_item_spec)
    {
        $value = Cookie::get('token');
        $category = Http::withToken($value)->get(env('BACKEND_URL') . 'CategoryStorehouses/categorystorehouse')->json();
        $unit = Http::withToken($value)->get(env('BACKEND_URL') . 'Units/units')->json();
        $material = Http::withToken($value)->get(env('BACKEND_URL') . 'Storehouse/material/' . $id_item_spec)->json();
        //return $material[0]['idcategory'];
        if (empty($material)) {
            return redirect('storehouse');
        } else {
            return view('Storehouse.oneItem', ['category' => $category, 'material' => $material, 'units' => $unit]);
        }
    }
    public function put_item_storehouse(Request $request, $id_item_put)
    {
        $request->validate([
            'name_p' => 'required',
            'weight' => 'required',
            'categoryUnit' => 'required',
            'categoryStorehouse' => 'required',
        ]);

        $value = Cookie::get('token');
        $response = Http::withToken($value)->put(env('BACKEND_URL') . 'Storehouse/mod_storehouse/' . $id_item_put, [
            'name' => ucfirst($request->input('name_p')),
            'description' => ucfirst($request->input('description')),
            'weight' => intval($request->input('weight')),
            'expiry_date' => $request->input('expiry_date'),
            'type_spray' => ucfirst($request->input('type_spray')),
            'application' => ucfirst($request->input('application')),
            'CategoryStorehouseId' => intval($request->input('categoryStorehouse')),
            'UnitId' => intval($request->input('categoryUnit'))
        ])->json();
        if ($response == null) {
            session()->flash('message', 'Dane poprawnie zaktualizowane');
            return redirect('storehouse');
        } else {
            session()->flash('message', 'Błąd aktualizacji danych');
            return redirect('storehouse');
        }
        return redirect('/machines');
    }
}
