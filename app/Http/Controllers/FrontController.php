<?php

namespace App\Http\Controllers;

use App\Customer;
use App\History;
use DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use View;
use App\User;
use App\Tag;
use App\Product;
use App\Picture;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function __construct()
    {
        View::composer('partials.nav', function ($view) // pour injecter des données dans un template (ici le template layouts.master ou partials.nav). C'est un construct, ce sera toujours fait quelquesoit la page. On récupérera ensuite les datas en layout.master pour les insérer dans notre menu.
        {
            $categories = Category::all();
            $view->with(compact('categories')); // with passe un tableau associatif dans view.

        });
    }

    public function index()
    {
//        return view('home');

        $products = product::with('tags', 'category', 'picture')->online()->orderBy('published_at')->paginate(10); // et non pas ::all // création de la pagination
        $title = "Welcome Home page";

        return view('front.index', compact('products', 'title')); // compact() évite de faire ['products'=>$products]
    }

    public function showProduct($id, $slug='')
    {
//        try
//        {
//            $product = product::with('tags', 'category', 'picture')->findOrFail($id);
//        }
//        catch(\Exception $e)
//        {
////            dd($e->getMessage()); // équivalent à var_dump customisé + die // dd est un petit helper de Laravel.
//            return view('front.no_product');
//        }
        // autre possibilité : $product = product::find($id) mais pas sécurisé;

        $product = product::findOrFail($id);
        return view('front.product', compact('product'));
    }


    public function showProductByCategory($id, $slug = '')
    {
//        $products = category::findOrFail($id)->products()->paginate(5);
        $products = Product::where('category_id', '=', $id)->orderBy('published_at')->paginate(10);
        return view('front.category', compact('products'));
    }

    public function showProductByTag($id)
    {
        $products = Tag::find($id)->products()->paginate(5);
        return view('front.tag', compact('products'));
    }


    public function showContact()
    {
        return view('front.contact');
    }


    public function storeContact(Request $request)
//    {
//        // $request->all(); les data du formulaire
//        $validator=Validator::make($request->all(),[
//            'email'=> 'required|email',
//            'content'=> 'required|max:200'
//        ]);
////        required -> mail obligatoire
////        email -> vérifie que c'est bien un format email
//        if($validator->fails())
//            return back()->withInput()->withErrors($validator); // fails() renvoie true s'il y a un problème dans validator.
//    }

        {
            // méthode courte de validation de formulaire
        $this->validate($request, [
            'email' =>  "required|email",
            'content'   => 'required|max:255'
        ]);
            // use ($request) pour récupérer le contexte englobant dans la fonction anonyme; qui normalement est un contexte fermé et ne récupère pas le contexte englobant.
            //Mail::send renvoie un objet $m qui est injecté dans la fonction et est utilisée dans la fonction de callback
            // from (mail du client,
            // EMAIL_TECH => cf. le fichier .env où on a défini l'email technique

            $content = $request->input('content');
            Mail::send('emails.contact', compact('content'), function($m)use($request){
                $m->from($request->input('email'), 'Client');
                $m->to(env('EMAIL_TECH'), 'admin')->subject('Contact e-boutique');
        });



            // on peut faire aussi un redirect('contact')
            // pour info, le with=> Laravel met tout dans l'objet Session Laravel
            // je redirige avec les messages :
        return back()->with([
            'message'=> 'Votre message a bien été envoyé !',
            'alert' =>  'success']); // css pour les différentes alertes de nos messages


//            méthode with sur la redirection est équivalent à en php natif :
//            session_start();
//            $_SESSION['laravel']['message'] = trans('app.contactSuccess');
//            $_SESSION['laravel']['alert'] = 'success'

        }

    public function userHistoric()
    {

        $user_id=Auth::user()->id;
        $customer_id=Customer::where('user_id', '=', $user_id)->value('id');
        $histories = History::where('customer_id', '=', $customer_id)->get();
        return view('front.user_historic', compact('histories'));
    }

    public function showMentions()
    {
        return view('front.mentions');
    }

};


         // find retourne le produit de l'$id (avec tous les champs disponibles).

