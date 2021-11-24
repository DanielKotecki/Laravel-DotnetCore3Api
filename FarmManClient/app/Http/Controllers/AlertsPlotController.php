<?php

namespace App\Http\Controllers;


use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AlertsPlotController extends Controller
{
    public function get_all_alert_plot()
    {
        $value = Cookie::get('token');
        $alerts_rent = Http::withToken($value)->get(env('BACKEND_URL') . 'RentSpec/alert_rent')->json();
        $alerts_works = Http::withToken($value)->get(env('BACKEND_URL') . 'Plot_works/alert_work')->json();
        return view('Plot.alertPlot', ['alerts' => $alerts_rent, 'alerts_work' => $alerts_works]);
    }
}
