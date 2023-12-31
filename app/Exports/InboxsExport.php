<?php

namespace App\Exports;

use App\Models\Inbox;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class InboxsExport implements  FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    public function collection()
    {
        return Inbox::select('name', 'email', 'phone',  'status', 'created_at')->get();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'phone',
            'status 1- Mean Done',
            'Created At ',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
