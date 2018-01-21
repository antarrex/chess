<?php
namespace App\Board;

use App\Pieces\Piece;

class Cell
{
    protected $coords;
    protected $piece;

    public function __construct($coords)
    {
        $this->coords = strtoupper($coords);
    }

    public function __toString()
    {
        return $this->getPiece() . ' at ' . $this->getCoords() . PHP_EOL;
    }

    public function attach(Piece $piece)
    {
        $this->piece = $piece;
    }

    public function getCoords()
    {
        return $this->coords;
    }

    public function setCoords($coords)
    {
        return $this->coords = $coords;
    }

    public function getPiece()
    {
        return $this->piece->getName();
    }
}