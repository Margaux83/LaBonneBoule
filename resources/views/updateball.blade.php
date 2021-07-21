<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier une boule de pétanque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Modification</p>

                    {!! Form::open(['route' => 'store', 'files' => true]) !!}
                    {!! Form::label('name', 'Nom'); !!}   <br>
                    {!! Form::text('name', $ball->name, ['required']) !!}   <br>
                    {!! Form::label('image', 'Image'); !!}   <br>
                    <img src='{{ asset('storage/images/balls/' . $ball->image) }}'>
                    {!! Form::file('image') !!}   <br>
                    {!! Form::label('description', 'Description'); !!}   <br>
                    {!! Form::text('description', $ball->description) !!}   <br>
                    {!! Form::label('price', 'Prix'); !!}   <br>
                    {!! Form::number('price', $ball->price, ['required']) !!}   <br>
                    {!! Form::hidden('ball_id', $ball->id) !!}
                    {!! Form::submit('Update post') !!}
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
