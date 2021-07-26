<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des tournois') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(auth()->user()->isAbleTo('createTournament'))
                        <a href="{{ url('/addtournament') }}">
                            <button class="px-2 py-1 text-white bg-blue-500 mb-5">+ Créer un tournoi</button>
                        </a>
                    @endif
                    <ul class="mb-2">
                    @foreach($tournaments as $tournament)
                        <a href="/tournament/{{ $tournament->id }}">
                            <li class="container products" style="padding: 10px; border: 1px solid lightgrey;">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div style="display: flex;">
                                        <p style="flex: 1;">{{$tournament->name}}
                                        @if($tournament->winner !== null)
                                             - Vainqueur : {{$tournament->getWinner->name}}</p>
                                        @else
                                            </p>
                                        @endif
                                        <p>{{$tournament->date_start}}</p>
                                    </div>
                                </div>
                            </li>
                        </a>
                    @endforeach
                    </ul>
                    {{ $tournaments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>