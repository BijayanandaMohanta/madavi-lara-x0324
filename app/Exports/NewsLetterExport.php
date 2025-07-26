<?php

namespace App\Exports;

use App\Newsletter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NewsLetterExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Newsletter::select(['id', 'email'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Email',
        ];
    }
}
