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
                                <h4 style="font-weight: bold; font-size: 20px;">
                                    {{$tournament->name}}
                                </h4>
                                @if($tournament->winner !== null)
                                    <p>Vainqueur : {{$tournament->getWinner->name ?? 'Equipe supprimée'}}</p>
                                @endif
                                <p>
                                    Date de début : {{$tournament->date_start}} 
                                </p>
                                <p>
                                    Date de fin : {{$tournament->date_end}} 
                                </p>
                            </div>

                            <div class="mt-5">
                                <p>Liste des matchs</p>
                                @for ($i = 1; $i <= $tournamentMaxRound; $i++)
                                    <p class="mt-2">Round {{$i}}</p>
                                    <ul>
                                        @foreach($games as $game)
                                            @if($game->tournament_round === $i)
                                                <a href="/game/{{ $game->id }}">
                                                    <li class="container products" style="padding: 10px; border: 1px solid lightgrey;">
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div style="display: flex; justify-content: space-between;">
                                                                Match {{ $game->id }} @if($game->winner) - Vainqueur : {{$game->getWinner->name  ?? 'Equipe supprimée'}}@endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                </a>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endfor
                            </div>
                        </div><!-- End row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
