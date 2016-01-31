<?php

namespace App\Http\Controllers;


use App\History;
use Illuminate\Support\Facades\Auth;
use View;
use App\Cart;
use App\Product;
use App\Customer;
use App\Category;
use App\Command_unf;
use App\History_detail;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class CartController extends Controller
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
        $token_session = session('_token');
        $carts = Cart::where('token', '=', $token_session)->get();
        $prices = array();
        $quantities = array();
        foreach ($carts as $cart) {
            $prices[] = $cart->price;
            $quantities[] = $cart->quantity;
        }
        $total = 0;
        for ($i = 0; $i < count($prices); $i++) {
            $total += $prices[$i] * $quantities[$i];
        }

        return view('front.cart', compact('carts', 'total'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $token = $request->get('_token');
        $quant = $request->get('quantity');
        $product_id = $request->get('product_id');
        $price = Product::find($product_id)->price;

        $cart = Cart::create([
            'product_id' => $product_id,
            'token' => $token,
            'price' => $price,
            'quantity' => $quant
        ]);

        $cart_id = $cart->id;
        Command_unf::create([
            'product_id' => $product_id,
            'cart_id' => $cart_id,
            'token' => $token,
            'price' => $price,
            'quantity' => $quant,
        ]);

        return redirect('/')->with(['cart-store' => 'Le produit a été ajouté à votre panier !',
            'alert' => 'success']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return back()->with(['cart-delete' => 'Le produit a été retiré de votre panier',
            'alert' => 'success']);
    }

    public function showCommand()
    {
        $token_session = session('_token');
        $user_id = Auth::user()->id;
        DB::table('carts')
            ->where('token', '=', $token_session)
            ->update(['user_id' => "$user_id"]);

        DB::table('command_unfs')
            ->where('token', '=', $token_session)
            ->update(['user_id' => "$user_id"]);

        $carts = Cart::where('token', '=', $token_session)->get();
        $prices = array();
        $quantities = array();
        foreach ($carts as $cart) {
            $prices[] = $cart->price;
            $quantities[] = $cart->quantity;
            $cart->user_id = $user_id;
        }
        $total = 0;
        for ($i = 0; $i < count($prices); $i++) {
            $total += $prices[$i] * $quantities[$i];
        }

        return view('front.command', compact('carts', 'total'));
    }

    public function validCommand()
    {
        $user_id = Auth::user()->id;
        $customer_id = Customer::where('user_id', '=', $user_id)->value('id');
        $token = session('_token');

        if (empty($customer_id)) {
            return view('front.form_customer');
        } else {
            $history = History::create([
                'customer_id' => $customer_id,
                'token' => $token
            ]);

            $history_id = $history->id;
            $carts = Cart::where('user_id', '=', $user_id)->get();
            foreach ($carts as $cart) {
                History_detail::create([
                    'history_id' => $history_id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity
                ]);

                $number_products_commanded = DB::table('customers')
                    ->where('id', '=', $customer_id)
                    ->value('number_products_commanded');

                $number_products_commanded += $cart->quantity;

                Customer::where('id', '=', $customer_id)
                    ->update(['number_products_commanded' => $number_products_commanded]);

                $cart->command_unf->delete();
                $cart->delete();
            }

            $total_price = 0;
            $history_details = History_detail::where('history_id', '=', $history_id)->get();
            foreach ($history_details as $history_detail) {
                $quantity = $history_detail->quantity;
                $price = $history_detail->product->price;
                $total_price += ($quantity) * ($price);
            }

            DB::table('histories')
                ->where('id', '=', $history_id)
                ->update(['total_price' => $total_price]);

            return redirect('/')->with(['validcommand' => "Votre commande a bien été enregistrée ! Nous vous en remercions.",
                'alert' => 'success']);
        }
    }

    public function storeCustomer(Request $request)
    {
        $address = $request->get('address');
        $cardnb = $request->get('cardnb');
        $user_id = Auth::user()->id;

        Customer::create([
            'user_id' => $user_id,
            'address' => $address,
            'number_card' => $cardnb,
            'number_command' => '123456',
        ]);

        return redirect('command')->with(['createcustomer' => 'Les informations ont bien été enregistrées ! Vous pouvez maintenant valider votre commande.',
            'alert' => 'success']);
    }
}