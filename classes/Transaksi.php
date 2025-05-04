<?php
// classes/Transaksi.php
class Transaksi {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO transaksi (id_anggota, id_produk, tanggal) VALUES (:id_anggota, :id_produk, :tanggal)");
        return $stmt->execute($data);
    }

    public function read() {
        $stmt = $this->pdo->query("SELECT * FROM transaksi");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $stmt = $this->pdo->prepare("UPDATE transaksi SET id_anggota = :id_anggota, id_produk = :id_produk, tanggal = :tanggal WHERE id = :id");
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM transaksi WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>