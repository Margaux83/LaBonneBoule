<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un tournoi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {!! Form::open(['url' => 'postTournament']) !!}

                    {!! Form::label('name', 'Nom :'); !!}   <br>
                    {!! Form::text('name',null, ['required']) !!}   <br>
                    
                    {!! Form::label('date_start', 'Début :'); !!}   <br>
                    {!! Form::date('date_start',null, ['required']) !!}   <br>

                    {!! Form::label('date_end', 'Fin :'); !!}   <br>
                    {!! Form::date('date_end',null, ['required']) !!}   <br>

                    {!! Form::submit('Ajouter') !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
