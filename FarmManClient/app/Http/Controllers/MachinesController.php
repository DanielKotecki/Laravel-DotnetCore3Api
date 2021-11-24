<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class MachinesController extends Controller
{
    public function machineaddGet()
    {
        $value = Cookie::get('token');
        $category = Http::withToken($value)->get(env('BACKEND_URL') . 'CategoryMachines')->json();

        return view('MachinesPages.addMachine', ['category' => $category]);
    }
    public function addmachine(Request $request)
    {


        $request->validate([
            'model' => 'required',
            'marka' => 'required',
            'yearproduction' => 'required',
            'categorymachines' => 'required',
            'machine_id' => 'required'


        ]);
        $value = Cookie::get('token');
        $response = Http::withToken($value)->post(env('BACKEND_URL') . 'Machines/add_machine', [
            'machine_id' => strtoupper(substr($request->input('machine_id'), 0, 4)) . substr($request->input('machine_id'), 4),
            'mark' => ucfirst($request->input('marka')),
            'model' => ucfirst($request->input('model')),
            'year' => $request->input('yearproduction'),
            'power' => intval($request->input('power')),
            'power_need' => intval($request->input('powerneed')),
            'working_width' => intval($request->input('capacity')),
            'capacity' => floatval($request->input('workingwidth')),
            'insurance_date' => $request->input('insurance_date'),
            'mot_check' => $request->input('mot_check'),
            'attached' => ($request->input('attached') == null) ? false : true,
            'CategoryMachineId' => intval($request->input('categorymachines')),
        ]);
        return redirect('/machines');
        return $response;
    }
    public function machinesTable()
    {
        $value = Cookie::get('token');
        $category = Http::withToken($value)->get(env('BACKEND_URL') . 'CategoryMachines')->json();
        $response = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/all_machine')->json();

        return view('MachinesPages.viewMachines', ['machines' => $response, 'category' => $category]);
    }
    public function onemachine($id)
    {
        $value = Cookie::get('token');
        $category = Http::withToken($value)->get(env('BACKEND_URL') . 'CategoryMachines')->json();
        $machine = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/machine/' . $id)->json();
        if (empty($machine)) {
            return redirect('machines');
        } else {
            return view('MachinesPages.specMachine', ['category' => $category, 'maszyna' => $machine]);
        }
    }
    public function putMachine($idmachine, Request $request)
    {
        $request->validate([
            'model' => 'required',
            'marka' => 'required',
            'yearproduction' => 'required',
            'categorymachines' => 'required',
            'machine_id' => 'required'

        ]);
        $value = Cookie::get('token');
        $machine = Http::withToken($value)->put(env('BACKEND_URL') . 'Machines/mod/' . $idmachine, [
            'machine_id' => strtoupper(substr($request->input('machine_id'), 0, 4)) . substr($request->input('machine_id'), 4),
            'mark' => ucfirst($request->input('marka')),
            'model' => ucfirst($request->input('model')),
            'year' => $request->input('yearproduction'),
            'power' => intval($request->input('power')),
            'power_need' => intval($request->input('powerneed')),
            'working_width' => intval($request->input('capacity')),
            'capacity' => floatval($request->input('workingwidth')),
            'insurance_date' => $request->input('insurance_date'),
            'mot_check' => $request->input('mot_check'),
            'attached' => ($request->input('attached') == null) ? false : true,
            'CategoryMachineId' => intval($request->input('categorymachines')),
        ]);
        if ($machine == 'Sukces') {
            session()->flash('message', 'Dane poprawnie zaktualizowane');
            return redirect('machines');
        } else {
            session()->flash('message', 'Błąd aktualizacji danych');
            return redirect('machines');
        }
        return redirect('/machines');
    }
    public function oneCategory(Request $request)
    {
        $value = Cookie::get('token');
        $category = Http::withToken($value)->get(env('BACKEND_URL') . 'CategoryMachines')->json();
        $response = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/category/' . $request->input('category'))->json();
        return view('MachinesPages.viewMachines', ['machines' => $response, 'category' => $category]);
    }

    public function deleteMachine($idmachine)
    {
        $value = Cookie::get('token');
        $machine = Http::withToken($value)->delete(env('BACKEND_URL') . 'Machines/' . $idmachine)->json();

        if ($machine == null) {
            session()->flash('message', 'Maszyna usunięta z bazy danych');
            return redirect('machines');
        } else {
            session()->flash('message', 'Błąd usuwania maszyny z bazy danych');
            return redirect('machines');
        }
    }
}


//strtoupper(substr($request->input('animal_id'), 0, 2)) . substr($request->input('animal_id'), 2),