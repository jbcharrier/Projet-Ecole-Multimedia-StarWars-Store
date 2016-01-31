@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Veuillez remplir les champs suivants pour créer votre compte utilisateur :</h2>
        <div class="grid-2">
            <form method="POST" action="{{url('login', ['store'])}}">
                {!!csrf_field()!!}
                <div class="form-text">
                    <label class="label" for="name">{{trans('app.userName')}}</label>
                    <input class="input-text input" id="name" name="name" type="text" value="{{old('name')}}" required>
                    @if($errors->has("name")) <span class="error">{{$errors->first("name")}}</span> @endif
                </div>
                <div class="form-text">
                    <label class="label" for="email">{{trans('app.emailAddress')}}</label>
                    <input class="input-text input" id="email" name="email" type="email" value="{{old('email')}}"
                           required>
                    @if($errors->has('email')) <span class="error">{{$errors->first('email')}}</span> @endif
                </div>
                <div class="form-text">
                    <label class="label" for="password">{{trans('app.password')}}</label>
                    <input class="input-text input" id="password" name="password" type="password" required>
                    @if($errors->has("password")) <span class="error">{{$errors->first("password")}}</span> @endif
                </div>
                <div class="form-submit">
                    <input class="btn input" type="submit" value="Enregistrer mes informations">
                </div>
            </form>
        </div>
    </div>
@stop