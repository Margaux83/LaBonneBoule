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
                    @foreach($balls as $ball)
                        <div class="container px-6 mx-auto">
                            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                    <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                                        <img src='{{ asset('storage/images/balls/' . $ball->image) }}' alt="" class="w-full max-h-60">
                                        <div class="flex items-end justify-end w-full bg-cover">

                                        </div>
                                        <div class="px-5 py-3">
                                            <h3 class="text-gray-700 uppercase"> <a href="/ball/{{ $ball->id }}">
                                                    {{$ball->name}}
                                                </a></h3>
                                            <p> {{$ball->description}}</p>
                                            <span class="mt-2 text-gray-500"><strong>Price : </strong>{{$ball->price}}€</span>
                                            <p></p>
                                              <button class="px-2 py-1 text-red-800 bg-red-300">
                                                <a class="btn btn-warning btn-block text-center" role="button" href="/delete/{{ $ball->id }}">Supprimer</a></button>
                                            <button class="px-2 py-1 text-white bg-blue-500"><a class="btn btn-warning btn-block text-center" href="/update/{{ $ball->id }}">Modifier</a></button>
                                            <button class="px-2 py-1 text-black bg-white"><a class="btn btn-warning btn-block text-center" href="">Mettre dans le panier</a></button>
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
