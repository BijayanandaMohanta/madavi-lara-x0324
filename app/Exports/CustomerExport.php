<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class CustomerExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $customers = Customer::select(['id', 'name', 'email', 'mobile', 'created_at', 'otp_status'])
            ->get();
            
        return $customers;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Mobile',
            'Date',
            'Status',
        ];
    }
}
