<?php

namespace App\Imports;

use App\Models\tb_auditee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AuditeeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new tb_auditee([
            //
            'name' => $row['name'],
            'nik' => $row['nik'],
            'dept' => $row['dept'],
            'jabatan' => $row['jabatan'],
            'id_cabang' => $row['id_cabang'],
        ]);
    }
}
