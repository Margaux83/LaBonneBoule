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
                    <p>Ajout</p>
                    {!! Form::open(['url' => 'postBall', 'files' => true]) !!}
                    {!! Form::label('name', 'Nom :'); !!}   <br>
                    {!! Form::text('name',null, ['required']) !!}   <br>
                    {!! Form::label('image', 'Image :'); !!}   <br>
                    {!! Form::file('image' , ['required']) !!}   <br>
                    {!! Form::label('description', 'Description :'); !!}   <br>
                    {!! Form::textarea('description',null) !!}   <br>
                    {!! Form::label('price', 'Prix :'); !!}   <br>
                    {!! Form::number('price',null, ['required']) !!}   <br>
                    {!! Form::submit('Ajouter la boule') !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
