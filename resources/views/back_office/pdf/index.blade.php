<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>-</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid black;
            padding: 4px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .second-row{
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>REKAPITULASI DATA KEPEGAWAIAN BERDASARKAN GOLONGAN</h3>
        <h3>DINAS KESEHATAN KABUPATEN BENGKULU UTARA</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th rowspan="3">NO</th>
                <th rowspan="3">NAMA UNIT KERJA</th>
                <th colspan="17">MENURUT GOLONGAN ATAU RUANG</th>
                <th rowspan="3">JUMLAH</th>
            </tr>
            <tr class="second-row">
                <th colspan="4">I</th>
                <th colspan="4">II</th>
                <th colspan="4">III</th>
                <th colspan="5">IV</th>
            </tr>
            <tr>
                <th>a</th>
                <th>b</th>
                <th>c</th>
                <th>d</th>
                <th>a</th>
                <th>b</th>
                <th>c</th>
                <th>d</th>
                <th>a</th>
                <th>b</th>
                <th>c</th>
                <th>d</th>
                <th>a</th>
                <th>b</th>
                <th>c</th>
                <th>d</th>
                <th>e</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'I-A')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'I-B')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'I-C')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'I-D')->where('employee_type', 'PNS')->count() }}</td>

                    <td>{{ $item->pegawai->where('golongan_awal', 'II-A')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'II-B')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'II-C')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'II-D')->where('employee_type', 'PNS')->count() }}</td>

                    <td>{{ $item->pegawai->where('golongan_awal', 'III-A')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'III-B')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'III-C')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'III-D')->where('employee_type', 'PNS')->count() }}</td>

                    <td>{{ $item->pegawai->where('golongan_awal', 'IV-A')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'IV-B')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'IV-C')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'IV-D')->where('employee_type', 'PNS')->count() }}</td>
                    <td>{{ $item->pegawai->where('golongan_awal', 'IV-E')->where('employee_type', 'PNS')->count() }}</td>

                    <td>{{ $item->pegawai->where('golongan_awal', true)->where('employee_type', 'PNS')->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
