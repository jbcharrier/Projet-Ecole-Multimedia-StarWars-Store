@extends('layouts.master')

@section('content')
    <div class="container" id="contact">
        @if(Session::has('sendemail'))
            @include('front.partials.flash')
        @endif
        <form method="POST" action="{{url('storeContact')}}">
            {!!csrf_field()!!}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="contact txtcenter">
                <h3>Pour toute demande en lien avec le StarWars Store, n'hésitez pas à nous adresser un mail en
                    remplissant le formulaire ci-dessous :</h3>
                <div class="form-text">
                    <label class="label" for="email">{{trans('app.emailAddress')}}</label>
                    <input class="input-text email" id="email" name="email" type="text" value="{{old('email')}}">
                    @if($errors->has('email')) <span class="error">{{$errors->first('email')}}</span> @endif
                </div>
                <div class="content">
                    <textarea name="content">{{old('content')}}</textarea>
                    @if($errors->has('content')) <span class="error">{{$errors->first('content')}}</span> @endif
                </div>
                <div class="form-submit">
                    <input class="btn" type="submit" value="Envoyer">
                </div>
            </div>
        </form>
    </div>
@stop