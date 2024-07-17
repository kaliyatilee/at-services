<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\PrintingServices\PrintingSales;

class PrintingExport implements FromCollection, WithHeadings
{
    private $printingSales;

    public function __construct(PrintingSales $printingSales)
    {
        $this->printingSales = $printingSales;
    }

    public function collection()
    {
        $data = [
            [
                'Transaction Date' => $this->printingSales->transaction_date,
                'Description' => $this->printingSales->description,
                'Notes' => $this->printingSales->notes,
                'Full Name' => $this->printingSales->full_name,
                'Phone' => $this->printingSales->phone,
                'Currency' => $this->printingSales->currency,
                'Rate' => $this->printingSales->rate,
                'Amount Paid' => $this->printingSales->amount_paid,
                'Commission' => $this->printingSales->commission,
                'Payment Type' => $this->printingSales->payment_type,
                'Commission USD' => $this->printingSales->commission_usd,
                'Created At' => $this->printingSales->created_at,
            ]
        ];

        return collect($data);
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
}