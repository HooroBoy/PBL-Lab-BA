<?php
// app/models/Kategori.php
require_once __DIR__ . '/../../config/database.php';
// include "../config/connection.php";

function createSlug(string $text): string
{
    // Convert to lowercase
    $text = strtolower($text);

    // Replace special characters (example using iconv for basic transliteration)
    // Note: For more robust handling of various languages and characters, consider a dedicated library.
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);

    // Replace non-alphanumeric characters and spaces with hyphens
    $text = preg_replace('/[^a-z0-9-]+/', '-', $text);

    // Remove consecutive hyphens
    $text = preg_replace('/-+/', '-', $text);

    // Trim hyphens from the beginning and end
    $text = trim($text, '-');

    return $text;
}

class Artikel
{
    public static function all()
    {
        global $pdo;
        $sql = "
        SELECT a.*, n.nama 
        FROM artikel a
        JOIN admin n ON a.admin_id = n.id
        ORDER BY a.id DESC
    ";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        global $pdo;

        $sql = "
        SELECT a.*, 
                n.nama AS admin_username
        FROM artikel a
        JOIN admin n ON a.admin_id = n.id
        WHERE a.id = ?
        LIMIT 1
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public static function create($data)
    {
        global $pdo;
        $query = "INSERT INTO artikel (admin_id, judul, slug, isi, thumbnail, tanggal, tags) VALUES (:admin_id, :judul, :slug, :isi, :thumbnail, :tanggal, :tags)";
        $slug = createSlug($data['judul']);

        $stmt = $pdo->prepare($query);

        $stmt->execute([
            'admin_id' => $data['admin_id'],
            'judul' => $data['judul'],
            'slug' => $slug,
            'isi' => $data['isi'],
            'thumbnail' => $data['thumbnail'],
            'tanggal' => $data['tanggal'],
            'tags' => $data['tags'],
        ]);
    }

    public static function update($id, $data)
    {
        global $pdo;

        $query = "UPDATE artikel
            SET
                admin_id = :admin_id,
                judul = :judul,
                slug = :slug,
                isi = :isi,
                thumbnail = :thumbnail,
                tanggal = :tanggal,
                tags = :tags
            WHERE
                id = :id
        ";

        $slug = createSlug($data['judul']);

        try {
            $stmt = $pdo->prepare($query);

            $stmt->execute([
                'admin_id' => $data['admin_id'],
                'judul' => $data['judul'],
                'slug' => $slug,
                'isi' => $data['isi'],
                'thumbnail' => $data['thumbnail'],
                'tanggal' => $data['tanggal'],
                'tags' => $data['tags'],
                'id' => $id
                // $data
            ]);
        } catch (PDOException $e) {
            echo "Kesalahan saat memperbarui data: " . $e->getMessage();
        }
    }

    public static function delete($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM artikel WHERE id=?');
        $stmt->execute([$id]);
    }

    // Menampilkan artikel terbaru dengan limit tertentu
    public static function latest($limit = 1)
    {
        global $pdo;

        // Pastikan limit berupa angka
        $limit = (int) $limit;

        // Kita copy logic dari function all() Anda, tapi tambah LIMIT
        // SELECT a.* (data artikel) dan n.nama (nama admin)
        $sql = "
        SELECT a.*, n.nama 
        FROM artikel a
        JOIN admin n ON a.admin_id = n.id
        ORDER BY a.created_at DESC  -- Atau gunakan a.id DESC jika ingin urut ID
        LIMIT :limit
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
