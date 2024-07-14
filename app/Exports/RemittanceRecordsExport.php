<?php

namespace App\Exports;

use App\Models\RemittanceRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RemittanceRecordsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return RemittanceRecord::all(); // Get all records
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Date of Remittance',
            'Method of Remittance',
            'Amount Remitted ZIG',
            'Amount Remitted USD',
            'Account Balance ZIG',
            'Account Balance USD',
            'Created At',
            'Updated At',
        ];
    }
}
