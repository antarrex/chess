<?php
namespace App;

use App\Board\Board;

class App
{
    private $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function handleInput($input)
    {
        if (in_array('add', $input)) {
            $this->board->add($input[1], $input[2]);
        }

        if (in_array('remove', $input)) {
            $this->board->remove($input[1]);
        }

        if (in_array('move', $input)) {
            $this->board->move($input[1], $input[2]);
        }

        if (in_array('save', $input)) {
            $this->board->save();
        }

        if (in_array('load', $input)) {
            $this->board->load();
        }

        $this->board->printState();
    }

    public function showWelcomeMessage()
    {
        echo "
        Welcome to console chess board!
        Allowed piece names:
            'king',
            'queen',
            'rook',
            'bishop',
            'knight',
            'pawn'
        Available commands:
        add <piece> <cell>
        example - 'add bishop A1'

        remove <cell>'
        example - 'remove A1'

        move <cell_from> <cell_to>
        example - 'move A1 C3'

        save - saves current board state
        load - load last saved state
        press CTRL+Z to end the game
        " . PHP_EOL;
    }
}