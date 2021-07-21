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
                    <p>Liste des boules dans votre panier</p>
                    <div class="container px-6 mx-auto">
                        <div class="flex justify-center my-6">
                            <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                                <h3 class="text-3xl text-bold">Cart List</h3>
                                <div class="flex-1">
                                    <table class="w-full text-sm lg:text-base" cellspacing="0">
                                        <thead>
                                        <tr class="h-12 uppercase">
                                            <th class="hidden md:table-cell"></th>
                                            <th class="text-left">Nom</th>
                                            <th class="pl-5 text-left lg:text-right lg:pl-0">
                                                <span class="lg:hidden" title="Quantity">Qté</span>
                                                <span class="hidden lg:inline">Quantité</span>
                                            </th>
                                            <th class="hidden text-right md:table-cell">Prix</th>
                                            <th class="hidden text-right md:table-cell"> Supprimer </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="hidden pb-4 md:table-cell">
                                                    <a href="#">
                                                        <img src="http://placehold.it/500x300" class="w-20 rounded">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <p class="mb-2 md:ml-4">Nom de la boule</p>

                                                    </a>
                                                </td>
                                                <td class="justify-center mt-6 md:justify-end md:flex">
                                                    <div class="h-10 w-28">
                                                        <div class="relative flex flex-row w-full h-8">

                                                            <form >
                                                                @csrf
                                                                <input type="hidden" name="id" value="" >
                                                                <input type="number" name="quantity" value=""
                                                                       class="w-6 text-center bg-gray-300" />
                                                                <button type="submit" class="px-2 pb-2 ml-2 text-white bg-blue-500">update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="hidden text-right md:table-cell">
                                <span class="text-sm font-medium lg:text-base">
                                  11110€
                                </span>
                                                </td>
                                                <td class="hidden text-right md:table-cell">
                                                    <form >
                                                        @csrf
                                                        <input type="hidden" value="" name="id">
                                                        <button class="px-4 py-2 text-white bg-red-600">x</button>
                                                    </form>

                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div>
                                        Total: 100€
                                    </div>
                                    <div>
                                        <form>
                                            @csrf
                                            <button class="px-6 py-2 text-red-800 bg-red-300">Remove All Cart</button>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
