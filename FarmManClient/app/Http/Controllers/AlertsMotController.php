<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AlertsMotController extends Controller
{
    public function get_mot_alert()
    {
        $value = Cookie::get('token');
        $after_mot = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/afteralert_mot')->json();
        $alert_mot = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/alert_mot')->json();
        return view('MachinesPages.Alert_motcheck', ['after' => $after_mot, 'before' => $alert_mot]);
    }
}
