<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du match') }}
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
                                    Match {{$game->id}}
                                </h4>
                                @if($game->winner)
                                    <p>Vainqueur : {{$game->getWinner->name}}</p>
                                @endif
                                <h5 class="mt-2">Equipes concernées :</h5>
                                @foreach($teamgames as $key => $teamgame)
                                    <div class="container products mb-2">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div style="display: flex; align-items: center;">
                                                @if(auth()->user()->isAbleTo('manageGame'))
                                                    @if($game->winner === null)
                                                        <a href="/gameSetWinner/{{$game->id}}/{{$teamgame->getTeam->id}}">
                                                            <button class="px-2 py-1 text-white bg-blue-500 mr-1">Vainqueur</button>
                                                        </a>
                                                    @endif
                                                @endif
                                                <a href="/team/{{ $teamgame->getTeam->id }}">
                                                    <p>Equipe {{$key + 1}} : {{ $teamgame->getTeam->name}}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- End row -->
                        @if($game->tournament_id !== null)
                            <a href="/tournament/{{$game->tournament_id}}">
                                <div class="mt-5">
                                    Tournoi : {{$game->getTournament->name}}
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
