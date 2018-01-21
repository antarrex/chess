<?php
namespace App\Board;

use App\Pieces\Piece;
use App\Storage\StorageInterface;

class Board
{
    const DEFAULT_SIZE = 8;

    private $size;
    private $storage;
    private $occupiedCells = [];

    public function __construct(StorageInterface $storage, $size = self::DEFAULT_SIZE)
    {
        $this->storage = $storage;
        $this->size = $size;
    }

    public function add($name, $coords)
    {
        try {
            if (array_key_exists($coords, $this->occupiedCells)) {
                throw new \Exception('This cell is already occupied!');
            }
            $this->validateCoords($coords);
        } catch (\Exception $e) {
            echo "Error: {$e->getMessage()}" . PHP_EOL;
            return;
        }

        $cell = new Cell($coords);
        try {
            $piece = new Piece($name);
        } catch (\Exception $e) {
            echo "Error: {$e->getMessage()}" . PHP_EOL;
            return;
        }
        $cell->attach($piece);
        $this->occupiedCells[$coords] = $cell;
    }

    public function move($from, $to)
    {
        try {
            $this->validateCoords($to);
        } catch (\Exception $e) {
            echo "Error: {$e->getMessage()}" . PHP_EOL;
            return;
        }

        $this->occupiedCells[$to] = clone $this->occupiedCells[$from];
        $this->occupiedCells[$to]->setCoords($to);
        unset($this->occupiedCells[$from]);
    }

    public function remove($coords)
    {
        try {
            $this->validateCoords($coords);
        } catch (\Exception $e) {
            echo "Error: {$e->getMessage()}" . PHP_EOL;
            return;
        }
        $this->occupiedCells[$coords] = null;
    }

    public function validateCoords($coords)
    {
        $letters = 'abcdefghijklmnoqrstuvwxyz';
        $pattern = "/^([a-z])([0-9]+)$/i";
        preg_match($pattern, $coords, $matches);

        if (!$matches) {
            throw new \Exception('Invalid input');
        }
        if ($matches[1] > $letters[$this->size - 1] ||
            $matches[2] > $this->size) {
            throw new \Exception('Entered cell is out of board range');
        }
    }

    public function printState()
    {
        print 'Current board state:' . PHP_EOL;
        foreach ($this->occupiedCells as $cell) {
            print $cell;
        }
    }

    public function save()
    {
        $data = [];
        foreach ($this->occupiedCells as $cell) {
            $data[$cell->getCoords()] = $cell->getPiece();
        }
        $this->storage->save(json_encode($data));
    }

    public function load()
    {
        $this->occupiedCells = [];
        $data = json_decode($this->storage->load());
        foreach ($data as $coords => $name) {
            $this->add($name, $coords);
        }
    }
}