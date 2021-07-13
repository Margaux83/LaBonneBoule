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
                    <p>Liste</p>
                    <button><a href="{{ url('/addballs') }}">Ajouter une boule de pétanque</a></button>
                    @foreach($balls as $ball)
                        <li>
                            <a href="/ball/{{ $ball->id }}">
                                {{$ball->name}}
                            </a>
                            ( <a href="/delete/{{ $ball->id }}">delete</a> |
                            <a href="/update/{{ $ball->id }}">update</a>
                            )
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
