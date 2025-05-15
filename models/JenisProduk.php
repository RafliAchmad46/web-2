<?php
class JenisProduk {
    private $conn;
    private $table_name = "jenis_produk";

    public function __construct($db){
        $this->conn = $db;
    }

    // CREATE
    public function create($nama, $deskripsi) {
        $query = "INSERT INTO " . $this->table_name . " (nama, deskripsi) VALUES (:nama, :deskripsi)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':deskripsi', $deskripsi);
        return $stmt->execute();
    }

    // READ ALL
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // READ ONE
    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $nama, $deskripsi) {
        $query = "UPDATE " . $this->table_name . " SET nama = :nama, deskripsi = :deskripsi WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':deskripsi', $deskripsi);
        return $stmt->execute();
    }

    // DELETE
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Get all products by jenis_produk_id
    public function getProductsByJenis($jenis_produk_id) {
        $query = "SELECT * FROM produk WHERE jenis_produk_id = :jenis_produk_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':jenis_produk_id', $jenis_produk_id);
        $stmt->execute();
        return $stmt;
    }
}
?>