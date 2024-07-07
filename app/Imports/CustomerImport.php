<?php

namespace App\Imports;

use App\Models\BangDiem;
use App\Models\SinhVien;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $sinhVien = Auth::guard('sinhvien')->user();
        foreach ($rows as $row) {
            $diem = $row['diem_so'];
            $diem_chu = 'F';

            if ($diem > 9.6) {
                $diem_chu = "A+";
            } elseif ($diem > 8.5) {
                $diem_chu = "A";
            } elseif ($diem > 8.0) {
                $diem_chu = "A-";
            } elseif ($diem > 7.5) {
                $diem_chu = "B+";
            } elseif ($diem > 7.0) {
                $diem_chu = "B";
            } elseif ($diem > 6.5) {
                $diem_chu = "B-";
            } elseif ($diem > 6.0) {
                $diem_chu = "C+";
            } elseif ($diem > 5.5) {
                $diem_chu = "C";
            } elseif ($diem > 5.0) {
                $diem_chu = "C-";
            } elseif ($diem > 4.5) {
                $diem_chu = "D";
            } else {
                $diem_chu = "F";
            }
            $bang_diem = BangDiem::where('ten_mon', $row['ten_mon'])->where('id_sinh_vien', $sinhVien->id)->first();
            if ($bang_diem) {
                $bang_diem->update([
                    'id_sinh_vien'  => $sinhVien->id,
                    'ma_mon' => $row['ma_mon'],
                    'diem_so' => $row['diem_so'],
                    'diem_chu' => $diem_chu,
                ]);
            } else {
                BangDiem::create([
                    'id_sinh_vien'  => $sinhVien->id,
                    'ma_mon' => $row['ma_mon'],
                    'ten_mon' => $row['ten_mon'],
                    'diem_so' => $row['diem_so'],
                    'diem_chu' => $diem_chu,
                ]);
            }
        }
    }
}
