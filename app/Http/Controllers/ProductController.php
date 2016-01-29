<?php

namespace App\Http\Controllers;




use App\Command_unf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use View;
use App\Tag;
use App\Product;
use App\Picture;
use App\History;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;




class ProductController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::all();
        return view('admin.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::lists('name', 'id');
        $categories = Category::all();

        return view('admin.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->file('thumbnail'));


            $validator = Validator::make($request->all(), array(
                'name' =>  "required",
                'price'   => "required|integer",
                'thumbnail' => 'image|max:3000'
            ));

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

//        $this->validate($request, [
//
//        ]);

        $product = Product::create($request->all());
        if(!empty($request->input('tags')))
            $product->tags()->attach($request->input('tags'));

        if(!is_null($request->file('thumbnail')))
        {
            $im = $request->file('thumbnail');
            // on récupère l'extension de l'image :
            $ext = $im->getClientOriginalExtension();

            // on crée l'uri:
            $uri = str_random(12).'.'.$ext;

            // on veut déplacer l'image dans le fichier public:
            //Exception renvoyée par le framework qui va arrêter le script (donc pas nécessaire de mettre une condition) :
            $im->move(env('UPLOAD_PATH'), $uri);
            {
                Picture::create([
                    'uri'   => $uri,
                    'type'  => $ext,
                    'size'  => $im->getClientSize(),
                    'product_id'    => $product->id,
                    'title' => $product->name,
                ]);
            }
        }

        return redirect('product')->with(['message' => 'success']);
    }


    public function changeStatus($id)
    {
        $product = Product::find($id);
        $product->status = ($product->status=="opened")? 'closed' : 'opened';
        $product->save();
        return back()->with(['message'=> trans('app.changeStatus')]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $tags = Tag::lists('name', 'id');
        $categories = Category::all();
        return view('admin.edit', compact('product', 'tags', 'categories'));
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

        $validator = Validator::make($request->all(), array(
            'name' =>  "required",
            'price'   => "required|numeric",
            'thumbnail' => 'image|max:3000'
        ));

        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $product = Product::find($id);
        if(!empty($request->input('tags')))
        {
            $product->tags()->sync($request->input('tags'));
        }
        else
        {
            $product->tags()->detach();
        }

        if($request->input('remove')=='true')
        {
            $product = Product::find($id);
            $picture = $product->picture;
            if (!is_null($picture)) {
                Storage::disk('local')->delete($picture->uri); //Storage Laravel voir config/filesystem.php mais par défaut ne fonctionne pas.
                $picture->delete();
            }
        }


        if(!is_null($request->file('thumbnail')))
        {

            $im = $request->file('thumbnail');

            $ext = $im->getClientOriginalExtension();

            $uri = str_random(12).'.'.$ext;
            $im->move(env('UPLOAD_PATH', './uploads'), $uri);
            {
                Picture::create([
                    'uri' => $uri,
                    'type' => $ext,
                    'size' => $im->getClientSize(),
                    'product_id' => $product->id,
                    'title' => $product->name,
                ]);
            }
        }

        $product->update($request->all());
        return redirect('product')->with(['message' => 'success']);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $picture = $product->picture;
        if(!is_null($picture))
        {
            Storage::disk('local')->delete($picture->uri); //Storage Laravel voir config/filesystem.php mais par défaut ne fonctionne pas.
            $picture->delete();
        }
        $product->delete();// on cascadde pour les tags N-N
        return back()->with(['message' => 'Product deleted']);
    }

    public function productHistoric()
    {
        $histories = History::all();
        return view('admin.historic', compact('histories'));
    }

    public function command_unfHistoric()
    {
        $command_unfs = Command_unf::all();
        return view('admin.command_unf', compact('command_unfs'));
    }
}
