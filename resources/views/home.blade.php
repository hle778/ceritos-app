@extends('layouts.app')

@section('main-content')
    <div class="row mb-3">
        <div class="col-md-4 offset-md-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ( $errors->all() as $error )
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-md-12 text-center">
                    <button class="btn btn-secondary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Agregar jugador</button>
                </div>
            </div>
            <div class="collapse mb-2" id="collapseExample">
                <div class="card card-body">
                    {!! Form::open(['route' => 'players.store']) !!}
                        <div class="d-flex flex-row align-items-center mb-2">
                            {!! Form::label('name', 'Nombre:', ['class' => 'font-weight-bold mr-2']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control mr-2']) !!}
                            <button class="btn btn-sm btn-dark" type="submit"><i class="fas fa-save"></i></button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="mb-5">
                {!! Form::open(['route' => 'games.store']) !!}
                    <div class="row mb-2">
                        <div class="col-md-6">
                            {!! Form::label('playerX', 'Jugador-X', ['class' => 'font-weight-bold']) !!}
                            {!! Form::select('playerX', $players, null, ['class' => 'form-control', 'required', 'placeholder' => '- select -']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('playerO', 'Jugador-O', ['class' => 'font-weight-bold']) !!}
                            {!! Form::select('playerO', $players, null, ['class' => 'form-control', 'required', 'placeholder' => '- select -']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary" type="submit">Empezar el juego</button>
                            <a href="{{ route('players.index') }}" class="btn btn-secondary">Estadísticas</a>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
