<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Produk.php';
require_once __DIR__ . '/../../models/JenisProduk.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$produkModel = new Produk($db);
$jenisProdukModel = new JenisProduk($db);
$jenisProdukStmt = $jenisProdukModel->read();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $jenis_produk_id = $_POST['jenis_produk_id'];

    if ($produkModel->create($kode, $nama, $deskripsi, $harga, $stok, $jenis_produk_id)) {
        header("Location: " . BASE_URL . "/views/produk/list-produk.php");
        exit();
    } else {
        echo "Gagal menambahkan produk.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Produk</title>
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
                    <h1 class="mt-4">Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Produk</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Form Tambah Produk
                        </div>
                        <div class="container mt-4">
                            <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_produk_id" class="form-label">Jenis Produk</label>
                                    <select name="jenis_produk_id" id="jenis_produk_id" class="form-control" required>
                                        <option value="">-- Pilih Jenis Produk --</option>
                                        <?php while ($row = $jenisProdukStmt->fetch(PDO::FETCH_ASSOC)): ?>
                                        <option value="<?= $row['id'] ?>">
                                            <?= htmlspecialchars($row['nama']) ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="<?= BASE_URL ?>/views/produk/list-produk.php"
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