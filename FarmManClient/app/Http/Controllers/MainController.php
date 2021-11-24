<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{
    public function count()
    {
        $value = Cookie::get('token');
        $animals = Http::withToken($value)->get(env('BACKEND_URL') . 'Animals/count_animal/')->json();

        $plots = Http::withToken($value)->get(env('BACKEND_URL') . 'Plots/count_plot/')->json();
        $storehouse = Http::withToken($value)->get(env('BACKEND_URL') . 'Storehouse/count_material/')->json();
        $machines = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/count_machine/')->json();
        $group_machines = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/group_count/')->json();
        $group_plots = Http::withToken($value)->get(env('BACKEND_URL') . 'Plots/group_count/')->json();
        $group_storehouse = Http::withToken($value)->get(env('BACKEND_URL') . 'Storehouse/group_count/')->json();

        return view('main', ['animals' => $animals, 'plots' => $plots, 'storehouse' => $storehouse, 'machines' => $machines, 'group_machines' => $group_machines, 'group_plots' => $group_plots, 'group_storehouse' => $group_storehouse]);
    }
}
