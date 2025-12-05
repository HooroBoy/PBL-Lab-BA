<?php
// app/models/Kategori.php
require_once __DIR__ . '/../config/connection.php';
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
        $stmt = $pdo->query("SELECT * FROM artikel ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM artikel WHERE id = ?');
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
}
