@extends('layouts.app')

@section('main-content')
    <div class="row mb-3">
        <div class="col-md-4 offset-md-4">
            <div class="alert alert-info text-center">
                <h4>{{$game->player_x->name}} (x) vs {{$game->player_o->name}} (o)</h4>
            </div>

            <div class="text-center mb-2">
                <h5 id="gameMessage" class="text-uppercase font-weight-bold">
                    @if ($turnCounter == 9)
                        Juego empatado
                    @elseif ($winner)
                        Ha ganado {{ ((($turnCounter-1) % 2) == 0) ? $game->player_x->name : $game->player_o->name }}!!!
                    @else
                        Turno para {{ (($turnCounter % 2) == 0) ? $game->player_x->name : $game->player_o->name }}
                    @endif
                </h5>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <input type="hidden" id="gameId" value="{{$game->id}}" />
                    <table style="width: 100%;" cellpadding="5">
                        <tbody>
                            @for ($row = 0; $row < 3; $row++)
                                <tr>
                                    @for ($col = 0; $col < 3; $col++)
                                        <td class="@if($row == 0 || $row == 1) border-bottom @endif @if($col == 0 || $col == 1) border-right @endif">
                                            <button type="button" id="{{$row}}{{$col}}" class="btn @if($winner && in_array("$row$col", $winnerArray)) btn-success @else btn-secondary @endif w-100 h-100 cell" row="{{$row}}" col="{{$col}}" @if ($winner || trim($game->positions[$row][$col]) != '') disabled @endif>
                                                @if (trim($game->positions[$row][$col]) != '')
                                                    {{$game->positions[$row][$col]}}
                                                @else
                                                    &nbsp;
                                                @endif
                                            </button>
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('games.restart', [$game->id]) }}" class="btn btn-primary">Reiniciar juego</a>
                <a href="{{ route('players.index', [$game->id]) }}" class="btn btn-secondary">Estadísticas</a>
                <a href="{{ route('home') }}" class="btn btn-dark">Nuevo juego</a>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')

<script type="text/javascript">

    $(function() {

        $(document).on('click', '.cell', function() {
            var cell = $(this);

            $.ajax({
                type:'POST',
                url:"{{ route('games.play') }}",
                data: {
                    gameId: $('#gameId').val(),
                    row: $(this).attr('row'),
                    col: $(this).attr('col')
                },
                success:function(data) {
                    cell.prop('disabled', true);
                    cell.text((((data.turnCounter) % 2) == 0) ? 'X' : 'O');
                    cell.blur();

                    if (data.winner) {
                        $('#gameMessage').text("Ha ganado " + (((data.turnCounter % 2) == 0) ? data.game.player_x.name : data.game.player_o.name) + '!!!');

                        $('.cell').each(function() {
                            $(this).prop('disabled', true);
                        });

                        $.each(data.winnerArray, function(index, value) {
                            $('#'+value).removeClass("btn-secondary");
                            $('#'+value).addClass("btn-success");
                        });
                    }
                    else
                        $('#gameMessage').text("Turno para " + ((((data.turnCounter+1) % 2) == 0) ? data.game.player_x.name : data.game.player_o.name));      
                }
            });
        });

    });

</script>

@endsection
