    <?php
    // pastikan require_once dengan benar untuk database dan model Pegawai
    require_once __DIR__ . '/../../config/database.php';
    require_once __DIR__ . '/../../models/Pegawai.php';
    require_once __DIR__ . '/../../config/config.php';

    // Gunakan namespace yang sesuai dengan konfigurasi

    // Mendapatkan koneksi dari singleton Database
    $db = Database::getInstance()->getConnection();

    // Inisialisasi objek Pegawai dengan koneksi yang didapat
    $pegawaiModel = new Pegawai($db);

    // Ambil data pegawai dengan menggunakan method read()
    $stmt = $pegawaiModel->read();
    $num = $stmt->rowCount();

    $pegawai = [];
if ($num > 0) {
    $pegawai = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Projek</title>
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
                        <h1 class="mt-4">Pegawai</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pegawai</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i> Data Pegawai
                            </div>
                            <div class="card-body">
                                <div class="mb-3 text-end">
                                    <a href="<?= BASE_URL ?>/views/pegawai/create-pegawai.php" class="btn btn-success">
                                        <i class="fa-solid fa-plus"></i> Tambah Pegawai
                                    </a>
                                </div>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($pegawai as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nip'] ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['jenis_kelamin'] ?></td>
                                            <td><?= $row['jabatan'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL ?>/views/pegawai/detail-pegawai.php?id=<?= $row['id'] ?>"
                                                    class="btn btn-info">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="<?= BASE_URL ?>/views/pegawai/edit-pegawai.php?id=<?= $row['id'] ?>"
                                                    class="btn btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="<?= BASE_URL ?>/views/pegawai/delete-pegawai.php?id=<?= $row['id'] ?>"
                                                    class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include __DIR__ . '/../partials/footer.php'; ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous">
        </script>
        <script src="<?= BASE_URL ?>/public/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
            crossorigin="anonymous"></script>
        <script src="<?= BASE_URL ?>/public/js/datatables-simple-demo.js"></script>
    </body>

    </html>