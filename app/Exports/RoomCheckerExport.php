<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoomCheckerExport implements FromCollection, WithHeadings
{
    public function __construct($roomChecker)
    {
        $this->roomChecker = $roomChecker;
    }
    public function collection()
    {
        return collect($this->roomChecker)->map(function ($item) {
            return [
                $item->date,
                $item->time,
                $item->room_data->name,
                $item->status,
                $item->user_data->email,
                $item->description,
            ];
        });
    }
    public function headings(): array
    {
        return [
            'Tanggal', 'Jam', 'Nama Ruangan', 'Status', 'Pengguna', 'Deskripsi'
        ];
    }
}
