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
                                <h4>
                                    {{$team->name}}
                                </h4>
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
                            </div>
                        </div><!-- End row -->
                        <div class="row mt-5">
                            <button>Rejoindre l'équipe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
