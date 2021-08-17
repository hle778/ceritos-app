<?php

namespace App\Services;
use App\Models\Game;

class GameService
{
    private $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    /**
     * Método que recorre la matrix horizontalmente para saber si el jugador ha ganado.
     *
     * @param turn
     * @return array
     */
    public function checkMatrixHorizontal($turn)
    {
        $winnerArray = [];

        for ($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 3; $col++) {
                if ($this->game->positions[$row][$col] === $turn)
                    array_push($winnerArray, "$row$col");
            }

            if (count($winnerArray) == 3)
                break;
            else
                $winnerArray = [];
        }

        return $winnerArray;
    }

    /**
     * Método que recorre la matrix verticalmente para saber si el jugador ha ganado.
     *
     * @param turn
     * @return array
     */
    public function checkMatrixVertical($turn)
    {
        $winnerArray = [];

        for ($col = 0; $col < 3; $col++) {
            for ($row = 0; $row < 3; $row++) {
                if ($this->game->positions[$row][$col] === $turn)
                    array_push($winnerArray, "$row$col");
            }

            if (count($winnerArray) == 3)
                break;
            else
                $winnerArray = [];
        }

        return $winnerArray;
    }

    /**
     * Método que recorre la matrix en diagonal para saber si el jugador ha ganado.
     *
     * @param turn
     * @return array
     */
    public function checkMatrixDiagonal($turn)
    {
        $winnerArray = [];

        for ($i = 0; $i < 3; $i++) {//left diagonal
            if ($this->game->positions[$i][$i] === $turn)
                array_push($winnerArray, "$i$i");
        }

        if (count($winnerArray) != 3) {
            $winnerArray = [];
            $j = 2;
            for ($i = 0; $i < 3; $i++) {//right diagonal
                if ($this->game->positions[$i][$j] === $turn)
                    array_push($winnerArray, "$i$j");
                $j--;
            }
        }

        return $winnerArray;
    }

    /**
     * Método que devuelve la cantidad de casillas marcadas.
     *
     * @param turn
     * @return int
     */
    public function checkTurn()
    {
        $count = 0;
        for ($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 3; $col++) {
                if (trim($this->game->positions[$row][$col]) != '')
                    $count++;
            }
        }

        return $count;
    }
}
