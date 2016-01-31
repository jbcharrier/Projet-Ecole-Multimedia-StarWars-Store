@extends('layouts.admin')

@section('content')
    <div class="container">
        <form method="POST" action="{{url('product')}}" enctype="multipart/form-data">
            {!!csrf_field()!!}
            <div class="grid-2">
                <div>
                    <div class="form-text">
                        <label class="label" for="name">{{trans('app.name')}}</label>
                        <input class="input-text input" id="name" name="name" type="text" value="{{old('name')}}">
                        @if($errors->has("name")) <span class="error">{{$errors->first("name")}}</span> @endif
                    </div>
                    <div class="form-text">
                        <label class="label" for="slug">{{trans('app.slug')}}</label>
                        <input class="input-text input" id="slug" name="slug" type="text" value="{{old('slug')}}">
                        @if($errors->has("slug")) <span class="error">{{$errors->first("slug")}}</span> @endif
                    </div>
                    <div class="form-text">
                        <label class="label" for="price">{{trans('app.price')}}</label>
                        <input class="input-text input" id="price" name="price" type="text" value="{{old('price')}}">
                        @if($errors->has("price")) <span class="error">{{$errors->first('price')}}</span> @endif
                    </div>
                    <div class="form-text">
                        <label class="label" for="quantity">{{trans('app.quantity')}}</label>
                        <input class="input-text input" id="quantity" name="quantity" type="text"
                               value="{{old('quantity')}}">
                        @if($errors->has("quantity")) <span class="error">{{$errors->first("quantity")}}</span> @endif
                    </div>
                    <div class="content">
                        <label class="label" for="abstract">{{trans('app.abstract')}}</label>
                        <textarea row="50" cols="50" name="abstract" class="textarea"></textarea>
                        @if($errors->has("abstract")) <span class="error">{{$errors->first("abstract")}}</span> @endif
                    </div>
                    <div class="content">
                        <label class="label" for="content">{{trans('app.content')}}</label>
                        <textarea row="50" cols="50" name="content" class="textarea"></textarea>
                        @if($errors->has("content")) <span class="error">{{$errors->first("content")}}</span> @endif
                    </div>
                </div>
                <div>
                    <div>
                        <label class="label" for="category_id">{{trans('app.category')}}</label>
                        <select class="input" name="category_id">
                            <optgroup label="Sélectionnez la catégorie">
                                @forelse ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @empty
                                    @else
                                        @endforelse
                            </optgroup>
                        </select>
                    </div>
                    <div>
                        <label class="label" for="tags">{{trans('app.tagselect')}}</label>
                        <select class="input" name="tags[]" multiple size="5">
                            <optgroup label="Sélectionnez vos tags">
                                @forelse ($tags as $id=>$name)
                                    <option value="{{$id}}">{{$name}}</option>
                                @empty
                                @endforelse
                            </optgroup>
                        </select>
                    </div>
                    <div class="input-margin">
                        <label for="published_at">Date de publication (maintenant) : </label>
                        <input type="radio" id="published_at" value="true" name="published_at">
                    </div>
                    <div class="input-margin">
                        <p>Mise en ligne du produit : </p>
                        <label for="opened">opened</label>
                        <input type="radio" id="opened" value="1" name="publication">

                        <label for="closed">closed</label>
                        <input type="radio" id="closed" value="0" name="publication" checked>
                    </div>
                    <div class="input-file input-margin">
                        <p>{{trans('app.addimage')}}</p>
                        <input class='file' type="file" name="thumbnail">
                        @if($errors->has("thumbnail")) <span class="error">{{$errors->first('thumbnail')}}</span> @endif
                    </div>
                    <div class="form-submit input-margin">
                        <input class="btn" id="add-product" type="submit" value="Ajouter le produit">
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop