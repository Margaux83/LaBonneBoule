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
                    <div style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                        <a href="{{ url('/shopping') }}">
                            <button class="px-2 py-1 text-white bg-blue-500 mb-5">Accéder à la boutique</button>
                        </a>
                        <p>Balance : {{$connectedUser->balance}} €</p>
                    </div>

                    <h4 class="my-2" style="font-weight: bold; font-size: 20px;">Boules possédées</h4>
                    <ul style="display: flex; flex-wrap: wrap; justify-content: center;">
                        @foreach($inventory as $inventoryItem)
                            @if($inventoryItem->ball_id !== null)
                                <li class="px-6" style="max-width: 300px;">
                                    <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                                        <img src='{{ asset('storage/images/balls/' . $inventoryItem->getBall->image) }}' alt="" class="w-full max-h-60" style="margin: 0 auto; width: auto;">
                                        <div class="flex items-end w-full bg-cover">
                                            <div class="px-5 py-3">
                                                <h3 class="text-gray-700 uppercase"> <a href="/ball/{{ $inventoryItem->getBall->id }}">
                                                        {{$inventoryItem->getBall->name}}
                                                    </a></h3>
                                                <p> {{$inventoryItem->getBall->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <h4 class="my-2" style="font-weight: bold; font-size: 20px;">Coupes possédées</h4>
                    <ul>
                        @foreach($inventory as $inventoryItem)
                            @if($inventoryItem->cup_id !== null)
                                <li>{{$inventoryItem->getCup->name}}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>