<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(!auth()->user())
                        <h3 style="font-weight: bold; font-size: 20px;">Vous n'êtes pas connecté</h3>
                        <p>
                            Vous n'avez donc pas accès à l'entièreté du site.<br>
                            Nous vous invitons à vous connecter ou à créer un compte.
                        </p>
                        <div class="mb-5 mt-2">
                            <a href="/login">
                                <button class="px-2 py-1 text-white bg-blue-500">Se connecter</button>
                            </a>
                            <a href="/register">
                                <button class="px-2 py-1 text-white bg-blue-500">Créer un compte</button>
                            </a>
                        </div>

                    @else
                        <a href="/balls">
                            <button class="px-2 py-1 text-white bg-blue-500 mb-5">Voir les boules de pétanque</a>
                        </button>
                    @endif

                    <div style="display: flex; justify-content: space-between;">
                        <div>
                            <div class="card-body">
                                <h1>{{ $chart1->options['chart_title'] }}</h1>
                                {!! $chart1->renderHtml() !!}
                                {!! $chart1->renderChartJsLibrary() !!}
                                {!! $chart1->renderJs() !!}
                            </div>
                            <div class="card-body">
                                <h1>{{ $chart3->options['chart_title'] }}</h1>
                                {!! $chart3->renderHtml() !!}
                                {!! $chart3->renderChartJsLibrary() !!}
                                {!! $chart3->renderJs() !!}
                            </div>
                        </div>

                        <div class="card-body">
                            <h1>{{ $chart2->options['chart_title'] }}</h1>
                            {!! $chart2->renderHtml() !!}
                            {!! $chart2->renderChartJsLibrary() !!}
                            {!! $chart2->renderJs() !!}
                        </div>

                        <div class="card-body">
                            <h1>{{ $chart4->options['chart_title'] }}</h1>
                            {!! $chart4->renderHtml() !!}
                            {!! $chart4->renderChartJsLibrary() !!}
                            {!! $chart4->renderJs() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>