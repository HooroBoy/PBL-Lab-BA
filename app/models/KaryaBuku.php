<?php
// app/models/Kategori.php
require_once __DIR__ . '/../../config/database.php';
// include "../config/connection.php";

class KaryaBuku
{
    public static function all()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM karya_buku ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function allByDosen($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM karya_buku WHERE dosen_id = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM karya_buku WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dosen_id, $judul_buku, $jumlah_halaman, $tahun, $penerbit)
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO karya_buku (dosen_id,judul_buku,jumlah_halaman,tahun,penerbit) VALUES (:dosen_id, :judul_buku, :jumlah_halaman, :tahun, :penerbit)');
        $stmt->execute(['dosen_id' => $dosen_id, 'judul_buku' => $judul_buku, 'jumlah_halaman' => $jumlah_halaman, 'tahun' => $tahun, 'penerbit' => $penerbit]);
    }

    public static function update($id, $dosen_id, $judul_buku, $jumlah_halaman, $tahun, $penerbit)
    {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE karya_buku SET dosen_id= :dosen_id, judul_buku= :judul_buku, jumlah_halaman= :jumlah_halaman, tahun= :tahun, penerbit= :penerbit WHERE id= :id');
        $stmt->execute(['dosen_id' => $dosen_id, 'judul_buku' => $judul_buku, 'jumlah_halaman' => $jumlah_halaman, 'tahun' => $tahun, 'penerbit' => $penerbit, 'id' => $id]);
    }

    public static function delete($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM karya_buku WHERE id=?');
        $stmt->execute([$id]);
    }
}
