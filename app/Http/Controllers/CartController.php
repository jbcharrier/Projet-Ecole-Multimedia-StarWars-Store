<?php

namespace App\Http\Controllers;


use App\History;
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

/**
 * @property  Cart
 */
class CartController extends Controller
{
    public function __construct()
    {
        View::composer('partials.nav', function ($view) // pour injecter des données dans un template (ici le template layouts.master ou partials.nav). C'est un construct, ce sera toujours fait quelquesoit la page. On récupérera ensuite les datas en layout.master pour les insérer dans notre menu.
        {
            $categories = Category::all();
            $view->with(compact('categories')); // with passe un tableau associatif dans view.
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect('/')->with(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return back()->with(['message' => "success"]);
    }


    public function showCommand()
    {

        $token_session = session('_token');
        $user_id = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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
        $user_id = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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
            foreach ($carts as $cart){
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

            $total_price=0;
            $history_details = History_detail::where('history_id', '=', $history_id)->get();
            foreach($history_details as $history_detail)
            {
                $quantity = $history_detail->quantity;
                $price = $history_detail->product->price;
                $total_price += ($quantity)*($price);
            }

            DB::table('histories')
                ->where('id', '=', $history_id)
                ->update(['total_price'=> $total_price]);


            return redirect('/')->with(['message' => "success"]);
        }
    }


    public function storeCustomer(Request $request)
    {
        $address = $request->get('address');
        $cardnb = $request->get('cardnb');
        $user_id = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        Customer::create([
            'user_id' => $user_id,
            'address' => $address,
            'number_card' => $cardnb,
            'number_command' => '123456',
        ]);

        return redirect('command')->with(['message' => 'success']);
    }
}