<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class sinhVienExport implements FromCollection, WithHeadings, WithMapping, WithMultipleSheets, WithStyles
{
    protected $students;

    public function __construct($students)
    {
        $this->students = collect($students);
    }

    public function collection()
    {
        return $this->students;
    }

    public function headings(): array
    {
        return [
            'Tên sinh viên',
            'Mã sinh viên',
            'Email',
            'Lớp cố vấn',
            'Số điện thoại',
            'Địa chỉ',
            'Khoa',
            'Ngành',
            'Điểm trung bình',
            'List skill',
        ];
    }

    public function map($student): array
    {
        return [
            $student['ten_sinh_vien'],
            $student['mssv'],
            $student['email'],
            $student['lop_co_van'],
            $student['so_dien_thoai'],
            $student['dia_chi'],
            $student['khoa'],
            $student['nganh'],
            $student['diem_trung_binh'],
            implode(',', $student['list_skills']),
        ];
    }

    public function sheets(): array
    {
        return [
            'students' => $this,
            'chu_thich' => new chuThichSkillSheet(),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $backgroundColor = '7367f0';

        $sheet->getStyle('A1:J1')->applyFromArray([
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
