<?php

namespace App\Imports;

use App\Models\tb_auditor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AuditorImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new tb_auditor([
            //
            'name' => $row['name'],
            'nik' => $row['nik'],
            'dept' => $row['dept'],
            'jabatan' => $row['jabatan'],
            'id_cabang' => $row['id_cabang'],
        ]);
    }
}
