<?php

namespace App\Imports;

use App\Models\SchoolClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SchoolClassImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SchoolClass([
            'year'    => $row['year'],
            'section' => $row['section'],
            'course'  => $row['course'],
            'site_id' => $row['site_id'],
        ]);
    }
}
