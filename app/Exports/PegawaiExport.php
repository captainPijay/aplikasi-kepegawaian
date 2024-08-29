<?php

namespace App\Exports;

use App\Models\DataInstansi;
use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PegawaiExport implements FromQuery, WithHeadings, WithMapping, WithStrictNullComparison, WithStyles
{
    protected $status;
    private $counter = 1;
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Pegawai::query();
        if ($this->status == 'jenisKelamin' || 'nik-npwp-email-nohp' || 'estimasi-kenaikan-pangkat' || 'pendidikan') {
            $query = DataInstansi::query();
        }
        return $query;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        if ($this->status === 'nik-npwp-email-nohp') {
            return ['NO', 'NAMA UNIT KERJA', 'NAMA PEGAWAI', 'NIK', 'NPWP', 'EMAIL', 'NO.HP'];
        } elseif ($this->status === 'estimasi-kenaikan-pangkat') {
            return ['NO', 'NAMA UNIT KERJA', 'NAMA PEGAWAI', 'NIP/NIPPPK', 'PANGKAT/GOLONGAN RUANG', 'NAMA JABATAN', 'TMT KENAIKAN PANGKAT', 'ESTIMASI KENAIKAN PANGKAT TGL/BULAN/TAHUN'];
        } elseif ($this->status === 'instansi') {
            return ['NAMA UNIT KERJA', 'PNS', 'PPPK', 'Non ASN', 'JUMLAH'];
        } elseif ($this->status === 'jenisKelamin') {
            return ['NO', 'NAMA UNIT KERJA', 'PRIA', 'WANITA', 'JUMLAH'];
        } elseif ($this->status === 'pendidikan') {
            return [
                'NO',
                'NAMA UNIT KERJA',
                'SD',
                'SLTP',
                'SLTA',
                'D1',
                'D2',
                'D3',
                'D4',
                'S1',
                'S2',
                'S3',
                'JUMLAH'
            ];
        }
    }
    public function styles(Worksheet $sheet)
    {
        // Mendapatkan jumlah kolom berdasarkan jumlah headings
        $headingsCount = count($this->headings());
        $lastColumn = $this->columnIndexToLetter($headingsCount);
        // Mendapatkan jumlah baris berdasarkan query
        $rowCount = $this->query()->count();
        $lastRow = $rowCount + 1; // +1 untuk baris header

        // Rentang yang akan di-style
        $range = 'A1:' . $lastColumn . $lastRow;

        // Menambahkan border pada rentang sel
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // Styling untuk header
        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => ['argb' => 'FFFFFFFF'], // Warna font header
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4F81BD'], // Warna latar belakang header
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // Mengatur lebar kolom otomatis
        foreach (range('A', $lastColumn) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }

    private function columnIndexToLetter($index)
    {
        $letter = '';
        while ($index > 0) {
            $mod = ($index - 1) % 26;
            $letter = chr(65 + $mod) . $letter;
            $index = (int)(($index - $mod) / 26);
        }
        return $letter;
    }


    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        if ($this->status === 'nik-npwp-email-nohp') {
            $results = [];

            foreach ($row->pegawai as $pegawai) {
                $results[] = [
                    $this->counter++,
                    $row->name ?? 'Belum Ada Data',
                    $pegawai->name ?? 'Belum Ada Data', // Nama Instansi
                    $pegawai->nik_number ?? 'Belum Ada Data', // Email
                    $pegawai->npwp_number ?? 'Belum Ada Data', // NIK
                    $pegawai->email ?? 'Belum Ada Data', // NIK
                    $pegawai->phone_number ?? 'Belum Ada Data', // NIK
                ];
            }

            return $results;
        } elseif ($this->status === 'estimasi-kenaikan-pangkat') {
            $results = [];

            foreach ($row->pegawai as $pegawai) {
                $results[] = [
                    $this->counter++,
                    $row->name ?? 'Belum Ada Data',
                    $pegawai->name ?? 'Belum Ada Data', // Nama Instansi
                    $pegawai->username ?? 'Belum Ada Data', // Email
                    $pegawai->kepangkatan ?? 'Belum Ada Data', // NIK
                    $pegawai->jabatan->jabatan_name ?? 'Belum Ada Data', // NIK
                    '-',
                    '-',
                ];
            }

            return $results;
        } elseif ($this->status === 'instansi') {
            return [
                $row->name,
                $row->pegawai->where('employee_type', 'PNS')->count(),
                $row->pegawai->where('employee_type', 'PPPK')->count(),
                $row->pegawai->where('employee_type', 'Non ASN')->count(),
                $row->pegawai->count(),
            ];
        } elseif ($this->status === 'jenisKelamin') {
            return [
                $this->counter++,
                $row->name,
                $row->pegawai->where('gender', 'Laki-Laki')->count(),
                $row->pegawai->where('gender', 'Perempuan')->count(),
                $row->pegawai->count(),
            ];
        } elseif ($this->status === 'pendidikan') {
            return [
                $this->counter++,
                $row->name,
                $row->pegawai->where('pendidikan.jenjang', 'SD')->count(),
                $row->pegawai->where('pendidikan.jenjang', 'SLTP')->count(),
                $row->pegawai->where('pendidikan.jenjang', 'SLTA')->count(),
                $row->pegawai->where('pendidikan.jenjang', 'D1')->count(),
                $row->pegawai->where('pendidikan.jenjang', 'D2')->count(),
                $row->pegawai->where('pendidikan.jenjang', 'D3')->count(),
                $row->pegawai->where('pendidikan.jenjang', 'D4')->count(),
                $row->pegawai->where('pendidikan.jenjang', 'S1')->count(),
                $row->pegawai->where('pendidikan.jenjang', 'S2')->count(),
                $row->pegawai->where('pendidikan.jenjang', 'S3')->count(),
                $row->pegawai->count(),
            ];
        }
    }
}
