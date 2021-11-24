<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class PlotController extends Controller
{
    public function get_page_add()
    {

        $value = Cookie::get('token');
        $response = Http::withToken($value)->get(env('BACKEND_URL') . 'plot_types/')->json();

        return view('Plot.addplot', ['plot_type' => $response]);
    }
    public function post_add(Request $request)
    {
        $request->validate([
            'number_plot' => 'required',
            'city' => 'required',
            'area_hectare' => 'required',
            'plot_typeId' => 'required',
        ]);
        if ($request->input('rent') != null) {

            $value = Cookie::get('token');
            $response = Http::withToken($value)->post(env('BACKEND_URL') . 'Plots/add_plot', [
                'number_plot' => $request->input('number_plot'),
                'city' => $request->input('city'),
                'area_hectare' => floatval($request->input('area_hectare')),
                'plot_typeId' => intval($request->input('plot_typeId')),
                'rent' => false,
            ]);

            return redirect('addrentpage/' . $response['id']);
        } else {
            $value = Cookie::get('token');
            $response = Http::withToken($value)->post(env('BACKEND_URL') . 'Plots/add_plot', [
                'number_plot' => $request->input('number_plot'),
                'city' => $request->input('city'),
                'area_hectare' => floatval($request->input('area_hectare')),
                'plot_typeId' => intval($request->input('plot_typeId')),
                'rent' => false,
            ])->json();
            if (array_key_exists('status', $response) == false) {
                session()->flash('message', 'Działka dodana');
                return redirect('/plots');
            } else {
                session()->flash('message', 'Błąd dodania');
                return redirect('/plots');
            }
        }
    }
    public function add_rent_plot(Request $request)
    {

        $request->validate([
            'plot_id' => 'required',
            'start_rent' => 'required',
            'end_date' => 'required',
            'ground_rent_cost' => 'required',
        ]);
        $value = Cookie::get('token');
        $rent = Http::withToken($value)->put(env('BACKEND_URL') . 'Plots/rent/mod_plot/' . $request->input('plot_id'), [
            'rent' => true
        ]);
        $response = Http::withToken($value)->post(env('BACKEND_URL') . 'RentSpec/add_rent', [
            'PlotId' => intval($request->input('plot_id')),
            'start_rent' => $request->input('start_rent'),
            'end_date' => $request->input('end_date'),
            'ground_rent_cost' => floatval($request->input('ground_rent_cost'))
        ]);

        if ($response == 'Bład') {
            session()->flash('message', 'Błąd dodania dzierżawy podczas dodawania działki');
            return redirect('/plots');
        } else {
            session()->flash('message', 'Działka dodana wraz z dzierżawą');
            return redirect('/plots');
        }
    }
    public function get_all()
    {
        $value = Cookie::get('token');
        $plot_type = Http::withToken($value)->get(env('BACKEND_URL') . 'plot_types/')->json();
        $plots = Http::withToken($value)->get(env('BACKEND_URL') . 'Plots/all_plot/')->json();
        //return $plots;
        return view('Plot.plots', ['plot_type' => $plot_type, 'plots' => $plots]);
    }
    public function get_addrent($id)
    {
        return view('Plot.addrentSpec', ['plotId' => $id]);
    }
    public function one_category(Request $request)
    {

        $value = Cookie::get('token');
        $plot_type = Http::withToken($value)->get(env('BACKEND_URL') . 'plot_types/')->json();
        $plots = Http::withToken($value)->get(env('BACKEND_URL') . 'Plots/plot_by_type/' . $request->input('category'))->json();
        //return $plots;
        return view('Plot.plots', ['plot_type' => $plot_type, 'plots' => $plots]);
    }
    public function edit_plot($id_plot)
    {

        $value = Cookie::get('token');
        $plot_type = Http::withToken($value)->get(env('BACKEND_URL') . 'plot_types/')->json();
        $plot = Http::withToken($value)->get(env('BACKEND_URL') . 'Plots/one_plot/' . $id_plot)->json();
        //return $plot;
        if (empty($plot)) {
            return redirect('plots');
        } else {
            return view('Plot.plotedit', ['plot_type' => $plot_type, 'plot' => $plot]);
        }
    }
    public function one_put(Request $request)
    {

        $request->validate([
            'number_plot' => 'required',
            'city' => 'required',
            'area_hectare' => 'required',
            'plot_typeId' => 'required',
        ]);
        $value = Cookie::get('token');
        $response = Http::withToken($value)->put(env('BACKEND_URL') . 'Plots/mod_plot/' . $request->input('plot_id'), [
            'number_plot' => $request->input('number_plot'),
            'city' => $request->input('city'),
            'area_hectare' => floatval($request->input('area_hectare')),
            'plot_typeId' => intval($request->input('plot_typeId')),
            'rent' => ($request->input('rent') == null) ? false : true
        ]);
        if ($response == 'Sukces') {
            session()->flash('message', 'Działka poprawnie zaktualizowana');
            return redirect('/plots');
        } else {
            session()->flash('message', 'Błąd aktualizacji');
            return redirect('/plots');
        }
    }
    public function get_edit_addrent($idrent)
    {
        return view('Plot.addrent', ['plotId' => $idrent]);
    }
    public function add_rent_one(Request $request)
    {
        $request->validate([
            'plot_id' => 'required',
            'start_rent' => 'required',
            'end_date' => 'required',
            'ground_rent_cost' => 'required',
        ]);
        $value = Cookie::get('token');
        $rent = Http::withToken($value)->put(env('BACKEND_URL') . 'Plots/rent/mod_plot/' . $request->input('plot_id'), [
            'rent' => true
        ]);
        $response = Http::withToken($value)->post(env('BACKEND_URL') . 'RentSpec/add_rent', [
            'PlotId' => intval($request->input('plot_id')),
            'start_rent' => $request->input('start_rent'),
            'end_date' => $request->input('end_date'),
            'ground_rent_cost' => floatval($request->input('ground_rent_cost'))
        ]);
        if ($response != 'Bład') {
            session()->flash('message', 'Dzierżawa dodana');
            return redirect('/plots');
        } else {
            session()->flash('message', 'Błąd dodawania');
            return redirect('/plots');
        }
    }
    public function get_rent_edit($id_plot)
    {
        $value = Cookie::get('token');
        $rent = Http::withToken($value)->get(env('BACKEND_URL') . 'RentSpec/rent_one/' . $id_plot)->json();
        //return $rent;
        if (empty($rent)) {
            return redirect('/plots');
        } else {
            return view('Plot.rentedit', ['rent' => $rent]);
        }
    }
    public function one_put_rent(Request $request)
    {

        $request->validate([
            'start_rent' => 'required',
            'end_date' => 'required',
            'ground_rent_cost' => 'required',
        ]);
        $value = Cookie::get('token');
        $response = Http::withToken($value)->put(env('BACKEND_URL') . 'RentSpec/mod_rent/' . $request->input('rent_id'), [
            'start_rent' => $request->input('start_rent'),
            'end_date' => $request->input('end_date'),
            'ground_rent_cost' => floatval($request->input('ground_rent_cost'))
        ]);

        if ($response == 'Sukces') {
            session()->flash('message', 'Dzierżawa poprawnie zaktualizowana');
            return redirect('/plots');
        } else {
            session()->flash('message', 'Błąd aktualizacji');
            return redirect('/plots');
        }
    }
    public function delete_rent($idplot)
    {

        $value = Cookie::get('token');
        $rent = Http::withToken($value)->put(env('BACKEND_URL') . 'Plots/rent/mod_plot/' . $idplot, [
            'rent' => false
        ]);
        $delete = Http::withToken($value)->delete(env('BACKEND_URL') . 'RentSpec/deleterent/' . $idplot);

        if (($delete == 'Sukces') && ($rent == 'Sukces')) {
            session()->flash('message', 'Dzierżawa usunięta poprawnie');
            return redirect('/plots');
        } else {
            session()->flash('message', 'Błąd usuwania dzierżawy');
            return redirect('/plots');
        }
    }
    public function delete_plot_works($idplot)
    {
        $value = Cookie::get('token');
        $delete = Http::withToken($value)->delete(env('BACKEND_URL') . 'Plots/deleteplot/' . $idplot);
        if ($delete == 'Sukces') {
            session()->flash('message', 'Działka usunięta');
            return redirect('/plots');
        } else {
            session()->flash('message', 'Błąd usuwania');
            return redirect('/plots');
        }
        return $delete;
    }
}
