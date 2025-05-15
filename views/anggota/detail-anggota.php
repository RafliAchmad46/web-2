<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Anggota.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$anggota = new Anggota($db);

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: " . BASE_URL . "/views/anggota/list-anggota.php");
    exit;
}

$id = $_GET['id'];
$data = $anggota->readOne($id);

if (!$data) {
    // Jika data tidak ditemukan, redirect ke list
    header("Location: " . BASE_URL . "/views/anggota/list-anggota.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detail Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= BASE_URL ?>/public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include __DIR__ . '/../partials/header.php'; ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Detail Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/anggota/list-anggota.php">Anggota</a>
                        </li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-info-circle me-1"></i> Informasi Detail Anggota
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID Anggota</th>
                                    <td><?= htmlspecialchars($data['id']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Pegawai</th>
                                    <td><?= htmlspecialchars($data['pegawai_nama']) ?></td>
                                </tr>
                                <tr>
                                    <th>Kartu Diskon</th>
                                    <td><?= htmlspecialchars($data['kartu_nama']) ?></td>
                                </tr>
                                <tr>
                                    <th>Status Aktif</th>
                                    <td><?= $data['status_aktif'] ? 'Aktif' : 'Tidak Aktif' ?></td>
                                </tr>
                            </table>
                            <a href="<?= BASE_URL ?>/views/anggota/list-anggota.php"
                                class="btn btn-primary mt-3">Kembali ke List</a>
                        </div>
                    </div>
                </div>
            </main>
            <?php include __DIR__ . '/../partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="<?= BASE_URL ?>/public/js/scripts.js"></script>
</body>

</html>