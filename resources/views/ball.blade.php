<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des boules de pétanque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container products">
                        <div class="row">
                            <div class="col-xs-18 col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/500x300" alt="">
                                    <div class="caption">
                                        <h4>  <a href="/ball/{{ $ball->id }}">
                                                {{$ball->name}}
                                            </a></h4>
                                        <p> {{$ball->description}}</p>
                                        <p><strong>Price : </strong>{{$ball->price}}€</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
