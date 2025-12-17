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

class BidangKeahlian
{
    public static function all()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM bidang_keahlian ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM bidang_keahlian WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($nama)
    {
        global $pdo;
        $slug = createSlug($nama);
        $stmt = $pdo->prepare('INSERT INTO bidang_keahlian (nama,slug) VALUES (:nama, :slug)');
        $stmt->execute(['nama' => $nama, 'slug' => $slug]);
    }

    public static function update($id, $nama)
    {
        global $pdo;
        $slug = createSlug($nama);
        $stmt = $pdo->prepare('UPDATE bidang_keahlian SET nama= :nama, slug= :slug WHERE id= :id');
        $stmt->execute(['nama' => $nama, 'slug' => $slug, 'id' => $id]);
    }

    public static function delete($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM bidang_keahlian WHERE id=?');
        $stmt->execute([$id]);
    }
}
