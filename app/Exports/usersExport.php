<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\User;

class usersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // For Exporting Complete table
        return User::all();
    }

    public function headings(): array {
        ['Id', 'Name', 'Address', 'City', 'State', 'Country', 'Pincode', 'Mobile', 'Email', 'Registered on'];
    }
}
