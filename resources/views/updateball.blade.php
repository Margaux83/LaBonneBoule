<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter une boule de pétanque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Modification</p>
                    {!! Form::open(['route' => 'store']) !!}
                    {!! Form::text('name', $ball->name, ['required']) !!}
                    {!! Form::file('image', ['required']) !!}
                    {!! Form::hidden('ball_id', $ball->id) !!}
                    {!! Form::submit('Update post') !!}
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
