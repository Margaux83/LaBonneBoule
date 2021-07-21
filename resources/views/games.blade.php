<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des matchs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ url('/addgame') }}">
                        <button>Créer un match</button>
                    </a>
                    @foreach($games as $game)
                        <a href="/game/{{ $game->id }}">
                            <div class="container products">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div style="display: flex; justify-content: space-between;">
                                        Match {{ $game->id }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>