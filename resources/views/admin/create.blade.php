@extends('layouts.admin')

<div class="container">
@section('content')
    <form method="POST" action="{{url('product')}}" enctype="multipart/form-data">

        {!!csrf_field()!!}
        {{--c'est un token de la session qu'on passe via le head (évite qu'on nous attaque via un formulaire) // durée de 5 min--}}
        <div class="grid-2">
            <div>
                <div class="form-text">
                    <label class="label" for="name">{{trans('app.name')}}</label>
                    <input class="input-text" id="name" name="name" type="text" value="{{old('name')}}">
                    @if($errors->has("name")) <span class="error">{{$errors->first("name")}}</span> @endif
                </div>

                <div class="form-text">
                    <label class="label" for="slug">{{trans('app.slugName')}}</label>
                    <input class="input-text" id="slug" name="slug" type="text" value="{{old('slug')}}">
                    @if($errors->has("slug")) <span class="error">{{$errors->first("slug")}}</span> @endif
                </div>

                <div class="form-text">
                    <label class="label" for="price">{{trans('app.price')}}</label>
                    <input class="input-text" id="price" name="price" type="text" value="{{old('price')}}">
                    @if($errors->has("price")) <span class="error">{{$errors->first('price')}}</span> @endif
                </div>

                <div class="form-text">
                    <label class="label" for="quantity">{{trans('app.quantity')}}</label>
                    <input class="input-text" id="quantity" name="quantity" type="text" value="{{old('quantity')}}">
                    @if($errors->has("quantity")) <span class="error">{{$errors->first("quantity")}}</span> @endif
                </div>

                <div class="content">
                    <label class="label" for="abstract">{{trans('app.abstract')}}</label>
                    <textarea row="50" cols="50" name="abstract"></textarea>
                    @if($errors->has("abstract")) <span class="error">{{$errors->first("abstract")}}</span> @endif
                </div>

                <div class="content">
                    <label class="label" for="content">{{trans('app.content')}}</label>
                    <textarea row="50" cols="50" name="content"></textarea>
                    @if($errors->has("content")) <span class="error">{{$errors->first("content")}}</span> @endif
                </div>
            </div>


            <div>
                <select name="category_id" multiple size="">
                    <optgroup label="Sélectionnez la catégorie">
                        @forelse ($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @empty
                            @else
                                @endforelse
                    </optgroup>
                </select>

                <label class="label" for="tags">{{trans('app.tag')}}</label>
                <select name="tags[]" multiple size="5">
                    <optgroup label="Sélectionnez vos tags">
                        @forelse ($tags as $id=>$name)
                            <option value="{{$id}}">{{$name}}</option>
                        @empty
                        @endforelse
                    </optgroup>
                </select>

                <div>
                    <label for="published_at">Date de publication (maintenant)</label>
                    <input type="radio" id="published_at" value="true" name="published_at">
                </div>

                <h5>Mettre en ligne le produit</h5>
                <label for="opened">opened</label>
                <input type="radio" id="opened" value="1" name="publication">

                <label for="closed">closed</label>
                <input type="radio" id="closed" value="0" name="publication" checked>

                <div class="input-file">
                    <h2>{{trans('app.addImage')}}</h2>
                    <input class='file' type="file" name="thumbnail">
                    @if($errors->has("thumbnail")) <span class="error">{{$errors->first('thumbnail')}}</span> @endif
                </div>

                <div class="form-submit">
                    <input id="add-product" type="submit" value="Add the product">
                </div>
            </div>
        </div>
    </form>
</div>
@stop