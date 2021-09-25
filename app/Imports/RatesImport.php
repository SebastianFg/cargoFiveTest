<?php

namespace App\Imports;

use App\Rate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RatesImport implements ToModel,WithStartRow
{

    public function  __construct($id)
    {
        $this->contract_id= $id;
    }
    /**
    * @param array $row
    * @param integer $id
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rate([
            'origin' =>$row['0'],
            'destination' => $row['1'],
            'currency' => $row['4'],
            'twenty' => $row['5'],
            'forty' => $row['6'],
            'fortyhc' => $row['7'],
            'contract_id' => $this->contract_id,
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
