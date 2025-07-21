<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Siswa([
            'nama'               => $row['nama'],
            'nis'                => $row['nis'],
            'email'              => $row['email'],
            'nama_ortu'     => $row['nama_ortu'],
            'jenis_kelamin'      => $row['jenis_kelamin'],
            'tempat_lahir'       => $row['tempat_lahir'],
            'telepon_ortu'  => $row['telepon_ortu'],
            'alamat'             => $row['alamat'],
            'rombel_id'          => $row['rombel_id'],
            'jurusan_id'         => $row['jurusan_id'],
            'tahun_ajaran_id'    => $row['tahun_ajaran_id'],
            'agama'              => $row['agama'],
            'telepon'            => $row['telepon'], 
            'tanggal_lahir'      => $row['tanggal_lahir'],
        ]);
    }
}
