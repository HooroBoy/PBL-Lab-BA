<?php
// app/models/Dosen.php
require_once __DIR__ . '/../config/connection.php';

class Dosen
{
    public static function all()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM dosen ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM dosen WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO dosen (admin_id, nip, nidn, nama, email, program_studi, foto, sinta_id, google_scholar_id, linkedin_url, pendidikan, sertifikasi, metadata) VALUES (:admin_id, :nip, :nidn, :nama, :email, :program_studi, :foto, :sinta_id, :google_scholar_id, :linkedin_url, :pendidikan, :sertifikasi, :metadata)');
        $stmt->execute([
            'admin_id' => $data['admin_id'],
            'nip' => $data['nip'],
            'nidn' => $data['nidn'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'program_studi' => $data['program_studi'],
            'foto' => $data['foto'],
            'sinta_id' => $data['sinta_id'],
            'google_scholar_id' => $data['google_scholar_id'],
            'linkedin_url' => $data['linkedin_url'],
            'pendidikan' => $data['pendidikan'],
            'sertifikasi' => $data['sertifikasi'],
            'metadata' => $data['metadata'],
        ]);
    }

    public static function update($id, $data)
    {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE dosen SET admin_id=:admin_id, nip=:nip, nidn=:nidn, nama=:nama, email=:email, program_studi=:program_studi, foto=:foto, sinta_id=:sinta_id, google_scholar_id=:google_scholar_id, linkedin_url=:linkedin_url, pendidikan=:pendidikan, sertifikasi=:sertifikasi, metadata=:metadata WHERE id=:id');
        $stmt->execute([
            'admin_id' => $data['admin_id'],
            'nip' => $data['nip'],
            'nidn' => $data['nidn'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'program_studi' => $data['program_studi'],
            'foto' => $data['foto'],
            'sinta_id' => $data['sinta_id'],
            'google_scholar_id' => $data['google_scholar_id'],
            'linkedin_url' => $data['linkedin_url'],
            'pendidikan' => $data['pendidikan'],
            'sertifikasi' => $data['sertifikasi'],
            'metadata' => $data['metadata'],
            'id' => $id,
        ]);
    }

    public static function delete($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM dosen WHERE id=?');
        $stmt->execute([$id]);
    }
}
