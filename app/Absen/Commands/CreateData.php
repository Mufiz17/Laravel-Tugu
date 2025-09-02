<?php

namespace App\Absen\Commands;

use App\Interfaces\Services\AbsenService;

class CreateData
{
    public function __construct(
        private AbsenService $service
    ) {}

    public function execute(array $data)
    {
        return $this->service->createAbsen([
            'nama' => $data['nama'],
            'divisi' => $data['divisi'],
            'keterangan' => $data['keterangan']
        ]);
    }
}
