<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter à votre solde') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 style="font-weight: bold; font-size: 20px;">Ajouter au solde</h3>
                    <p>Pour finaliser votre paiement, vous devez ajouter de l'argent à votre sold</p>

                    <p>Solde à ajouter : {{$balance}} €</p>

                    <a href="/addUserBalance/{{$shoppingcart->id}}">
                        <button class="px-10 py-3 text-white bg-blue-500 mt-5">Payer</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
