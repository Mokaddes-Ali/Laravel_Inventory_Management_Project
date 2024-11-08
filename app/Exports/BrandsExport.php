<?php

namespace App\Exports;

use App\Models\Brands;
use Maatwebsite\Excel\Concerns\FromCollection;

class BrandsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Brands::all();
    }
}
