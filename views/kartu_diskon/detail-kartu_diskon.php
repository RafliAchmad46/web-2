<?php
require_once '../../config/database.php';
require_once '../../models/KartuDiskon.php';

$db = Database::getInstance()->getConnection();
$kartuDiskon = new KartuDiskon($db);

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    die("ID tidak ditemukan.");
}

// Ambil data kartu diskon berdasarkan ID
$data = $kartuDiskon->findById($id);

if (!$data) {
    die("Data tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detail Kartu Diskon</title>
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
                    <h1 class="mt-4">Detail Kartu Diskon</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a
                                href="<?= BASE_URL ?>/views/kartu_diskon/list-kartu_diskon.php">Kartu Diskon</a></li>
                        <li class="breadcrumb-item active"><?= htmlspecialchars($data['nama']); ?></li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-ticket-alt me-1"></i> Detail Kartu Diskon
                        </div>
                        <div class="card-body">
                            <p><strong>Nama:</strong> <?= htmlspecialchars($data['nama']); ?></p>
                            <p><strong>Deskripsi:</strong> <?= htmlspecialchars($data['deskripsi']); ?></p>
                            <p><strong>Persen Diskon:</strong> <?= htmlspecialchars($data['persen_diskon']); ?>%</p>
                            <a href="edit-kartu_diskon.php?id=<?= urlencode($data['id']); ?>"
                                class="btn btn-primary">Edit</a>
                            <a href="<?= BASE_URL ?>/views/kartu_diskon/list-kartu_diskon.php"
                                class="btn btn-secondary">Kembali</a>
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