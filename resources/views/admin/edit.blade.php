@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{url('product', $product->id)}}" enctype="multipart/form-data">
        {!!csrf_field()!!}
        {{method_field('PUT')}}
        {{--pour la méthode UPDATE.--}}
        {{--c'est un token de la session qu'on passe via le head (évite qu'on nous attaque via un formulaire) // durée de 5 min--}}
        <div class="grid-2">
            <div>
                <div class="form-text">
                    <label class="label" for="name">{{trans('app.name')}}</label>
                    <input class="input-text" id="name" name="name" type="text" value="{{$product->name}}">
                    @if($errors->has("name")) <span class="error">{{$errors->first("name")}}</span> @endif
                </div>

                <div class="form-text">
                    <label class="label" for="slug">{{trans('app.slugName')}}</label>
                    <input class="input-text" id="slug" name="slug" type="text" value="{{$product->slug}}">
                    @if($errors->has("slug")) <span class="error">{{$errors->first("slug")}}</span> @endif
                </div>

                <div class="form-text">
                    <label class="label" for="price">{{trans('app.price')}}</label>
                    <input class="input-text" id="price" name="price" type="text" value="{{$product->price}}">
                    @if($errors->has("price")) <span class="error">{{$errors->first('price')}}</span> @endif
                </div>

                <div class="form-text">
                    <label class="label" for="quantity">{{trans('app.quantity')}}</label>
                    <input class="input-text" id="quantity" name="quantity" type="text" value="{{$product->quantity}}">
                    @if($errors->has("quantity")) <span class="error">{{$errors->first("quantity")}}</span> @endif
                </div>

                <div class="content">
                    <label class="label" for="abstract">{{trans('app.abstract')}}</label>
                    <textarea row="50" cols="50" name="abstract">{{$product->abstract}}</textarea>
                    @if($errors->has("abstract")) <span class="error">{{$errors->first("abstract")}}</span> @endif
                </div>

                <div class="content">
                    <label class="label" for="content">{{trans('app.content')}}</label>
                    <textarea row="50" cols="50" name="content">{{$product->content}}</textarea>
                    @if($errors->has("content")) <span class="error">{{$errors->first("content")}}</span> @endif
                </div>
            </div>


            <div>
                <select name="category_id" multiple>
                    <optgroup label="Sélectionnez la catégorie">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{($product->category_id==$category->id)? 'selected' : ''}}>{{$category->title}}</option>
                        @endforeach
                    </optgroup>
                </select>

                <label class="label" for="tags">{{trans('app.tag')}}</label>
                <select name="tags[]" multiple size="5">
                    <optgroup label="Sélectionnez vos tags">
                        @foreach ($tags as $id=>$name)
                            <option value="{{$id}}" {{$product->hasTag($id)? 'selected' : ''}}>{{$name}}</option>
                        @endforeach
                    </optgroup>
                </select>

                <div>
                    <label for="published_at">Date de publication (maintenant)</label>
                    <input type="radio" id="published_at" value="true" name="published_at"
                            {{($product->published_at!='0000-00-00 00:00:00')? 'checked' : ''}}>
                </div>

                <h5>Mettre en ligne le produit : </h5>
                <label for="opened">opened</label>
                <input type="radio" id="opened" value="opened"
                       name="publication" {{($product->status=='opened')? 'checked' : ''}}> opened<br>

                <label for="closed">closed</label>
                <input type="radio" id="closed" value="closed"
                       name="publication" {{($product->status=='closed')? 'checked' : ''}}> closed<br>

                <div class="input-file">
                    @if($product->picture)
                        <img src="{{url('uploads', $product->picture->uri)}}" width="100">
                        <label for="remove">Remove picture</label>
                        <input type="radio" value="true" name="remove">
                    @endif
                    <h2>{{trans('app.addImage')}}</h2>
                    <input class='file' type="file" name="thumbnail">
                    @if($errors->has("thumbnail")) <span class="error">{{$errors->first('thumbnail')}}</span> @endif
                </div>

                <div class="form-submit">
                    <input id="add-product" type="submit" value="Update the product">
                </div>
            </div>
        </div>
    </form>
@stop

