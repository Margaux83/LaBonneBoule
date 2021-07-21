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
                                <h4>
                                    Match {{$game->id}}
                                </h4>
                                <h5 class="mt-2">Equipes concernées :</h5>
                                @foreach($teamgames as $key => $teamgame)
                                    <a href="/team/{{ $teamgame->id + 1 }}">
                                        <div class="container products">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div style="display: flex; justify-content: space-between;">
                                                    Equipe {{$key + 1}} : {{ $teamgame->getTeam->name}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
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
