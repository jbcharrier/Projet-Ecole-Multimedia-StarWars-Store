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

    public function index()
    {
        $products = product::all();

        return view('admin.index', compact('products'));
    }

    public function create()
    {
        $tags = Tag::lists('name', 'id');
        $categories = Category::all();

        return view('admin.create', compact('tags', 'categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'name' => "required",
            'price' => "required|integer",
            'thumbnail' => 'image|max:3000'
        ));

        if ($validator->fails()) {

            return back()->withInput()->withErrors($validator);
        }

        $product = Product::create($request->all());
        if (!empty($request->input('tags')))
            $product->tags()->attach($request->input('tags'));

        if (!is_null($request->file('thumbnail'))) {
            $im = $request->file('thumbnail');
            $ext = $im->getClientOriginalExtension();
            $uri = str_random(12) . '.' . $ext;
            $im->move(env('UPLOAD_PATH'), $uri);
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

        return redirect('product')->with(['storeproduct' => 'Le produit a bien été ajouté.',
            'alert' => 'success']);
    }

    public function changeStatus($id)
    {
        $product = Product::find($id);
        $product->status = ($product->status == "opened") ? 'closed' : 'opened';
        $product->save();

        return back();
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $product = Product::find($id);
        $tags = Tag::lists('name', 'id');
        $categories = Category::all();

        return view('admin.edit', compact('product', 'tags', 'categories'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), array(
            'name' => "required",
            'price' => "required|numeric",
            'thumbnail' => 'image|max:3000'
        ));

        if ($validator->fails()) {

            return back()->withInput()->withErrors($validator);
        }

        $product = Product::find($id);
        if (!empty($request->input('tags'))) {
            $product->tags()->sync($request->input('tags'));
        } else {
            $product->tags()->detach();
        }
        if ($request->input('remove') == 'true') {
            $product = Product::find($id);
            $picture = $product->picture;
            if (!is_null($picture)) {
                Storage::disk('local')->delete($picture->uri);
                $picture->delete();
            }
        }
        if (!is_null($request->file('thumbnail'))) {
            $im = $request->file('thumbnail');
            $ext = $im->getClientOriginalExtension();
            $uri = str_random(12) . '.' . $ext;
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

        return redirect('product')->with(['updateproduct' => 'Les modifications sur le produit ont bien été enregistrées.',
            'alert' => 'success']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $picture = $product->picture;
        if (!is_null($picture)) {
            Storage::disk('local')->delete($picture->uri);
            $picture->delete();
        }
        $product->delete();

        return back()->with(['productdestroy' => 'Le produit a été supprimé.',
            'alert' => 'success']);
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