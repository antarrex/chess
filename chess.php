<?php
require 'vendor/autoload.php';

use App\Board\Board;
use \App\Storage\FileStorage;
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
type 'exit' to end the game
" . PHP_EOL;

$board = new Board(new FileStorage);

while (true) {
    $board->printState();

    $input = explode(' ', trim(fgets(STDIN, 1024)));

    if (in_array('add', $input)) {
        $board->add($input[1], $input[2]);
    }

    if (in_array('remove', $input)) {
        $board->remove($input[1]);
    }

    if (in_array('move', $input)) {
        $board->move($input[1], $input[2]);
    }

    if (in_array('save', $input)) {
        $board->save();
    }

    if (in_array('load', $input)) {
        $board->load();
    }

    if (in_array('exit', $input)) {
        print 'Bye!' . PHP_EOL;
        break;
    }
}