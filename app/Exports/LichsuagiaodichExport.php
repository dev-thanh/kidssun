<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
class LichsuagiaodichExport implements FromArray,WithHeadings,ShouldAutoSize, WithEvents
{
    protected $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function array(): array
    {
        return $this->users;
    }
    public function headings(): array {
        return [
            'THỜI GIAN',
            'LOẠI GIAO DỊCH',
            'MÃ GIAO DỊCH',     
           	'GIÁ TRỊ GIAO DỊCH',
           	'TRẠNG THÁI'
        ];
    }

    // public function map($user): array {
    //     return [
    //         $user['id'],
    //         $user['name'],
    //         $user['email'],
    //         // $user->created_at,
    //         // $user->updated_at
    //     ];
    // }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:E1'; // All headers
                $styleArray = [
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        
                        'startColor' => [
                            'argb' => 'a7a9ac',
                        ],
                        'endColor' => [
                            'argb' => 'a7a9ac',
                        ],
                ]];
                $event->sheet->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getStyle($cellRange)->applyFromArray($styleArray);
            },
        ];
    }
}
