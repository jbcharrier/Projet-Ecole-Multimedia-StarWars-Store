@extends('layouts.admin')

@section('content')
    <div class="container">
        <form method="POST" action="{{url('product', $product->id)}}" enctype="multipart/form-data">
            {!!csrf_field()!!}
            {{method_field('PUT')}}
            <div class="grid-2">
                <div>
                    <div class="form-text">
                        <label class="label" for="name">{{trans('app.name')}}</label>
                        <input class="input-text input" id="name" name="name" type="text" value="{{$product->name}}">
                        @if($errors->has("name")) <span class="error">{{$errors->first("name")}}</span> @endif
                    </div>
                    <div class="form-text">
                        <label class="label" for="slug">{{trans('app.slugName')}}</label>
                        <input class="input-text input" id="slug" name="slug" type="text" value="{{$product->slug}}">
                        @if($errors->has("slug")) <span class="error">{{$errors->first("slug")}}</span> @endif
                    </div>
                    <div class="form-text">
                        <label class="label" for="price">{{trans('app.price')}}</label>
                        <input class="input-text input" id="price" name="price" type="text" value="{{$product->price}}">
                        @if($errors->has("price")) <span class="error">{{$errors->first('price')}}</span> @endif
                    </div>
                    <div class="form-text">
                        <label class="label" for="quantity">{{trans('app.quantity')}}</label>
                        <input class="input-text input" id="quantity" name="quantity" type="text"
                               value="{{$product->quantity}}">
                        @if($errors->has("quantity")) <span class="error">{{$errors->first("quantity")}}</span> @endif
                    </div>
                    <div class="content">
                        <label class="label" for="abstract">{{trans('app.abstract')}}</label>
                        <textarea row="50" cols="50" name="abstract" class="textarea">{{$product->abstract}}</textarea>
                        @if($errors->has("abstract")) <span class="error">{{$errors->first("abstract")}}</span> @endif
                    </div>
                    <div class="content">
                        <label class="label" for="content">{{trans('app.content')}}</label>
                        <textarea row="50" cols="50" name="content" class="textarea">{{$product->content}}</textarea>
                        @if($errors->has("content")) <span class="error">{{$errors->first("content")}}</span> @endif
                    </div>
                </div>
                <div>
                    <div>
                        <label class="label" for="category_id">{{trans('app.category')}}</label>
                        <select class="input" name="category_id">
                            <optgroup label="Sélectionnez la catégorie">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{($product->category_id==$category->id)? 'selected' : ''}}>{{$category->title}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div>
                        <label class="label" for="tags">{{trans('app.tagselect')}}</label>
                        <select class="input" name="tags[]" multiple size="5">
                            <optgroup label="Sélectionnez vos tags">
                                @foreach ($tags as $id=>$name)
                                    <option value="{{$id}}" {{$product->hasTag($id)? 'selected' : ''}}>{{$name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div>
                        <label for="published_at">Date de publication (maintenant) : </label>
                        <input type="radio" id="published_at" value="true" name="published_at"
                                {{($product->published_at!='0000-00-00 00:00:00')? 'checked' : ''}}>
                    </div>
                    <div class="input-margin">
                        <p>Mise en ligne du produit : </p>
                        <input type="radio" id="opened" value="1"
                               name="publication" {{($product->status=='opened')? 'checked' : ''}}> opened<br>
                        <input type="radio" id="closed" value="0"
                               name="publication" {{($product->status=='closed')? 'checked' : ''}}> closed<br>
                    </div>
                    <div class="input-file input-margin">
                        @if($product->picture)
                            <img src="{{url('uploads', $product->picture->uri)}}" width="100">
                            <label for="remove">Supprimer l'image</label>
                            <input type="radio" value="true" name="remove">
                        @endif
                        <p>{{trans('app.addimage')}}</p>
                        <input class='file' type="file" name="thumbnail">
                        @if($errors->has("thumbnail")) <span class="error">{{$errors->first('thumbnail')}}</span> @endif
                    </div>
                    <div class="form-submit input-margin">
                        <input class="btn" id="add-product" type="submit" value="Mise à jour du produit">
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop