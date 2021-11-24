<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AlertsHeaderController extends Controller
{
    public static function HeaderAlert()
    {
        $value = Cookie::get('token');


        //Alerty ubezpieczenia

        $after_insurence = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/afteralert_insurance')->json();
        $alert_insurenc = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/alert_insurance')->json();

        //Alerty przeglad techniczny

        $after_mot = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/afteralert_mot')->json();
        $alert_mot = Http::withToken($value)->get(env('BACKEND_URL') . 'Machines/alert_mot')->json();

        //Alerty prac 7 dni przed końcem

        $alert_works = Http::withToken($value)->get(env('BACKEND_URL') . 'Plot_works/alert_work')->json();

        //Alerty dzierżawy  90 dni przed końcem

        $alert_rent = Http::withToken($value)->get(env('BACKEND_URL') . 'RentSpec/alert_rent')->json();

        //zliczanie ilości alertów
        $alert_count = count($after_insurence) + count($alert_insurenc) + count($after_mot) + count($alert_mot) + count($alert_works) + count($alert_rent);
        $alert_insurence_count = count($after_insurence) + count($alert_insurenc);
        $alert_mot_count = count($after_mot) + count($alert_mot);
        $alert_work_count = count($alert_works);
        $alert_rent_count = count($alert_rent);
        return ['alert_count' => $alert_count, 'insurence_count' => $alert_insurence_count, 'mot_count' => $alert_mot_count, 'work_count' => $alert_work_count, 'rent_count' => $alert_rent_count];
    }
}
