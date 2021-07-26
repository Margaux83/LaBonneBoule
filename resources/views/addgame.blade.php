<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un match') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Création</p>
                    {!! Form::open(['url' => 'postGame']) !!}

                    @error('team1')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {!! Form::label('team1', 'Team 1 :'); !!}   <br>
                    {!! Form::select('team1', $teams, null, ['placeholder' => 'Sélectionnez une équipe', 'required' => true]); !!}   <br>
                    
                    @error('team2')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {!! Form::label('team2', 'Team 2 :'); !!}   <br>
                    {!! Form::select('team2', $teams, null, ['placeholder' => 'Sélectionnez l\'autre équipe', 'required' => true]); !!}   <br>

                    {!! Form::label('tournament_id', 'Tounoi :'); !!}   <br>
                    {!! Form::select('tournament_id', $tournaments, null, ['placeholder' => 'Sélectionnez un tournoi', 'required' => true]); !!}   <br>


                    {!! Form::submit('Créer le match'); !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
