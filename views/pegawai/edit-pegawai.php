<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Pegawai.php';
require_once __DIR__ . '/../../config/config.php';

// Koneksi dan inisialisasi model
$db = Database::getInstance()->getConnection();
$pegawaiModel = new Pegawai($db);

// Ambil ID dari query string
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ' . BASE_URL . '/views/pegawai/list-pegawai.php');
    exit;
}
$id = $_GET['id'];

// Ambil data pegawai berdasarkan ID
$stmt = $pegawaiModel->readOne($id);
$pegawai = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pegawai) {
    // Jika data tidak ditemukan, redirect ke list
    header('Location: ' . BASE_URL . '/views/pegawai/list-pegawai.php');
    exit;
}

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan = $_POST['jabatan'];

    $updated = $pegawaiModel->update($id, $nip, $nama, $jenis_kelamin, $jabatan);
    if ($updated) {
        header('Location: ' . BASE_URL . '/views/pegawai/list-pegawai.php');
        exit;
    } else {
        $error = "Gagal memperbarui data pegawai.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Pegawai</title>
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
                    <div class="small">Logged in as:</div>Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Pegawai</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/pegawai/list-pegawai.php">Pegawai</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i> Form Edit Pegawai
                        </div>
                        <div class="container mt-4">
                            <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>
                            <form method="POST">
                                <div class="form-group mb-3">
                                    <label for="nip">NIP</label>
                                    <input type="text" id="nip" name="nip" class="form-control" required
                                        value="<?= htmlspecialchars($pegawai['nip']) ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control" required
                                        value="<?= htmlspecialchars($pegawai['nama']) ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                        <option value="Laki-laki"
                                            <?= $pegawai['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            <?= $pegawai['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" id="jabatan" name="jabatan" class="form-control" required
                                        value="<?= htmlspecialchars($pegawai['jabatan']) ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="<?= BASE_URL ?>/views/pegawai/list-pegawai.php"
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