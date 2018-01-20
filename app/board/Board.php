<?php
namespace App\Board;

use App\Pieces\Piece;
use App\Storage\StorageInterface;

class Board
{
    const DEFAULT_SIZE = 8;

    private $size;
    private $occupiedCells = [];
    private $storage;

    public function __construct(StorageInterface $storage, $size = self::DEFAULT_SIZE)
    {
        $this->size = $size;
        $this->storage = $storage;
    }

    public function add($name, $coords)
    {
        try {
            $this->validateCoords($coords);
        } catch (\Exception $e) {
            echo "Error: {$e->getMessage()}" . PHP_EOL;
            return;
        }

        $cell = new Cell($coords);
        $cell->attach(new Piece($name));
        $this->occupiedCells[$coords] = $cell;
    }

    public function remove($coords)
    {
        $this->occupiedCells[$coords] = null;
    }

    public function validateCoords($coords)
    {
        if (array_key_exists($coords, $this->occupiedCells)) {
            throw new \Exception('This cell is already occupied!');
        }

        $letters = 'abcdefghijklmnoqrstuvwxyz';
        $pattern = "/^[a-{$letters[$this->size - 1]}][1-{$this->size}]$/i";
        preg_match($pattern, $coords, $matches);
        if (!$matches) {
            throw new \Exception('Entered cell is out of board range');
        }
    }

    public function printState()
    {
        if (empty($this->occupiedCells)) {
            print 'Board is empty' . PHP_EOL;
            return;
        }

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