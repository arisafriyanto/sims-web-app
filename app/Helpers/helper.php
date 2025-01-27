<?php

if (!function_exists('formatRupiah')) {
    /**
     * Format angka menjadi format Rupiah.
     *
     * @param  float|int  $angka
     * @return string
     */
    function formatRupiah($angka)
    {
        return number_format($angka, 0, ',', ',');
    }
}
