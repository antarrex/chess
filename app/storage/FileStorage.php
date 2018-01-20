<?php
namespace App\Storage;

class FileStorage implements StorageInterface {
    public function save($data)
    {
        file_put_contents('board_state.txt', $data);
    }

    public function load()
    {
        if($data = file_get_contents('board_state.txt')) {
            return $data;
        }
        throw new \Exception('File not found');
    }
}