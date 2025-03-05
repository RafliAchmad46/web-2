<?php

// Mengambil data dari form
$proses = isset($_POST['proses']) ? $_POST['proses'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$matkul = isset($_POST['matkul']) ? $_POST['matkul'] : '';
$nilai_uts = isset($_POST['nilai_uts']) ? floatval($_POST['nilai_uts']) : 0; // Mengonversi ke float
$nilai_uas = isset($_POST['nilai_uas']) ? floatval($_POST['nilai_uas']) : 0; // Mengonversi ke float
$nilai_tugas = isset($_POST['nilai_tugas']) ? floatval($_POST['nilai_tugas']) : 0; // Mengonversi ke float

if (!empty($proses)) {
    // Menampilkan data yang diterima
    echo 'Proses : ' . $proses;
    echo '<br/>Nama : ' . $nama;
    echo '<br/>Mata Kuliah : ' . $matkul;
    echo '<br/>Nilai UTS : ' . $nilai_uts;
    echo '<br/>Nilai UAS : ' . $nilai_uas;
    echo '<br/>Nilai Tugas : ' . $nilai_tugas;

    // Menghitung nilai total
    $total_nilai = (0.3 * $nilai_uts) + (0.35 * $nilai_uas) + (0.35 * $nilai_tugas);

    // Menentukan kelulusan
    if ($total_nilai > 55) {
        echo '<br/>Siswa dinyatakan LULUS dengan nilai total: ' . number_format($total_nilai, 2);
    } else {
        echo '<br/>Siswa dinyatakan TIDAK LULUS dengan nilai total: ' . number_format($total_nilai, 2);
    }

    // Menentukan grade
    if ($total_nilai < 0 || $total_nilai > 100) {
        $grade = 'I'; // Tidak ada
    } else if ($total_nilai >= 0 && $total_nilai <= 35) {
        $grade = 'E'; // Sangat kurang
    } else if ($total_nilai >= 36 && $total_nilai <= 55) {
        $grade = 'D'; // Kurang
    } else if ($total_nilai >= 56 && $total_nilai <= 70) {
        $grade = 'C'; // Cukup
    } else if ($total_nilai >= 71 && $total_nilai <= 85) {
        $grade = 'B'; // Memuaskan
    } else if ($total_nilai >= 86 && $total_nilai <= 100) {
        $grade = 'A'; // Sangat memuaskan
    } else {
        $grade = 'I'; // Untuk kasus yang tidak terduga
    }

    // Menggunakan switch untuk mencetak predikat
    switch ($grade) {
        case 'I':
            $predikat = 'Tidak ada';
            break;
        case 'E':
            $predikat = 'Sangat kurang';
            break;
        case 'D':
            $predikat = 'Kurang';
            break;
        case 'C':
            $predikat = 'Cukup';
            break;
        case 'B':
            $predikat = 'Memuaskan';
            break;
        case 'A':
            $predikat = 'Sangat memuaskan';
            break;
        default:
            $predikat = 'Tidak ada';
            break;
    }

    echo '<br/>Grade: ' . $grade . ' - ' . $predikat;
} else {
    echo 'Silakan kirim data melalui form.';
}
?>


