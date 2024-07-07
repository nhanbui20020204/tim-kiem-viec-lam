<?php

namespace App\Exports;

use App\Models\BangDiem;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BangDiemExport implements FromArray, WithHeadings, WithStyles
{
    use Exportable;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'ma_mon',
            'ten_mon',
            'diem_so',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $backgroundColor = '7367f0';

        $sheet->getStyle('A1:C1')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => $backgroundColor,
                ],
            ],
            'font' => [
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
            ],
        ]);

        return [];
    }
}
