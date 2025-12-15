<?php
// app/models/Dosen.php
require_once __DIR__ . '/../../config/database.php';

class Dosen
{
    public static function all()
    {
        global $pdo;
        // Query digabung (JOIN) untuk mengambil data dosen beserta nama bidang keahliannya
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
                    'bidang' => [] // Inisialisasi array bidang
                ];
            }

            // Push nama bidang ke array
            $dosen_terstruktur[$id_dosen]['bidang'][] = [
                'nama_bidang' => $row['nama_bidang']
            ];
        }

        return $dosen_terstruktur;
    }

    // --- PERUBAHAN UTAMA ADA DI SINI ---
    public static function find($id)
    {
        global $pdo;

        // 1. Ambil data profil dosen
        $stmt = $pdo->prepare('SELECT * FROM dosen WHERE id = ?');
        $stmt->execute([$id]);
        $dosen = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dosen) {
            return false;
        }

        // 2. Ambil data bidang keahlian secara terpisah
        // Kita ambil kolom 'nama' dan di-alias menjadi 'nama_bidang' agar sesuai dengan struktur method all()
        $stmt_bidang = $pdo->prepare("
            SELECT bk.nama as nama_bidang 
            FROM dosen_bidang_keahlian AS dbk
            JOIN bidang_keahlian AS bk ON dbk.bidang_id = bk.id
            WHERE dbk.dosen_id = ?
        ");
        $stmt_bidang->execute([$id]);
        $bidang_list = $stmt_bidang->fetchAll(PDO::FETCH_ASSOC);

        // 3. Masukkan hasil query bidang ke dalam array dosen utama
        $dosen['bidang'] = $bidang_list; 
        
        // Hasil akhir sekarang memiliki format: 
        // ['nama' => '...', 'nip' => '...', 'bidang' => [['nama_bidang' => 'AI'], ...]]
        
        return $dosen;
    }

    public static function bkSelected($id)
    {
        global $pdo;
        $stmt_selected = $pdo->prepare("SELECT bidang_id FROM dosen_bidang_keahlian WHERE dosen_id = :id");
        $stmt_selected->execute([':id' => $id]);
        return $stmt_selected->fetchAll(PDO::FETCH_COLUMN, 0); 
    }

    public static function create($data, $data2)
    {
        global $pdo;

        try {
            // Mulai Transaksi Database
            $pdo->beginTransaction();
            
            // ---------------------------------------------------------
            // LANGKAH 1: BUAT AKUN LOGIN DI TABEL ADMIN
            // ---------------------------------------------------------
            
            // Kita gunakan NIP sebagai Username default
            // Kita gunakan NIP sebagai Password default (dienkripsi)
            $defaultPassword = password_hash($data['nip'], PASSWORD_DEFAULT);
            
            $stmtUser = $pdo->prepare("INSERT INTO admin (nama, username, password, role) VALUES (:nama, :username, :password, :role) RETURNING id");
            
            $stmtUser->execute([
                'nama'     => $data['nama'],
                'username' => $data['nip'],      // Username login pakai NIP
                'password' => $defaultPassword,  // Password login pakai NIP
                'role'     => 'dosen'            // Role otomatis diset 'dosen'
            ]);

            // Ambil ID dari user (admin) yang baru dibuat (Opsional, jika tabel dosen butuh relasi ke user)
            $newAccountId = $stmtUser->fetchColumn(); 

            // ---------------------------------------------------------
            // LANGKAH 2: BUAT DATA PROFIL DI TABEL DOSEN
            // ---------------------------------------------------------
            
            $stmt = $pdo->prepare("INSERT INTO dosen (admin_id, nip, nidn, nama, email, program_studi, foto, sinta_id, google_scholar_id, linkedin_url, pendidikan, sertifikasi, metadata, jenis_kelamin, jabatan_fungsional, tempat_lahir, tanggal_lahir, nomor_hp, alamat_kantor, nomor_telepon_faks, lulusan_dihasilkan, mata_kuliah_diampu) VALUES (:admin_id, :nip, :nidn, :nama, :email, :program_studi, :foto, :sinta_id, :google_scholar_id, :linkedin_url, :pendidikan, :sertifikasi, :metadata, :jenis_kelamin, :jabatan_fungsional, :tempat_lahir, :tanggal_lahir, :nomor_hp, :alamat_kantor, :nomor_telepon_faks, :lulusan_dihasilkan, :mata_kuliah_diampu) RETURNING id");
            
            $params = [
                'admin_id' => $data['admin_id'], // Ini ID admin yang menginput data (creator)
                'nip' => $data['nip'],
                'nidn' => $data['nidn'],
                'nama' => $data['nama'],
                'email' => $data['email'],
                'program_studi' => $data['program_studi'],
                'foto' => $data['foto'],
                'sinta_id' => $data['sinta_id'],
                'google_scholar_id' => $data['google_scholar_id'],
                'linkedin_url' => $data['linkedin_url'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'jabatan_fungsional' => $data['jabatan_fungsional'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'nomor_hp' => $data['nomor_hp'],
                'alamat_kantor' => $data['alamat_kantor'],
                'nomor_telepon_faks' => $data['nomor_telepon_faks'],
                'lulusan_dihasilkan' => $data['lulusan_dihasilkan'],
                'mata_kuliah_diampu' => $data['mata_kuliah_diampu'],
                'pendidikan' => $data['pendidikan'],
                'sertifikasi' => $data['sertifikasi'],
                'metadata' => $data['metadata'],
            ];
            
            $stmt->execute($params);
            $new_dosen_id = $stmt->fetchColumn();
    
            // ---------------------------------------------------------
            // LANGKAH 3: SIMPAN RELASI BIDANG KEAHLIAN
            // ---------------------------------------------------------

            if (!empty($data2['bidangs'])) {
                $data_bidang = $data2['bidangs'];
                $stmt_link = $pdo->prepare("INSERT INTO dosen_bidang_keahlian (dosen_id, bidang_id) VALUES (:dosen_id, :bidang_id)");
                foreach ($data_bidang as $id_bidang) {
                    $stmt_link->execute([':dosen_id' => $new_dosen_id, ':bidang_id' => $id_bidang]);
                }
            }
    
            // Simpan semua perubahan
            $pdo->commit();

        } catch (PDOException $e) {
            // Batalkan semua jika ada error
            $pdo->rollBack();
            throw new Exception("Gagal tambah dosen & akun: " . $e->getMessage());
        }
    }

    public static function update($id, $data, $data2)
    {
        global $pdo;

        try {
            $pdo->beginTransaction(); 

            $stmt = $pdo->prepare('UPDATE dosen SET admin_id=:admin_id, nip=:nip, nidn=:nidn, nama=:nama, email=:email, program_studi=:program_studi, foto=:foto, sinta_id=:sinta_id, google_scholar_id=:google_scholar_id, linkedin_url=:linkedin_url, pendidikan=:pendidikan, sertifikasi=:sertifikasi, metadata=:metadata, jenis_kelamin=:jenis_kelamin, jabatan_fungsional=:jabatan_fungsional, tempat_lahir=:tempat_lahir, tanggal_lahir=:tanggal_lahir, nomor_hp=:nomor_hp, alamat_kantor=:alamat_kantor, nomor_telepon_faks=:nomor_telepon_faks, lulusan_dihasilkan=:lulusan_dihasilkan, mata_kuliah_diampu=:mata_kuliah_diampu WHERE id=:id');

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
                'jenis_kelamin' => $data['jenis_kelamin'],
                'jabatan_fungsional' => $data['jabatan_fungsional'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'nomor_hp' => $data['nomor_hp'],
                'alamat_kantor' => $data['alamat_kantor'],
                'nomor_telepon_faks' => $data['nomor_telepon_faks'],
                'lulusan_dihasilkan' => $data['lulusan_dihasilkan'],
                'mata_kuliah_diampu' => $data['mata_kuliah_diampu'],
                'pendidikan' => $data['pendidikan'],
                'sertifikasi' => $data['sertifikasi'],
                'metadata' => $data['metadata'],
                'id' => $id,
            ]);

            // Jika ada data bidang keahlian yang dikirim
            if (isset($data2['bidang_keahlian'])) {
                $data_bidang = $data2['bidang_keahlian'];
                
                // 1. DETACH (Hapus semua relasi lama)
                $stmt_delete = $pdo->prepare("DELETE FROM dosen_bidang_keahlian WHERE dosen_id = :dosen_id");
                $stmt_delete->execute([':dosen_id' => $id]);

                // 2. ATTACH (Sisipkan relasi baru)
                if (!empty($data_bidang)) {
                    $stmt_insert = $pdo->prepare("INSERT INTO dosen_bidang_keahlian (dosen_id, bidang_id) VALUES (:dosen_id, :bidang_id)");
                    foreach ($data_bidang as $id_bidang) {
                        $stmt_insert->execute([
                            ':dosen_id' => $id,
                            ':bidang_id' => $id_bidang
                        ]);
                    }
                }
            }

            $pdo->commit(); 

        } catch (PDOException $e) {
            $pdo->rollBack(); 
            throw new Exception("Gagal update dosen: " . $e->getMessage());
        }
    }

    public static function delete($id)
    {
        global $pdo;
        // Sebaiknya hapus relasi dulu sebelum hapus parent (kecuali sudah ON DELETE CASCADE di database)
        $stmt_relasi = $pdo->prepare('DELETE FROM dosen_bidang_keahlian WHERE dosen_id=?');
        $stmt_relasi->execute([$id]);

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
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0); 
    }
}