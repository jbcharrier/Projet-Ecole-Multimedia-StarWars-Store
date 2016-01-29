@extends('layouts.admin')


@section('content')
    <div class="container">
    <form method="POST" action="{{url('customer')}}">
        {!!csrf_field()!!}

        <h2>Compléter mes données clients</h2>

        <p>{{$users->name}}</p>
        <div class="form-text">
            <label class="label" for="address">Entrer mon adresse : </label>
            <input class="input-text" id="address" name="address" type="text" value="{{old('address')}}" >
            @if($errors->has("")) <span class="error">{{$errors->first("")}}</span> @endif
        </div>

        <div class="form-text">
            <label class="label" for="number_card">Entrer mon numéro de CB</label>
            <input class="input-text" id="number_card" name="number_card" type="text" value="{{old('number_card')}}" >
            @if($errors->has("")) <span class="error">{{$errors->first("")}}</span> @endif
        </div>

        <div class="form-text">
            <label class="label" for="nombre de commandes"></label>
            <input class="input-text" id="nombre de commandes" name="nombre de commandes" type="text" value="{{old('nombre de commandes')}}" >
            @if($errors->has("")) <span class="error">{{$errors->first("")}}</span> @endif
        </div>


            <div class="form-submit">
                <input id="add-product" type="submit" value="Update the product">
            </div>
        </div>
    </form>
@stop