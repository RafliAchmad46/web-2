<?php
// classes/Anggota.php
class Anggota {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO anggota (nama, email) VALUES (:nama, :email)");
        return $stmt->execute($data);
    }

    public function read() {
        $stmt = $this->pdo->query("SELECT * FROM anggota");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $stmt = $this->pdo->prepare("UPDATE anggota SET nama = :nama, email = :email WHERE id = :id");
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM anggota WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>