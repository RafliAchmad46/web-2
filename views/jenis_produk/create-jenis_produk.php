<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/JenisProduk.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$jenisProduk = new JenisProduk($db);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';

    if (empty($nama)) {
        $error_message = "Nama Jenis Produk wajib diisi.";
    } else {
        if ($jenisProduk->create($nama, $deskripsi)) {
            header("Location: " . BASE_URL . "/views/jenis_produk/list-jenis_produk.php?message=created");
            exit;
        } else {
            $error_message = "Gagal menambahkan jenis produk.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Jenis Produk</title>
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
                    <h1 class="mt-4">Tambah Jenis Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a
                                href="<?= BASE_URL ?>/views/jenis_produk/list-jenis_produk.php">Jenis Produk</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-boxes me-1"></i> Form Tambah Jenis Produk
                        </div>
                        <div class="container mt-4">
                            <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
                            <?php endif; ?>
                            <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama Jenis Produk</label>
                                    <input type="text" id="nama" name="nama" class="form-control" required
                                        value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi" class="form-control"
                                        rows="4"><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="<?= BASE_URL ?>/views/jenis_produk/list-jenis_produk.php"
                                    class="btn btn-secondary">Batal</a>
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
</body>

</html>