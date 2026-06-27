<?php
/**
 * Mengubah tanggal format YYYY-MM-DD menjadi format Indonesia.
 */
function tgl_indo(string $tanggal): string
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];

    $bagian = explode('-', $tanggal);
    if (count($bagian) !== 3) {
        return $tanggal;
    }

    return (int) $bagian[2] . ' ' . $bulan[(int) $bagian[1]] . ' ' . $bagian[0];
}

