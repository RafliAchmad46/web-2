<?php
include_once __DIR__ . '/../../config/database.php';
include_once __DIR__ . '/../../models/Pembayaran.php';

$database = Database::getInstance();
$db = $database->getConnection();

$pembayaran = new Pembayaran($db);
$stmt = $pembayaran->read();

$showSuccessPopup = false;
if (isset($_GET['bayar']) && $_GET['bayar'] == '1') {
    $showSuccessPopup = true;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Daftar Pembayaran</title>
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
                    <h1 class="mt-4">Pembayaran</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Pembayaran</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-credit-card me-1"></i> Daftar Pembayaran
                        </div>
                        <div class="card-body">
                            <a href="<?= BASE_URL ?>/views/pembayaran/create-pembayaran.php"
                                class="btn btn-primary mb-3">
                                <i class="fas fa-plus"></i> Tambah Pembayaran
                            </a>
                            <table class="table table-bordered table-striped" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Status Pesanan</th>
                                        <th>Kode Diskon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['id']) ?></td>
                                        <td><?= htmlspecialchars($row['tanggal']) ?></td>
                                        <td><?= htmlspecialchars($row['jumlah_bayar']) ?></td>
                                        <td><?= htmlspecialchars($row['status_bayar']) ?></td>
                                        <td><?= htmlspecialchars($row['kode_diskon'] ?? '-') ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/views/pembayaran/detail-pembayaran.php?id=<?= $row['id'] ?>"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> detail
                                            </a>
                                            <a href="<?= BASE_URL ?>/views/pembayaran/edit-pembayaran.php?id=<?= $row['id'] ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= BASE_URL ?>/views/pembayaran/delete-pembayaran.php?id=<?= $row['id'] ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin hapus pembayaran ini?');">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            <a href="<?= BASE_URL ?>/views/dashboard.php" class="btn btn-secondary mt-3">Kembali ke
                                Dashboard</a>
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
    <?php if ($showSuccessPopup): ?>
    <script>
    alert('Berhasil bayar!');
    </script>
    <?php endif; ?>
</body>

</html>