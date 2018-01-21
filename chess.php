<?php
require 'vendor/autoload.php';

use App\App;
use App\Board\Board;
use \App\Storage\FileStorage;

$board = new Board(new FileStorage);
$app = new App($board);

$app->showWelcomeMessage();

while (true) {
    $input = explode(' ', trim(fgets(STDIN, 1024)));

    $app->handleInput($input);
}