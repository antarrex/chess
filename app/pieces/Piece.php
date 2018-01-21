<?php
namespace App\Pieces;

class Piece
{
    protected $allowedNames = [
        'king',
        'queen',
        'rook',
        'bishop',
        'knight',
        'pawn'
    ];
    protected $name;

    public function __construct($name)
    {
        if (!in_array(strtolower($name), $this->allowedNames)) {
            throw new \Exception('Not allowed piece name');
        }
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}