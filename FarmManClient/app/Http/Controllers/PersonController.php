<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PersonController extends Controller
{
    public function getPersonDate()
    {

        $value = Cookie::get('token');
        $response = Http::withToken($value)->get(env('BACKEND_URL') . 'User_spec')->json();
        // return $response;
        return view('Authpages.person', ['person' => $response]);
    }
    public function personput(Request $request)
    {
        $value = Cookie::get('token');
        $response = Http::withToken($value)->put(env('BACKEND_URL') . 'User_spec/mod_user', [
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'country' => $request->input('country'),
        ]);
        if ($response == 'Sukces') {
            session()->flash('message', 'Dane zaktualizowane');
            return redirect('/person');
        } else {
            session()->flash('message', 'Błąd aktualizacji danych');
            return redirect('/person');
        }

        return $response;
    }
}
