<?php
class Produk {
    private $conn;
    private $table_name = "produk";
    
    // Properties
    public $id;
    public $kode;
    public $nama;
    public $deskripsi;
    public $harga;
    public $stok;
    public $jenis_produk_id;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    // CREATE
    public function create($kode, $nama, $deskripsi, $harga, $stok, $jenis_produk_id) {
        $query = "INSERT INTO " . $this->table_name . " (kode, nama, deskripsi, harga, stok, jenis_produk_id) 
                  VALUES (:kode, :nama, :deskripsi, :harga, :stok, :jenis_produk_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':kode', $kode);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':stok', $stok);
        $stmt->bindParam(':jenis_produk_id', $jenis_produk_id);
        return $stmt->execute() ? $this->conn->lastInsertId() : false;
    }
    
    // READ
    public function read() {
        $query = "SELECT p.*, j.nama as jenis_nama
                  FROM " . $this->table_name . " p
                  LEFT JOIN jenis_produk j ON p.jenis_produk_id = j.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getAll() {
    $query = "SELECT 
                p.*, 
                jp.nama AS jenis_nama,
                jp.deskripsi AS jenis_deskripsi
              FROM produk p
              LEFT JOIN jenis_produk jp ON p.jenis_produk_id = jp.id
              ORDER BY p.id DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    
    // READ ONE
    public function readOne($id) {
    $query = "SELECT * FROM produk WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt; 
} 


    
    // READ by Jenis Produk ID
    public function readByJenis($jenis_produk_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE jenis_produk_id = :jenis_produk_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':jenis_produk_id', $jenis_produk_id);
        $stmt->execute();
        return $stmt;
    }
    
    // UPDATE
    public function update($id, $kode, $nama, $deskripsi, $harga, $stok, $jenis_produk_id) {
        $query = "UPDATE " . $this->table_name . " 
                  SET kode = :kode, 
                      nama = :nama, 
                      deskripsi = :deskripsi,
                      harga = :harga,
                      stok = :stok,
                      jenis_produk_id = :jenis_produk_id
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':kode', $kode);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':stok', $stok);
        $stmt->bindParam(':jenis_produk_id', $jenis_produk_id);
        return $stmt->execute();
    }
    
    // UPDATE Stock
    public function updateStock($id, $stok) {
        $query = "UPDATE " . $this->table_name . " SET stok = :stok WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':stok', $stok);
        return $stmt->execute();
    }
    
    // DELETE
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    // Reduce Stock
    public function reduceStock($id, $quantity) {
        // First get current stock
        $query = "SELECT stok FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $newStock = $row['stok'] - $quantity;
            if($newStock >= 0) {
                return $this->updateStock($id, $newStock);
            } else {
                return false; // Not enough stock
            }
        }
        return false;
    }
}
?>