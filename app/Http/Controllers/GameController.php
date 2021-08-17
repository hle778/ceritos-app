<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameCreateRequest;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Services\GameService;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\GameCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameCreateRequest $request)
    {
        $request['positions'] = array(['','',''],['','',''],['','','']);
        $game = Game::create($request->all());

        return redirect(route('games.show', $game));
    }

    /**
     * Display the specified resource.
     *
     * \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        $gameService = new GameService($game);

        $turnCounter = $gameService->checkTurn();
        $turn = ((($turnCounter-1) % 2) == 0) ? 'X' : 'O';

        $checkMatrixHorizontal = $gameService->checkMatrixHorizontal($turn);
        $checkMatrixVertical = $gameService->checkMatrixVertical($turn);
        $checkMatrixDiagonal = $gameService->checkMatrixDiagonal($turn);

        $winner = (count($checkMatrixHorizontal) == 3 || count($checkMatrixVertical) == 3 || count($checkMatrixDiagonal) == 3) ? true : false;

        $winnerArray = [];
        if(count($checkMatrixHorizontal) == 3)
            $winnerArray = $checkMatrixHorizontal;
        elseif (count($checkMatrixVertical) == 3)
            $winnerArray = $checkMatrixVertical;
        elseif (count($checkMatrixDiagonal) == 3)
            $winnerArray = $checkMatrixDiagonal;    
            
        return view('game', compact(
            'game',
            'turnCounter',
            'winner',
            'winnerArray'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function play(Request $request)
    {
        $game = Game::with(['player_x', 'player_o'])->where('id', $request->gameId)->firstOrFail();
        $gameService = new GameService($game);
        $turnCounter = $gameService->checkTurn();
        $turn = (($turnCounter % 2) == 0) ? 'X' : 'O';

        $row = $request->row;
        $col = $request->col;

        $positions = $game->positions;
        $positions[$row][$col] = $turn;
        $game->positions = $positions;
        $game->save();

        $checkMatrixHorizontal = $gameService->checkMatrixHorizontal($turn);
        $checkMatrixVertical = $gameService->checkMatrixVertical($turn);
        $checkMatrixDiagonal = $gameService->checkMatrixDiagonal($turn);

        $winner = (count($checkMatrixHorizontal) == 3 || count($checkMatrixVertical) == 3 || count($checkMatrixDiagonal) == 3) ? true : false;
        if ($winner) {
            if (($request->turnCounter % 2) == 0) {
                $game->player_x->gamesWon += 1;
                $game->player_x->save();
            }      
            else {
                $game->player_o->gamesWon += 1;
                $game->player_o->save();
            }
        }

        $winnerArray = [];
        if(count($checkMatrixHorizontal) == 3)
            $winnerArray = $checkMatrixHorizontal;
        elseif (count($checkMatrixVertical) == 3)
            $winnerArray = $checkMatrixVertical;
        elseif (count($checkMatrixDiagonal) == 3)
            $winnerArray = $checkMatrixDiagonal;    

        return response()->json(['game' => $game, 
                                'turnCounter' => $turnCounter,
                                'winner' => $winner,
                                'winnerArray' => $winnerArray]);
    }

    /**
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function restart($id)
    {
        $game = Game::where('id', $id)->firstOrFail();
        $positions = $game->positions;

        for ($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 3; $col++)
                $positions[$row][$col] = '';
        }

        $game->positions = $positions;
        $game->save();

        return redirect(route('games.show', $game));
    }
}
