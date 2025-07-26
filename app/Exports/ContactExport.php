<?php

namespace App\Exports;

use App\Contact;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch the data
        $data = Contact::select('first_name','last_name','mobile_no','email','message','created_at')
            ->get();

        // Add a row number to each item
        $dataWithRowNumber = $data->map(function ($item, $index) {
            return [
                'No.' => $index + 1, // Add row number
                'Name' => $item->first_name . ' ' . $item->last_name,
                'Mobile' => $item->mobile_no,
                'Email' => $item->email,
                'Message' => $item->message,
                'DateTime' => $item->created_at,
            ];
        });

        return $dataWithRowNumber;
    }

    public function headings(): array
    {
        return [
            'No.', // Add header for row number
            'Name',
            'Mobile','Email','Message','DateTime',
        ];
    }
}