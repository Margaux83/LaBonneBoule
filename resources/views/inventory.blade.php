<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventaire') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ url('/shopping') }}">
                        <button>Accéder à la boutique</button>
                    </a>
                    <p>Balance : {{$connectedUser->balance}} points</p>

                    <p class="mt-2">Boules possédées</p>
                    <ul>
                        @foreach($inventory as $inventoryItem)
                            @if($inventoryItem->ball_id !== null)
                                <li>{{$inventoryItem->ball_id}}</li>
                            @endif
                        @endforeach
                    </ul>

                    <p class="mt-2">Coupes possédées</p>
                    <ul>
                        @foreach($inventory as $inventoryItem)
                            @if($inventoryItem->cup_id !== null)
                                <li>{{$inventoryItem->cup_id}}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>