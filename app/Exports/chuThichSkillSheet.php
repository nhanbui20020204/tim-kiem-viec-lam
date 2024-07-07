<?php

namespace App\Exports;

use App\Models\Skill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class chuThichSkillSheet implements FromCollection, WithTitle, WithStyles
{
    public function title(): string
    {
        return 'Chú thích';
    }

    public function collection()
    {
        $skills = Skill::all();

        $data = $skills->map(function ($skill) {
            return [$skill->id, $skill->ten_skill];
        });

        $data->prepend(['ID', 'Tên Skill']);

        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        $backgroundColor = '7367f0';

        $sheet->getStyle('A1:B1')->applyFromArray([
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
