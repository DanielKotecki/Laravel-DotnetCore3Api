<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{
    public function Register(Request $request)
    {
        $request->validate([
            'Email' => 'required|email',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password|regex:/[0-9]/|regex:/[A-Z]/',
            'confirm_password' => 'min:6|regex:/[0-9]/|regex:/[A-Z]/',
            'terms' => 'required'
        ]);

        $response = Http::post(env('BACKEND_URL') . 'auth/register', [
            'Email' => $request->input('Email'),
            'Password' => $request->input('password'),
            'ConfirmPassword' => $request->input('confirm_password')
        ]);
        // return $response['succes'];
        if ($response['succes'] == false) {
            # code...
            session()->flash('message', $response['message']);
            return redirect('register');
        } else {
            return redirect('/');
        }
    }
    public function Login(Request $request)
    {
        $request->validate([
            'Email' => 'required|email',
            'password' => 'required|min:6|regex:/[0-9]/|regex:/[A-Z]/'
        ]);
        $response = Http::post(env('BACKEND_URL') . 'auth/login', [
            'Email' => $request->input('Email'),
            'Password' => $request->input('password')
        ]);

        if ($response['succes'] == false) {
            session()->flash('message', $response['message']);
            return redirect('/');
        } else {
            Cookie::queue('token', $response['message'], 60);
            Cookie::queue('email', $request->input('Email'), 60);
            return redirect('/main');
        }
    }
    public function forget(Request $request)
    {
        $request->validate([
            'Email' => 'required|email'
        ]);
        $response = Http::post(env('BACKEND_URL') . 'auth/ForgetPassword', [
            'Email' => $request->input('Email')
        ]);

        if ($response['succes'] == false) {
            session()->flash('message', $response['message']);
            return redirect('/forget');
        } else {
            session()->flash('message', $response['message']);
            return redirect('/');
        }
    }
    public function reset(Request $request, $mail, $token)
    {

        $request->validate([
            'password' => 'min:6|required_with:confirm_password|same:confirm_password|regex:/[0-9]/|regex:/[A-Z]/',
            'confirm_password' => 'min:6|regex:/[0-9]/|regex:/[A-Z]/'
        ]);
        $response = Http::post(env('BACKEND_URL') . 'auth/reset', [
            'Email' => $mail,
            'NewPassword' => $request->input('password'),
            'ConfirmNewPassword' => $request->input('confirm_password'),
            'Token' => $token
        ]);
        if ($response['succes'] != false) {
            session()->flash('message', $response['message']);
            return redirect('/');
        } else {
            return "Błąd zmiany" . "->" . $response['message'];
        }
    }
    public function logout()
    {
        Cookie::queue(
            Cookie::forget('token')
        );
        Cookie::queue(
            Cookie::forget('email')

        );
        return redirect('/');
    }
    public function Delete_User(Request $request)
    {
        $request->validate([
            'password' => 'min:6|required_with:confirm_password|same:confirm_password|regex:/[0-9]/|regex:/[A-Z]/',
            'confirm_password' => 'min:6|regex:/[0-9]/|regex:/[A-Z]/'
        ]);
        $value = Cookie::get('token');
        $deleteUser = Http::withToken($value)->post(env('BACKEND_URL') . 'DeleteUser/', [
            'Password' => $request->input('password'),
            'Confirmpassword' => $request->input('password'),
        ])->json();
        if ($deleteUser["succes"] == null) {
            session()->flash('message', $deleteUser['message']);
            return redirect('deleteAccount');
        } else {
            session()->flash('message', $deleteUser['message']);
            Cookie::queue(Cookie::forget('token'),);
            Cookie::queue(Cookie::forget('email'),);
            return redirect('/');
        }
    }
}
