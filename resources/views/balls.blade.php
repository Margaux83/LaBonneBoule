<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des boules de pétanque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button><a href="{{ url('/addballs') }}">Ajouter une boule de pétanque</a></button>
                    <br>
                    @foreach($balls as $ball)
                        <div class="container products">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/500x300" alt="">
                                        <div class="caption">
                                            <h4>  <a href="/ball/{{ $ball->id }}">
                                                    {{$ball->name}}
                                                </a></h4>
                                            <p> {{$ball->description}}</p>
                                            <p><strong>Price : </strong>{{$ball->price}}€</p>
                                            (  <a class="btn btn-warning btn-block text-center" role="button"href="/delete/{{ $ball->id }}">Supprimer</a>  |
                                           <a class="btn btn-warning btn-block text-center" href="/update/{{ $ball->id }}">Modifier</a>  |
                                           <a class="btn btn-warning btn-block text-center" href="">Mettre dans le panier</a>
                                            )
                                        </div>
                                    </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
