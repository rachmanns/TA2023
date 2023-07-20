<?php

use Carbon\Carbon;

function explode_data_kegiatan_duk($data)
{
    $data = explode('_', $data);
    $string = '';
    foreach ($data as $key => $value) {

        $string .= $value . '<br>';
    }
    return $string;
}

function indonesian_date_format($date)
{
    return Carbon::parse($date)->locale('id')->isoFormat('D MMMM YYYY');
}

function tahun_patubel($tahun_ajaran)
{
    return str_replace(' ', '', substr($tahun_ajaran, strpos($tahun_ajaran, "-") + 1));
}

function indonesian_money_format($angka)
{
    return number_format($angka, 2, ',', '.');
}
