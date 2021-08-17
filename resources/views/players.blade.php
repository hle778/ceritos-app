@extends('layouts.app')

@section('main-content')
    <div class="row mb-3">
        <div class="col-md-4 offset-md-4">
            <div class="table-responsive mb-2">
                <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                  <thead class="thead-light">
                    <tr class="text-center">
                        <th scope="col">Jugador</th>
                        <th scope="col">Juegos ganados</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($players as $player)
                        <tr class="text-center">
                            <td>{{ $player->name }}</td>
                            <td>{{ $player->gamesWon }}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $players->links() }}
            </div>

            <div class="text-center">
                <a href="{{ (isset($gameId)) ? route('games.show', $gameId) : route('home') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
            
        </div>
    </div>
@endsection
