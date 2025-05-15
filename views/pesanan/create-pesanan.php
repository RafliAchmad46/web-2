<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Pesanan.php';
require_once __DIR__ . '/../../models/Anggota.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/KartuDiskon.php';

$db = Database::getInstance()->getConnection();
$pesanan = new Pesanan($db);
$anggotaModel = new Anggota($db);
$anggotaStmt = $anggotaModel->read();

$kartuDiskonModel = new KartuDiskon($db);
$kartuStmt = $kartuDiskonModel->read();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $status_bayar = $_POST['status_bayar'];
    $anggota_id = $_POST['anggota_id'];
    $kartu_diskon_id = $_POST['kartu_diskon_id'];

    // Ambil diskon dari tabel kartu_diskon
    $diskonData = $kartuDiskonModel->findById($kartu_diskon_id); // pastikan method ini ada di model KartuDiskon
    $diskon = $diskonData ? $diskonData['persen_diskon'] : 0;

    if ($pesanan->create($tanggal, $diskon, $status_bayar, $anggota_id, $kartu_diskon_id)) {
        header("Location: list-pesanan.php?success=1");
        exit;
    } else {
        $error = "Gagal menambahkan pesanan.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Pegawai</title>
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
                        <li class="breadcrumb-item active">Tambah Pesanan</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Form Tambah Pesanan
                        </div>
                        <div class="container mt-4">
                            <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kartu_diskon_id" class="form-label">Pilih Kartu Diskon</label>
                                    <select name="kartu_diskon_id" class="form-control" required>
                                        <option value="">-- Pilih Diskon --</option>
                                        <?php while ($row = $kartuStmt->fetch(PDO::FETCH_ASSOC)): ?>
                                        <option value="<?= $row['id'] ?>">
                                            <?= htmlspecialchars($row['nama']) ?> (<?= $row['persen_diskon'] ?>%)
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status_bayar" class="form-label">Status Bayar</label>
                                    <select name="status_bayar" class="form-control" required>
                                        <option value="Belum Bayar">Belum Bayar</option>
                                        <option value="Sudah Bayar">Sudah Bayar</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="anggota_id" class="form-label">Anggota</label>
                                    <select name="anggota_id" class="form-control" required>
                                        <option value="">-- Pilih Anggota --</option>
                                        <?php while ($row = $anggotaStmt->fetch(PDO::FETCH_ASSOC)): ?>
                                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['pegawai_nama']) ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="list-pesanan.php" class="btn btn-secondary">Batal</a>
                            </form>
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