<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PlotWorkController extends Controller
{
    public function get_page_addwork($idplot)
    {
        return view('Plot.PlotWorks.addwork', ['plotId' => $idplot]);
    }
    public function add_work(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'start_working' => 'required',
            'end_working' => 'required',
            'status' => 'required'
        ]);
        $value = Cookie::get('token');
        $response = Http::withToken($value)->post(env('BACKEND_URL') . 'Plot_works/add_work/' . $request->input('plotId'), [
            'plotId' => intval($request->input('plotId')),
            'work_description' => ucfirst($request->input('description')),
            'start_working' => $request->input('start_working'),
            'end_working' => $request->input('end_working'),
            'status' => ucfirst($request->input('status'))
        ]);
        if ($response == 'Sukces') { //$response
            session()->flash('message', 'Praca dodana');
            return redirect("plots/works/" . $request->input('plotId'));
        } else {
            session()->flash('message', 'Błąd dodania');
            return redirect("plots/works/" . $request->input('plotId'));
        }
    }
    public function get_all_work($idplot)
    {
        $value = Cookie::get('token');
        $response = Http::withToken($value)->get(env('BACKEND_URL') . 'Plot_works/workonplot/' . $idplot)->json();
        //return $response;
        return view('Plot.PlotWorks.works', ['works' => $response]);
    }
    public function delete_work($iddelete)
    {
        $value = Cookie::get('token');
        $response = Http::withToken($value)->delete(env('BACKEND_URL') . 'Plot_works/deletework/' . $iddelete);

        if ($response['plotId'] != null) { //$response
            session()->flash('message', 'Praca usunięta');
            return redirect('plots/works/' . $response['plotId']);
        } else {
            session()->flash('message', 'Błąd dodania');
            return redirect('/plots');
        }
    }
    public function get_one_work($idwork, $idplot)
    {
        $value = Cookie::get('token');
        $work = Http::withToken($value)->get(env('BACKEND_URL') . 'Plot_works/work/' . $idwork . '/' . $idplot)->json();

        if (empty($work)) {

            return redirect('plots');
        } else {
            return view('Plot.PlotWorks.onework', ['work' => $work]);
        }
    }

    public function put_work(Request $request)
    {

        $request->validate([
            'description' => 'required',
            'start_working' => 'required',
            'end_working' => 'required',
            'status' => 'required'
        ]);
        $value = Cookie::get('token');
        $work_update = Http::withToken($value)->put(env('BACKEND_URL') . 'Plot_works/mod_plotwork/' . $request->input('idwork'), [
            'work_description' => ucfirst($request->input('description')),
            'start_working' => $request->input('start_working'),
            'end_working' => $request->input('end_working'),
            'status' => ucfirst($request->input('status'))
        ]);
        if ($work_update == 'Sukces') {
            session()->flash('message', 'Dane poprawnie zaktualizowane');
            return redirect('/plots/works/' . $request->input('plot_id'));
        } else {
            session()->flash('message', 'Błąd aktualizacji danych');
            return redirect('/plots/works/' . $request->input('plot_id'));
        }
    }
}
