<?php

namespace App\Interfaces;


// Interface: Menyediakan kontrak atau blueprint yang harus diikuti oleh kelas yang mengimplementasikannya.
use App\Models\RoomChecker;

interface RoomCheckerRepositoryInterface
{
    public function getAll();
    public function getByMonthAndYear($month, $year);
    public function getByDate($date);
    public function getByRoomId($roomId);
    public function getById($id);
    public function store(array $data);
    public function update(array $data, RoomChecker $roomCategory);
    public function delete($id);
}

