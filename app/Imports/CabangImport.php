<?php

namespace App\Imports;

use App\Models\data_cabang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CabangImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new data_cabang([
            //
            'cabang' => $row['cabang'],
            'divisi' => $row['divisi'],
            'kode_cabang' => $row['kode_cabang'],
        ]);
    }
}
