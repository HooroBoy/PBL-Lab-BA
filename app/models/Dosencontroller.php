<?php
// app/models/Dosen.php
require_once __DIR__ . '/../../config/database.php';

class Dosen
{
    public static function all()
    {
        global $pdo;
        // $stmt = $pdo->query("SELECT * FROM dosen ORDER BY id DESC");
        $stmt = $pdo->query("SELECT d.id AS id, d.nama AS nama, d.foto AS foto, d.nip AS nip, d.nidn AS nidn, d.email AS email, d.program_studi AS program_studi, d.sinta_id AS sinta_id, d.google_scholar_id AS google_scholar_id, bk.nama AS nama_bidang FROM dosen d INNER JOIN dosen_bidang_keahlian AS dbk ON d.id = dbk.dosen_id INNER JOIN bidang_keahlian bk ON dbk.bidang_id = bk.id ORDER BY d.id DESC");
        $relasi_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dosen_terstruktur = [];

        foreach ($relasi_list as $row) {
            $id_dosen = $row['id'];

            if (!isset($dosen_terstruktur[$id_dosen])) {
                $dosen_terstruktur[$id_dosen] = [
                    'id' => $row['id'],
                    'foto' => $row['foto'],
                    'nama' => $row['nama'],
                    'nip' => $row['nip'],
                    'nidn' => $row['nidn'],
                    'email' => $row['email'],
                    'program_studi' => $row['program_studi'],
                    'sinta_id' => $row['sinta_id'],
                    'google_scholar_id' => $row['google_scholar_id'],
                    'bidang' => []
                ];
            }

            $dosen_terstruktur[$id_dosen]['bidang'][] = [
                'nama_bidang' => $row['nama_bidang']
            ];
        }

        return $dosen_terstruktur;
    }

    public static function find($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM dosen WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function bkSelected($id)
    {
        global $pdo;
        $stmt_selected = $pdo->prepare("SELECT bidang_id FROM dosen_bidang_keahlian WHERE dosen_id = :id");
        $stmt_selected->execute([':id' => $id]);
        return $stmt_selected->fetchAll(PDO::FETCH_COLUMN, 0); // Ambil hanya kolom mk_id
    }

    public static function create($data, $data2)
    {
        global $pdo;

        try {
            $pdo->beginTransaction();
    
            $stmt = $pdo->prepare("INSERT INTO dosen (admin_id, nip, nidn, nama, email, program_studi, foto, sinta_id, google_scholar_id, linkedin_url, pendidikan, sertifikasi, metadata) VALUES (:admin_id, :nip, :nidn, :nama, :email, :program_studi, :foto, :sinta_id, :google_scholar_id, :linkedin_url, :pendidikan, :sertifikasi, :metadata) RETURNING id");
            $stmt->execute(
                // $data
        [
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
                ]
            );

            $new_dosen_id = $stmt->fetchColumn();
    
            $data_bidang = $data2['bidangs'];
            
            $stmt_link = $pdo->prepare("INSERT INTO dosen_bidang_keahlian (dosen_id, bidang_id) VALUES (:dosen_id, :bidang_id)");
            foreach ($data_bidang as $id_bidang) {
                $stmt_link->execute([':dosen_id' => $new_dosen_id, ':bidang_id' => $id_bidang]);
            }
    
            $pdo->commit();
        } catch (PDOException $e) {
            echo "Kesalahan saat memperbarui data: " . $e->getMessage();
        }

    }

    public static function update($id, $data, $data2)
    {
        global $pdo;

        $pdo->beginTransaction(); // Mulai Transaksi

        try {
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

            $data_bidang = $data2['bidang_keahlian'];
            
            // 1. DETACH (Hapus semua relasi lama dosen ini)
            $stmt_delete = $pdo->prepare("DELETE FROM dosen_bidang_keahlian WHERE dosen_id = :dosen_id");
            $stmt_delete->execute([':dosen_id' => $id]);

            // 2. ATTACH (Sisipkan relasi yang baru dan yang dipilih)
            if (!empty($data_bidang)) {
                $stmt_insert = $pdo->prepare("INSERT INTO dosen_bidang_keahlian (dosen_id, bidang_id) 
                    VALUES (:dosen_id, :bidang_id)
                ");

                foreach ($data_bidang as $id_bidang) {
                    $stmt_insert->execute([
                        ':dosen_id' => $id,
                        ':bidang_id' => $id_bidang
                    ]);
                }
            }

            $pdo->commit(); // Commit (Simpan) perubahan ke database

        } catch (PDOException $e) {
            $pdo->rollBack(); // Rollback (Batalkan) semua operasi jika ada yang gagal
            $status = "Gagal memperbarui relasi: " . $e->getMessage();
        }
    }

    public static function delete($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM dosen WHERE id=?');
        $stmt->execute([$id]);
    }

    public static function getBidangKeahlian($dosen_id)
    {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT bk.nama 
            FROM dosen_bidang_keahlian AS dbk
            JOIN bidang_keahlian AS bk ON dbk.bidang_id = bk.id
            WHERE dbk.dosen_id = :dosen_id
        ");
        $stmt->execute([':dosen_id' => $dosen_id]);
        
        // Mengembalikan array nama bidang keahlian (contoh: ['Text Mining', 'Data Science'])
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0); 
    }
}