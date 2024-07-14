<?php

namespace App\Exports;

use App\Models\VehicleLicenceTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehicleLicenceTransactionsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return VehicleLicenceTransaction::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Date of Transaction',
            'Name',
            'Phone',
            'Currency',
            'Rate',
            'Registration Number',
            'Expiry Date',
            'Transaction Type',
            'Vehicle Class',
            'Amount Paid ZIG',
            'Amount Paid USD',
            'Expected Amount ZIG',
            'Expected Amount USD',
            'Created By',
            'Created At',
            'Updated At',
        ];
    }
}
