<?php

namespace App\Exceptions;

use Exception;

class NotFound extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => 'Tidak ada data yang ditemukan!'
        ]);
    }
}
