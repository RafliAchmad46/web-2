<?php

// megambil data dari file data-form-regis.php
require_once "data-form-regis.php";

// Mendapatkan data dari form
$nim = $_POST['nim'];
$nama = $_POST['nama_lengkap'];
$jk = $_POST['jenis_kelamin'];
$prodi = $_POST['program_studi'];
$skill_pilihan = $_POST['skills'];
$domisili = $_POST['domisili'];
$email = $_POST['email'];

// Menghitung skor skill dan kategori skill
$skor_skill = skor_skill($skill_pilihan, $ar_skill);
$kategori_skill = kategori_skill($skor_skill);

// Fungsi untuk menghitung skor skill
function skor_skill($skill_pilihan, $ar_skill)
{
    $skor = 0;

    foreach ($skill_pilihan as $skill) {
        if (isset($ar_skill[$skill])) {
            $skor += $ar_skill[$skill]; // Menambah nilai dari skill yang dipilih
        }
    }

    return $skor;
}

// Fungsi untuk menentukan kategori skill berdasarkan skor
function kategori_skill($skor_skill)
{
    if ($skor_skill <= 0) {
        return "Tidak Ada";
    } elseif ($skor_skill <= 40) {
        return "Kurang";
    } elseif ($skor_skill <= 60) {
        return "Cukup";
    } elseif ($skor_skill <= 100) {
        return "Baik";
    } elseif ($skor_skill <= 150) {
        return "Sangat Baik";
    } else {
        return "Tidak Terkategori";
    }
}

?>