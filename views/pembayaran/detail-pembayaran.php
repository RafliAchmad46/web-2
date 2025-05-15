<?php
include_once 'config/database.php';
include_once 'models/Pembayaran.php';

if (!isset($_GET['id'])) {
    die("ID pembayaran tidak ditemukan");
}

$database = new Database();
$db = $database->getConnection();

$pembayaran = new Pembayaran($db);
$data = $pembayaran->readOne($_GET['id']);

if (!$data) {
    die("Pembayaran tidak ditemukan");
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detail Pembayaran</title>
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
                    <h1 class="mt-4">Detail Pembayaran</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-pembayaran.php">Pembayaran</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-credit-card me-1"></i> Informasi Pembayaran
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID Pembayaran</th>
                                    <td><?= htmlspecialchars($data['id']) ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Bayar</th>
                                    <td>Rp <?= number_format($data['jumlah_bayar'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Bayar</th>
                                    <td><?= htmlspecialchars($data['tanggal']) ?></td>
                                </tr>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <td>
                                        <a href="detail-pesanan.php?id=<?= htmlspecialchars($data['pesanan_id']) ?>">
                                            #<?= htmlspecialchars($data['pesanan_id']) ?> -
                                            <?= htmlspecialchars($data['tanggal_pesanan']) ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kode Diskon</th>
                                    <td><?= htmlspecialchars($data['kode_diskon'] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <th>Persen Diskon</th>
                                    <td><?= isset($data['persen_diskon']) ? htmlspecialchars($data['persen_diskon']) . '%' : '-' ?>
                                    </td>
                                </tr>
                            </table>
                            <a href="list-pembayaran.php" class="btn btn-primary mt-3">Kembali ke List Pembayaran</a>
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