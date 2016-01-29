<?php

namespace App\Http\Controllers;

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
        View::composer('partials.nav', function ($view) // pour injecter des données dans un template (ici le template layouts.master ou partials.nav). C'est un construct, ce sera toujours fait quelquesoit la page. On récupérera ensuite les datas en layout.master pour les insérer dans notre menu.
        {
            $categories = Category::all();
            $view->with(compact('categories')); // with passe un tableau associatif dans view.
        });
    }



    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'email' => "required|email",
                'password' => 'required',
                'remember' => 'in:true'
            ]);

            $remember = !empty($request->input('remember'))? true : false;
            $token = session('_token');
            $email = $request->input('email');

            if(Auth::attempt(['email'=> $email, 'password'=>$request->input('password')], $remember)) {
                User::where('email', '=', $email)
                    ->update(['remember_token' => $token]);
                return redirect()->intended('product');
            } else {
                return back()->withInput($request->only('email', 'remember'))->with(['message' => trans('app.noAuth'), 'alert' => 'warning']);
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

        return redirect('/login')->with(['message' => 'Les informations ont été enregistrées',
                                        'alert' => 'success']);
    }


public function logout()
    {
        Auth::logout();
        return redirect()->home();
//        C'est un alias de route (on aurait pu faire redirect('\')
    }
}
