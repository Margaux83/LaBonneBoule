<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du tournoi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container products">
                        <div class="row">
                            <div class="col-xs-18 col-sm-6 col-md-3">
                                <h4>
                                    {{$tournament->name}}
                                </h4>
                                <p>
                                    Date de début : {{$tournament->date_start}} 
                                </p>
                                <p>
                                    Date de fin : {{$tournament->date_end}} 
                                </p>
                            </div>

                            <div>
                                <p>Liste des matchs</p>
                                <ul>
                                    <li>
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
                                    </li>
                                </ul>
                            </div>
                        </div><!-- End row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
