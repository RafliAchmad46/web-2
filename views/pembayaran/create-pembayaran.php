<?php
include_once __DIR__ . '/../../config/database.php';
include_once __DIR__ . '/../../models/Pembayaran.php';
include_once __DIR__ . '/../../models/Pesanan.php';
include_once __DIR__ . '/../../models/KartuDiskon.php';

function cleanCurrency($value) {
    return floatval(preg_replace("/[^0-9.]/", "", $value));
}
$database = Database::getInstance();
$db = $database->getConnection();

$pembayaran = new Pembayaran($db);
$pesanan = new Pesanan($db);
$kartuDiskon = new KartuDiskon($db);

$pesananList = $pesanan->read();
$kartuDiskonList = $kartuDiskon->read();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesanan_id = $_POST['pesanan_id'];
    $kartu_diskon_id = $_POST['kartu_diskon_id'] !== '' ? $_POST['kartu_diskon_id'] : null;
    $tanggal = $_POST['tanggal'];
    $jumlah_bayar = $_POST['jumlah_bayar'];

    if ($pembayaran->create($pesanan_id, $kartu_diskon_id, $tanggal, $jumlah_bayar)) {
        header("Location: pembayaran_list.php");
        exit;
    } else {
        echo "Gagal menambah pembayaran.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Pembayaran</title>
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
                        <li class="breadcrumb-item active">Tambah Pembayaran</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-credit-card me-1"></i> Form Tambah Pembayaran
                        </div>
                        <div class="container mt-4">
                            <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>
                            <form method="POST" action="">
                                <label>Pesanan:</label>
                                <select name="pesanan_id" required>
                                    <option value="">-- Pilih Pesanan --</option>
                                    <?php while ($row = $pesananList->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $row['id'] ?>">ID: <?= $row['id'] ?> -
                                        <?= $row['anggota_nama'] ?> - <?= $row['tanggal'] ?></option>
                                    <?php endwhile; ?>
                                </select><br><br>

                                <label>Kartu Diskon:</label>
                                <select name="kartu_diskon_id" id="kartu_diskon">
                                    <option value="" data-diskon="0">-- Tidak pakai diskon --</option>
                                    <?php while ($row = $kartuDiskonList->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $row['id'] ?>" data-diskon="<?= $row['persen_diskon'] ?>">
                                        <?= $row['nama'] ?> (<?= $row['persen_diskon'] ?>%)
                                    </option>
                                    <?php endwhile; ?>
                                </select>

                                <label>Tanggal Bayar:</label>
                                <input type="date" name="tanggal" required><br><br>

                                <label>Jumlah Bayar:</label>
                                <input type="number" name="jumlah_bayar" step="0.01" min="0" required>

                                <form action="<?= BASE_URL ?>/views/pembayaran/list-pembayaran.php" method="GET"
                                    onsubmit="return confirm('Yakin ingin bayar?');">
                                    <button type="submit" name="bayar" value="1" class="btn btn-primary">Bayar</button>
                                </form>
                            </form>
                            <script>
                            function formatRupiah(angka) {
                                let number_string = angka.replace(/[^,\d]/g, '').toString(),
                                    split = number_string.split(','),
                                    sisa = split[0].length % 3,
                                    rupiah = split[0].substr(0, sisa),
                                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                if (ribuan) {
                                    let separator = sisa ? '.' : '';
                                    rupiah += separator + ribuan.join('.');
                                }

                                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                                return rupiah ? 'Rp ' + rupiah : '';
                            }

                            document.getElementById('jumlah_bayar').addEventListener('keyup', function(e) {
                                this.value = formatRupiah(this.value);
                            });

                            function setJumlahBayarRupiah(value) {
                                const input = document.getElementById('jumlah_bayar');
                                input.value = formatRupiah(value.toString());
                            }
                            </script>

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