<?php
require_once __DIR__ . '/../../config/database.php';
class Galeri {
    public static function all($kategori = null) {
        global $pdo;
        $sql = "SELECT * FROM galeri";
        $params = [];
        if ($kategori) {
            $kategori = trim($kategori);
            $kategori = preg_replace('/[^a-z]/', '', strtolower($kategori));
            // Enum di database: 'activity', 'facility'
            if ($kategori === 'aktivitas') $kategori = 'activity';
            if ($kategori === 'fasilitas') $kategori = 'facility';
            if (!in_array($kategori, ['activity', 'facility'])) {
                $kategori = null;
            }
        }
        if ($kategori) {
            $sql .= " WHERE kategori = :kategori";
            $params[':kategori'] = $kategori;
        }
        $sql .= " ORDER BY created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        global $pdo;
        $sql = "SELECT * FROM galeri WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        global $pdo;
        // Normalisasi kategori agar sesuai enum database
        $kategori = isset($data['kategori']) ? trim($data['kategori']) : '';
        $kategori = preg_replace('/[^a-z]/', '', strtolower($kategori));
        if ($kategori === 'aktivitas') $kategori = 'activity';
        if ($kategori === 'fasilitas') $kategori = 'facility';
        if (!in_array($kategori, ['activity', 'facility'])) {
            $kategori = null;
        }
        $sql = "INSERT INTO galeri (judul, deskripsi, gambar, kategori, created_at) VALUES (:judul, :deskripsi, :gambar, :kategori, :created_at)";
        $now = date('Y-m-d H:i:s');
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':judul' => $data['judul'],
            ':deskripsi' => $data['deskripsi'],
            ':gambar' => $data['gambar'],
            ':kategori' => $kategori,
            ':created_at' => $now
        ]);
    }

    public static function update($id, $data) {
        global $pdo;
        // Normalisasi kategori agar sesuai enum database
        $kategori = isset($data['kategori']) ? trim($data['kategori']) : '';
        $kategori = preg_replace('/[^a-z]/', '', strtolower($kategori));
        if ($kategori === 'aktivitas') $kategori = 'activity';
        if ($kategori === 'fasilitas') $kategori = 'facility';
        if (!in_array($kategori, ['activity', 'facility'])) {
            $kategori = null;
        }
        $sql = "UPDATE galeri SET judul=:judul, deskripsi=:deskripsi, gambar=:gambar, kategori=:kategori WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':judul' => $data['judul'],
            ':deskripsi' => $data['deskripsi'],
            ':gambar' => $data['gambar'],
            ':kategori' => $kategori,
            ':id' => $id
        ]);
    }

    public static function latest($kategori, $limit = 6) {
        global $pdo;
        $sql = "SELECT * FROM galeri";
        $params = [];
        
        $kategori = self::normalizeCategory($kategori);
        if ($kategori) {
            $sql .= " WHERE kategori = :kategori";
            $params[':kategori'] = $kategori;
        }
        
        $sql .= " ORDER BY created_at DESC LIMIT :limit";
        
        $stmt = $pdo->prepare($sql);
        if (!empty($params)) {
            $stmt->bindValue(':kategori', $params[':kategori']);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete($id) {
        global $pdo;
        $sql = "DELETE FROM galeri WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Helper untuk normalisasi kategori
    private static function normalizeCategory($kategori) {
        $kategori = trim($kategori);
        $kategori = preg_replace('/[^a-z]/', '', strtolower($kategori));
        if ($kategori === 'aktivitas') return 'activity';
        if ($kategori === 'fasilitas') return 'facility';
        if (in_array($kategori, ['activity', 'facility'])) return $kategori;
        return null;
    }
}
