<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'équipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container products">
                        <div class="row">
                            <div class="col-xs-18 col-sm-6 col-md-3">
                            <div style="display: flex; justify-content: space-between;">
                                <h4 style="font-weight: bold; font-size: 20px;">{{$team->name}}</h4>
                                <div>
                                    @if(empty(auth()->user()->team_id))
                                        <a href="/joinTeam/{{$team->id}}">
                                            <button class="px-2 py-1 text-white bg-blue-500 mr-1">Rejoindre l'équipe</button>
                                        </a>
                                    @else 
                                        @if(auth()->user()->team_id === $team->id)
                                            @if(auth()->user()->team_accepted)
                                                <a href="/leaveTeam">
                                                    <button class="px-2 py-1 text-white bg-red-500 mr-1">Quitter l'équipe</button>
                                                </a>
                                            @else
                                                <a href="/leaveTeam">
                                                    <button class="px-2 py-1 text-white bg-red-500 mr-1">Annuler ma demande</button>
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>

                                <p>Créateur : {{$team->getCreator->name}}</p>
                                <h5 class="mt-2">Statistiques de l'équipe</h5>
                                <p>
                                    Victoires : {{$team->wins}} 
                                </p>
                                <p>
                                    Défaites : {{$team->loses}}
                                </p>
                                <p>
                                    Ratio : @if ($team->loses > 0)
                                        {{$team->wins / $team->loses}}
                                    @else
                                        {{$team->wins / 1}}
                                    @endif
                                </p>

                                <p class="mt-5">Membres titulaires</p>
                                <ul>
                                    @foreach($members as $member)
                                        @if($member->team_accepted)
                                            <li class="mb-2">
                                                @if(auth()->user()->id === $team->creator)
                                                    @if (auth()->user()->id !== $member->id)
                                                        <a href="/fireMember/{{$member->id}}">
                                                            <button class="px-2 py-1 text-white bg-red-500 mr-1">Virer</button>
                                                        </a>
                                                    @else
                                                    <button class="px-2 py-1 text-white mr-1" style="background-color: grey;">Vous</button>
                                                    @endif
                                                @endif
                                                {{$member->name}}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>

                                @if(auth()->user()->team_id === $team->id && auth()->user()->team_accepted)
                                    <p class="mt-5">Demandes en attente</p>
                                    <ul>
                                        @foreach($members as $member)
                                            @if(!$member->team_accepted)
                                                <li class="mb-2">
                                                    @if(!$member->team_accepted)
                                                        <a href="/acceptMember/{{$member->id}}">
                                                            <button class="px-2 py-1 text-white bg-blue-500 mr-1">Accepter</button>
                                                        </a>
                                                    @endif
                                                    {{$member->name}}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif

                                @if(auth()->user()->team_id === $team->id && !auth()->user()->team_accepted)
                                    <p style="font-style: italic; margin-top: 3rem;">Vous avez effectué une demande d'intégration de cette équipe, veuillez attendre une réponse</p>
                                @endif
                            </div>
                        </div><!-- End row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
