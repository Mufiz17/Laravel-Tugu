<?php

namespace App\Absen\Commands;

use App\Interfaces\Services\AbsenService;
use App\Models\Absen;

class UpdateData
{
    public function __construct(
        private AbsenService $service
    ) {}

    public function execute(int $id, array $data): ?Absen
    {
        return $this->service->UpdateAbsen($id, [
            'nama' => $data['nama'],
            'divisi' => $data['divisi'],
            'keterangan' => $data['keterangan']
        ]);
    }
}
