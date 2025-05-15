<?php
require_once __DIR__ . '/../../config/config.php';
?>

<div class="nav">
    <div class="sb-sidenav-menu-heading">Main</div>
    <a class="nav-link" href="<?= BASE_URL ?>/views/dashboard.php">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>/views/pegawai/list-pegawai.php">
        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
        Pegawai
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>/views/anggota/list-anggota.php">
        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
        Anggota
    </a>
    <div class="sb-sidenav-menu-heading">Aktifitas</div>
    <a class="nav-link" href="<?= BASE_URL ?>/views/jenis_produk/list-jenis_produk.php">
        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
        Jenis Produk
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>/views/produk/list-produk.php">
        <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
        Produk
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>/views/pesanan/list-pesanan.php">
        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
        Pesanan
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>/views/kartu_diskon/list-kartu_diskon.php">
        <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
        Kartu Diskon
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>/views/pembayaran/list-pembayaran.php">
        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
        Pembayaran
    </a>
</div>