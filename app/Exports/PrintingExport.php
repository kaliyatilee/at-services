<?php
namespace App\Exports;

use App\Models\PrintingServices\PrintingSales;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PrintingExport implements FromCollection, WithHeadings
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    public function headings(): array
    {
        return [
            'Transaction Date',
            'Description',
            'Notes',
            'Full Name',
            'Phone',
            'Currency',
            'Rate',
            'Amount Paid',
            'Commission',
            'Payment Type',
            'Commission USD',
            'Created At'
        ];
    }

    public function collection()
    {
        return PrintingSales::where('id', $this->id)->get();

    }
}