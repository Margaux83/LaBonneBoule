<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des équipes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ url('/addteam') }}">
                        <button class="px-2 py-1 text-white bg-blue-500 mb-5">+ Créer une équipe</button>
                    </a>
                    <ul class="mb-2">
                    @foreach($teams as $team)
                        <a href="/team/{{ $team->id }}">
                            <li style="padding: 10px; border: 1px solid lightgrey;">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div style="display: flex; justify-content: space-between;">
                                        <p>{{$team->name}}</p>
                                    </div>
                                </div>
                            </li>
                        </a>
                    @endforeach
                    </ul>
                    {{ $teams->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>