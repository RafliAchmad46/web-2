<?php
// classes/Produk.php
class Produk {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO produk (nama_produk, harga) VALUES (:nama_produk, :harga)");
        return $stmt->execute($data);
    }

    public function read() {
        $stmt = $this->pdo->query("SELECT * FROM produk");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $stmt = $this->pdo->prepare("UPDATE produk SET nama_produk = :nama_produk, harga = :harga WHERE id = :id");
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM produk WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>