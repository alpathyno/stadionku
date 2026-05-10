<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Transaksi::with(['tiket.pertandingan', 'tiket.penonton'])
                    ->orderBy('tgl_transaksi', 'desc');

        if (!empty($this->filters['tanggal_dari'])) {
            $query->whereDate('tgl_transaksi', '>=', $this->filters['tanggal_dari']);
        }
        if (!empty($this->filters['tanggal_sampai'])) {
            $query->whereDate('tgl_transaksi', '<=', $this->filters['tanggal_sampai']);
        }
        if (!empty($this->filters['status']) && $this->filters['status'] !== 'semua') {
            $query->where('status_bayar', $this->filters['status']);
        }
        if (!empty($this->filters['metode']) && $this->filters['metode'] !== 'semua') {
            $query->where('metode_bayar', $this->filters['metode']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Tiket',
            'Nama Penonton',
            'Email',
            'Pertandingan',
            'Tanggal Pertandingan',
            'Metode Bayar',
            'Total Bayar',
            'Status',
            'Tanggal Transaksi',
        ];
    }

    public function map($t): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $t->tiket->kode_tiket ?? '-',
            $t->tiket->penonton->name ?? '-',
            $t->tiket->penonton->email ?? '-',
            ($t->tiket->pertandingan->tim_tuan_rumah ?? '-') . ' vs ' . ($t->tiket->pertandingan->tim_tamu ?? '-'),
            $t->tiket->pertandingan->tanggal_pertandingan ?? '-',
            $t->metode_bayar,
            'Rp ' . number_format($t->total_bayar, 0, ',', '.'),
            $t->status_bayar,
            $t->tgl_transaksi,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}