<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Pesanan.php';
require_once __DIR__ . '/../../config/config.php';

// Koneksi & inisialisasi model
$db = Database::getInstance()->getConnection();
$pesananModel = new Pesanan($db);

// Ambil ID dari parameter GET
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: ' . BASE_URL . '/views/pesanan/list-pesanan.php');
    exit;
}

// Ambil data berdasarkan ID
$pesanan = $pesananModel->readOne($id);
if (!$pesanan) {
    header('Location: ' . BASE_URL . '/views/pesanan/list-pesanan.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detail Pesanan</title>
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
                    <h1 class="mt-4">Pesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/pesanan/list-pesanan.php">Pesanan</a>
                        </li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-file-invoice me-1"></i> Informasi Detail Pesanan
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID Pesanan</th>
                                    <td><?= htmlspecialchars($pesanan['id']) ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td><?= htmlspecialchars($pesanan['tanggal']) ?></td>
                                </tr>
                                <tr>
                                    <th>Diskon</th>
                                    <td><?= htmlspecialchars($pesanan['diskon']) ?>%</td>
                                </tr>
                                <tr>
                                    <th>Status Bayar</th>
                                    <td>
                                        <?php
                                            switch ($pesanan['status_bayar']) {
                                                case 1:
                                                    echo '<span class="badge bg-success">Lunas</span>';
                                                    break;
                                                case 0:
                                                    echo '<span class="badge bg-danger">Belum Lunas</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge bg-secondary">Tidak Diketahui</span>';
                                                    break;
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nama Anggota</th>
                                    <td><?= htmlspecialchars($pesanan['anggota_nama']) ?></td>
                                </tr>
                            </table>
                            <a href="<?= BASE_URL ?>/views/pesanan/list-pesanan.php"
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="<?= BASE_URL ?>/public/js/datatables-simple-demo.js"></script>
</body>

</html>