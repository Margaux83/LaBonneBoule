<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Votre panier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container px-6 mx-auto">
                        <div style="display: flex; justify-content: space-between">
                            <h3 class="text-3xl text-bold">Votre panier</h3>
                            <p>Votre solde : {{auth()->user()->balance}} €</p> 
                        </div>
                        
                        @if(count($shoppingElements))
                        <div class="mt-5">
                                <a href="/balls">
                                    <button class="px-2 py-1 text-white bg-blue-500 mb-5">Continuer mes achats</button>
                                </a>
                            </div>
                            <table style="width: 100%; text-align: center;">
                                <thead class="text-white bg-blue-500">
                                    <tr>
                                        <th class="px-2 py-1">Nb</th>
                                        <th style="text-align: center;">Image</th>
                                        <th>Nom du produit</th>
                                        <th>Description</th>
                                        <th>Prix</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shoppingElements as $keyBall => $shoppingElement)
                                        <tr  style="border: 1px solid lightgrey; border-top: 0">
                                            <td class="px-2 py-5" style="width: 60px;">
                                                <a href="/removeToCartFromCart/{{$keyBall}}">
                                                    <button>-</button>
                                                </a>
                                                {{$shoppingElement['count']}}
                                                <a href="/addToCartFromCart/{{$keyBall}}">
                                                    <button>+</button>
                                                </a>
                                            </td>
                                            <td style="width: 100px;">
                                                <img src='{{ asset('storage/images/balls/' . $shoppingElement['element']->getBall->image) }}' alt="" style="width: 80px; height: auto;  margin: auto;">
                                            </td>
                                            <td>{{$shoppingElement['element']->getBall->name}}</td>
                                            <td>{{$shoppingElement['element']->getBall->description}}</td>
                                            <td style="width: 50px;">{{$shoppingElement['element']->getBall->price}} €</td>
                                            <td style="width: 40px;">
                                                <a href="/deleteToCart/{{$keyBall}}">
                                                    <button style="padding: 1px 7px;color: white; background-color: red; border-radius: 50%;">X</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <a href="/deleteCart">
                                <button class="px-2 py-1 text-white bg-red-500 mt-5">Vider mon panier</button>
                            </a>
                        @else
                            <div class="mt-5">
                                <p class="mb-5">Vous n'avez pas de boules... dans votre panier ! Vous trouverez à coup sûr les boules faites pour vous dans la boutique</p>
                                <a href="/balls">
                                    <button class="px-2 py-1 text-white bg-blue-500 mb-5">Accéder à la boutique</button>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
