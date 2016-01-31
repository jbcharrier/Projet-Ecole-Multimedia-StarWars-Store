<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use View;
use Auth;
use App\User;
use App\Category;
use App\Product;
use App\Http\Requests;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        View::composer('partials.nav', function ($view) {
            $categories = Category::all();
            $view->with(compact('categories'));
        });
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'email' => "required|email",
                'password' => 'required',
            ]);

            $token = session('_token');
            $email = $request->input('email');

            if (Auth::attempt(['email' => $email, 'password' => $request->input('password')])) {
                User::where('email', '=', $email)
                    ->update(['remember_token' => $token]);

                return redirect()->intended('product');
            } else {
                return back()->withInput($request->only('email'))->with(['noauth' => 'Adresse e-mail et/ou mot de passe invalides.', 'alert' => 'error']);
            }
        } else {

            return view('auth.login');
        }
    }

    public function createUser()
    {
        return view('auth.login_registration');
    }

    public function storeUser(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $password = bcrypt($request->get('password'));
        $token = session('_token');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'remember_token' => $token,
        ]);

        return redirect('/login')->with(['storeuser' => 'Les informations ont été enregistrées ! Vous pouvez maintenant vous identifier.',
            'alert' => 'success']);
    }

    public function resetPassword()
    {

        return view('auth.passwords');
    }

    public function registerPassword(Request $request)
    {
        $password = $request->get('password');
        $npassword = $request->get('npassword');
        $email = $request->get('email');
        $user = User::where('email', '=', $email)->get();
        if (!$user->isEmpty()) {
            if ($password == $npassword) {
                User::where('email', '=', $email)->update(['password' => bcrypt($password)]);

                return redirect('/login')->with(['storepassword' => 'Votre nouveau mot de passe a bien été enregistré ! Vous pouvez maintenant vous identifier.',
                    'alert' => 'success']);
            } else {

                return back()->with(['errorstorepassword' => 'Il y a une erreur dans les informations que vous avez entrées.',
                    'alert' => 'error']);
            }
        } else {

            return back()->with(['emailfailstorepassword' => 'Adresse e-mail non-reconnue !',
                'alert' => 'error']);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->home();
    }
}