<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\NewsletterSubscriber;

class subscribersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // For Exporting complete table 
        // return NewsletterSubscriber::all();

        // For Exporting selected columns
        
        $subscribersData = NewsletterSubscriber::select('id', 'email', 'created_at')->where('status', 1)
        ->orderBy('id', 'Desc')->get();
        return $subscribersData;
    }

    public function headings(): array{
        return ['Id', 'Email', 'Subscribed on'];
    }
}
