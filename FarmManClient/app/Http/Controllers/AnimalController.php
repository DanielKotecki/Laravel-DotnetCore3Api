<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AnimalController extends Controller
{
    public function post_animal_add(Request $request)
    {


        $request->validate([
            'animal_id' => 'required',
            'farm_id' => 'required',
            'place_id' => 'required',
            'check_number' => 'required_without_all:old_place_id,old_farm_id,old_name,old_surname',
            'old_farm_id' => 'required_without:check_number',
            'old_place_id' => 'required_without:check_number',
            'old_name' => 'required_without:check_number',
            'old_surname' => 'required_without:check_number',
            'sex' => 'required',
            'breed' => 'required',
            'number_mother' => 'required',
            'number_father' => 'required',
            'date_marking' => 'required',
            'date_birth' => 'required',
        ]);

        //return $request->input('date_birth');
        $value = Cookie::get('token');
        $response = Http::withToken($value)->post(env('BACKEND_URL') . 'Animals/Add_Animal/', [
            'animal_id' => strtoupper(substr($request->input('animal_id'), 0, 2)) . substr($request->input('animal_id'), 2),
            'farm_id' => strtoupper(substr($request->input('farm_id'), 0, 2)) . substr($request->input('farm_id'), 2),
            'place_id' => strtoupper(substr($request->input('place_id'), 0, 2)) . substr($request->input('place_id'), 2),
            'old_farm_id' => ($request->input('check_number') == null) ? strtoupper(substr($request->input('old_farm_id'), 0, 2)) . substr($request->input('old_farm_id'), 2) : null,
            'old_place_id' => ($request->input('check_number') == null) ? strtoupper(substr($request->input('old_place_id'), 0, 2)) . substr($request->input('old_place_id'), 2) : null,
            'old_name' => ($request->input('check_number') == null) ? ucfirst($request->input('old_name')) : null,
            'old_surname' => ($request->input('check_number') == null) ? ucfirst($request->input('old_surname')) : null,
            'sex' => ucfirst($request->input('sex')),
            'breed' => ucfirst($request->input('breed')),
            'date_birth' => $request->input('date_birth'),
            'description' => ucfirst($request->input('description')),
            'number_mother' => $request->input('number_mother'),
            'number_father' => $request->input('number_father'),
            'natural_death' => $request->input('natural_death'),
            'slaughter_date' => $request->input('slaughter_date'),
            'date_marking' => $request->input('date_marking')

        ])->json();

        if (array_key_exists('status', $response)) {
            session()->flash('message', 'Błąd dodawania');
            return redirect('/animals');
        } else {
            session()->flash('message', 'Zwierzę dodane do bazy');
            return redirect('/animals');
        }
    }
    public function get_all_animals()
    {
        $value = Cookie::get('token');
        $response = Http::withToken($value)->get(env('BACKEND_URL') . 'Animals/all_animals/')->json();
        // echo ("<pre>");
        // var_dump($response);
        // echo ("</pre>");
        //return $response;
        return view('Animal.Animals', ['animal' => $response]);
    }
    public function get_one_animal($idanimal)
    {
        $value = Cookie::get('token');
        $response = Http::withToken($value)->get(env('BACKEND_URL') . 'Animals/oneAnimal/' . $idanimal)->json();
        if (empty($response)) {
            return redirect('animals');
        } else {
            return view('Animal.Oneanimal', ['animal' => $response]);
        }
    }
    public function delete_one_animal($delte_animal)
    {
        $value = Cookie::get('token');
        $response = Http::withToken($value)->delete(env('BACKEND_URL') . 'Animals/' . $delte_animal)->json();
        //return $response;
        if ($response == null) {
            session()->flash('message', 'Zwierzę usunięte z bazy danych');
            return redirect('/animals');
        } else {
            session()->flash('message', 'Błąd usuwania zwierzaka z bazy danych');
            return redirect('/animals');
        }
    }
    public function put_animal(Request $request)
    {

        $request->validate([
            'animal_id' => 'required',
            'farm_id' => 'required',
            'place_id' => 'required',
            'check_number' => 'required_without_all:old_place_id,old_farm_id,old_name,old_surname',
            'old_farm_id' => 'required_without:check_number',
            'old_place_id' => 'required_without:check_number',
            'old_name' => 'required_without:check_number',
            'old_surname' => 'required_without:check_number',
            'sex' => 'required',
            'breed' => 'required',
            'number_mother' => 'required',
            'number_father' => 'required',
            'date_marking' => 'required',
            'date_birth' => 'required',
        ]);
        $value = Cookie::get('token');
        $response = Http::withToken($value)->put(env('BACKEND_URL') . 'Animals/' . $request->input('id_animal'), [
            'animal_id' => strtoupper(substr($request->input('animal_id'), 0, 2)) . substr($request->input('animal_id'), 2),
            'farm_id' => strtoupper(substr($request->input('farm_id'), 0, 2)) . substr($request->input('farm_id'), 2),
            'place_id' => strtoupper(substr($request->input('place_id'), 0, 2)) . substr($request->input('place_id'), 2),
            'old_farm_id' => ($request->input('check_number') == null) ? strtoupper(substr($request->input('old_farm_id'), 0, 2)) . substr($request->input('old_farm_id'), 2) : null,
            'old_place_id' => ($request->input('check_number') == null) ? strtoupper(substr($request->input('old_place_id'), 0, 2)) . substr($request->input('old_place_id'), 2) : null,
            'old_name' => ($request->input('check_number') == null) ? ucfirst($request->input('old_name')) : null,
            'old_surname' => ($request->input('check_number') == null) ? ucfirst($request->input('old_surname')) : null,
            'sex' => ucfirst($request->input('sex')),
            'breed' => ucfirst($request->input('breed')),
            'date_birth' => $request->input('date_birth'),
            'description' => ucfirst($request->input('description')),
            'number_mother' => $request->input('number_mother'),
            'number_father' => $request->input('number_father'),
            'natural_death' => $request->input('natural_death'),
            'slaughter_date' => $request->input('slaughter_date'),
            'date_marking' => $request->input('date_marking')

        ]);
        if ($response == 'Sukces') {
            session()->flash('message', 'Dane poprawnie zaktualizowane');
            return redirect('/animals');
        } else {
            session()->flash('message', 'Błąd aktualizacji danych');
            return redirect('/animals');
        }
    }
}
