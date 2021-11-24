<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Authpages.login');
});
Route::get('/forget', function () {
    return view('Authpages.forgetpassword');
});
Route::get('/register', function () {
    return view('Authpages.register');
});
Route::get('/reset/{mail}/{token}', function ($mail, $token) {
    return view('Authpages.resetpassword', ['mail' => $mail, 'token' => $token]);
});

Route::get('/deleteAccount', function () {
    return view('Authpages.deleteUser');
});
Route::post('deleteUser', 'AuthController@Delete_User');
Route::get('/emailconfirm', function () {
    return view('Authpages.confirm_email');
});
Route::get('/o-nas', function () {
    return view('Authpages.onas');
});

Route::get('/contact', function () {
    return view('Authpages.Kontakt');
});


Route::post('register', 'AuthController@Register');
Route::post('login', 'AuthController@Login');
Route::post('forget', 'AuthController@forget');
Route::post('/reset/{mail}/{token}', 'AuthController@reset');

Route::get('/conditions', function () {
    return view('Authpages.application_conditions');
});


Route::get('main', 'MainController@count')->middleware('authcookie');


//wylogowanie
Route::get('logout', 'AuthController@logout')->middleware('authcookie');

Route::get('addmachine', 'MachinesController@machineaddGet')->middleware('authcookie');
Route::post('addmachine', 'MachinesController@addmachine')->middleware('authcookie');;
Route::post('edit/putmachine/{idmachine}', 'MachinesController@putMachine')->middleware('authcookie');
Route::post('categorypokaz', 'MachinesController@oneCategory')->middleware('authcookie');
Route::get('machines', 'MachinesController@machinesTable')->middleware('authcookie');
Route::get('edit/{id}', 'MachinesController@onemachine')->middleware('authcookie');
Route::get('deletemachine/{idmachine}', 'MachinesController@deleteMachine')->middleware('authcookie');
Route::get('/person', 'PersonController@getPersonDate')->middleware('authcookie');
Route::post('personput', 'PersonController@personput')->middleware('authcookie');

Route::get('alert/insurences', "AlertsInsuranceController@get_insurence_alert")->middleware('authcookie');
Route::get('alert/mot', "AlertsMotController@get_mot_alert")->middleware('authcookie');

Route::get('itemadd', 'StorehouseController@get_add_item')->middleware('authcookie');

Route::post('additem', 'StorehouseController@post_add_item')->middleware('authcookie');

Route::get('/storehouse', 'StorehouseController@get_storehouse')->middleware('authcookie');

Route::post('categorymaterial', 'StorehouseController@get_one_category_item')->middleware('authcookie');

Route::get('deletestorehouse/{iditem}', 'StorehouseController@delete_item')->middleware('authcookie');

Route::get('edit/storehouse/{id_item_spec}', 'StorehouseController@one_item_storehouse')->middleware('authcookie');
Route::post('edit/storehouse/putitem/{id_item_put}', 'StorehouseController@put_item_storehouse')->middleware('authcookie');
Route::get('animal', function () {
    return view('Animal.addanimal');
})->middleware('authcookie');
Route::post('addanimal', 'AnimalController@post_animal_add')->middleware('authcookie');

Route::get('test', function () {
    return view('Animal.Animals');
})->middleware('authcookie');
Route::get('animals', 'AnimalController@get_all_animals')->middleware('authcookie');

Route::post('putanimal', 'AnimalController@put_animal')->middleware('authcookie');

Route::get('/specanimal/{idanimal}', 'AnimalController@get_one_animal')->middleware('authcookie');


Route::get('deleteanimal/{delte_animal}', 'AnimalController@delete_one_animal')->middleware('authcookie');

Route::get('test', function () {
    return view('Plot.addrentSpec');
})->middleware('authcookie');

Route::get('/plotadd', 'PlotController@get_page_add')->middleware('authcookie');

Route::get('addrentpage/{id}', 'PlotController@get_addrent')->middleware('authcookie');

Route::post('addplot', 'PlotController@post_add')->middleware('authcookie');

Route::post('addrent', 'PlotController@add_rent_plot')->middleware('authcookie');

Route::get('/plots', 'PlotController@get_all')->middleware('authcookie');



Route::post('categoryplot', 'PlotController@one_category')->middleware('authcookie');

Route::get('edit/plotone/{id_plot}', 'PlotController@edit_plot')->middleware('authcookie');

Route::post('/edit/plotone/putplot', 'PlotController@one_put')->middleware('authcookie'); //edycja działki
Route::get('edit/addrentpage/{idrent}', 'PlotController@get_edit_addrent')->middleware('authcookie');
Route::post('one_addrent', 'PlotController@add_rent_one')->middleware('authcookie');

Route::get('/edit/rentone/{id_plot}', 'PlotController@get_rent_edit')->middleware('authcookie');

Route::post('/edit/rentone/editrent', 'PlotController@one_put_rent')->middleware('authcookie'); //edycja dzierżawy
Route::get('delete/rentone/{idplot}', 'PlotController@delete_rent')->middleware('authcookie');

Route::get("plots/addwork/{idplot}", "PlotWorkController@get_page_addwork")->middleware('authcookie');

Route::post('addwork', "PlotWorkController@add_work")->middleware('authcookie');

Route::get("plots/works/{idplot}", "PlotWorkController@get_all_work")->middleware('authcookie');

//usuwanie pracy
Route::get('/plots/works/deleteworks/{iddelete}', 'PlotWorkController@delete_work')->middleware('authcookie');

Route::get('plots/works/edit/{idwork}/{idplot}', 'PlotWorkController@get_one_work')->middleware('authcookie');

Route::post('putwork', 'PlotWorkController@put_work')->middleware('authcookie');

Route::get('deleteplot/{idplot}', 'PlotController@delete_plot_works')->middleware('authcookie');


Route::get('alert/plot', 'AlertsPlotController@get_all_alert_plot')->middleware('authcookie');
