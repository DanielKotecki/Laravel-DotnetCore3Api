<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class AlertsInsuranceController extends Controller
{
    public function get_insurence_alert()
    {
        $value = Cookie::get('token');
        $after_insurence = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/afteralert_insurance')->json();
        $alert_insurenc = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/alert_insurance')->json();

        return view('MachinesPages.Alert_insurence', ['after' => $after_insurence, 'before' => $alert_insurenc]);
    }
    public function get_mot_alert()
    {
        $value = Cookie::get('token');
        $after_mot = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/afteralert_mot')->json();
        $alert_mot = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/alert_mot')->json();
        return view('MachinesPages.Alert_motcheck', ['after' => $after_mot, 'before' => $alert_mot]);
    }
}
