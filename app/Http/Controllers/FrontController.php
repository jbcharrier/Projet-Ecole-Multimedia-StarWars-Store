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
        View::composer('partials.nav', function ($view) {
            $categories = Category::all();
            $view->with(compact('categories'));
        });
    }

    public function index()
    {
        $products = product::with('tags', 'category', 'picture')->online()->orderBy('published_at', 'desc')->paginate(10);
        $title = "Welcome Home page";

        return view('front.index', compact('products', 'title'));
    }

    public function showProduct($id, $slug = '')
    {
        $product = product::findOrFail($id);

        return view('front.product', compact('product'));
    }


    public function showProductByCategory($id, $slug = '')
    {
        $products = Product::where('category_id', '=', $id)->orderBy('published_at', 'desc')->paginate(10);

        return view('front.category', compact('products'));
    }

    public function showProductByTag($id)
    {
        $products = Tag::find($id)->products()->orderBy('published_at', 'desc')->paginate(5);

        return view('front.tag', compact('products'));
    }

    public function showContact()
    {
        return view('front.contact');
    }


    public function storeContact(Request $request)
    {

        $this->validate($request, [
            'email' => "required|email",
            'content' => 'required|max:255'
        ]);

        $content = $request->input('content');
        Mail::send('emails.contact', compact('content'), function ($m) use ($request) {
            $m->from($request->input('email'), 'Client');
            $m->to(env('EMAIL_TECH'), 'admin')->subject('Contact e-boutique');
        });

        return back()->with([
            'sendemail' => 'Votre message a bien été envoyé !',
            'alert' => 'success']);
    }

    public function userHistoric()
    {
        $user_id = Auth::user()->id;
        $customer_id = Customer::where('user_id', '=', $user_id)->value('id');
        $histories = History::where('customer_id', '=', $customer_id)->get();

        return view('front.user_historic', compact('histories'));
    }

    public function showMentions()
    {
        return view('front.mentions');
    }
}