<?php 
require_once __DIR__ . '/../../config/database.php';

class Publikasi 
{
    public static function all()
    {
        global $pdo;
        // $stmt = $pdo->query("SELECT * from publikasi");
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $pdo->query("SELECT p.id AS id_publikasi, p.judul AS judul, p.jenis_publikasi AS jenis_publikasi, p.kategori_id, k.nama AS kategori_nama, d.nama AS nama_dosen, pp.peran AS peran FROM publikasi p INNER JOIN publikasi_penulis pp ON p.id = pp.publikasi_id INNER JOIN dosen d ON pp.dosen_id = d.id LEFT JOIN kategori_riset k ON p.kategori_id = k.id ORDER BY p.id DESC");
        $relasi_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $publikasi_terstruktur = [];

        foreach ($relasi_list as $row) {
            $id_publikasi = $row['id_publikasi'];

            if (!isset($publikasi_terstruktur[$id_publikasi])) {
                $publikasi_terstruktur[$id_publikasi] = [
                    'id_publikasi' => $row['id_publikasi'],
                    'judul' => $row['judul'],
                    'jenis_publikasi' => $row['jenis_publikasi'],
                    'kategori_id' => $row['kategori_id'],
                    'kategori_nama' => $row['kategori_nama'],
                    'dosen' => []
                ];
            }

            $publikasi_terstruktur[$id_publikasi]['dosen'][] = [
                'nama_dosen' => $row['nama_dosen'],
                'peran' => $row['peran'],
            ];
        }
        return $publikasi_terstruktur;
    }

    public static function find($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM publikasi WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data, $data2)
    {
        global $pdo;

        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO publikasi (kategori_id, judul, jenis_publikasi, nama_penerbit, tahun_terbit, doi, link_dokumen, deskripsi) VALUES (:kategori_id, :judul, :jenis_publikasi, :nama_penerbit, :tahun_terbit, :doi, :link_dokumen, :deskripsi) RETURNING id");
            $stmt->execute($data);

            // Ambil ID publikasi yang baru dibuat (PostgreSQL menggunakan RETURNING id)
            $new_publikasi_id = $stmt->fetchColumn();

            // Ambil data ketua penulis
            $dataKetua = explode('|', $data2['ketua_penulis']);
            $idKetua = $dataKetua[0];
            $urutanKetua = $dataKetua[1];
            $peranKetua = $dataKetua[2];

            // Masukkan ketua penulis di tabel relasi publikasi_penulis
            $stmt_link = $pdo->prepare("INSERT INTO publikasi_penulis (publikasi_id, dosen_id, urutan_penulis, peran) VALUES (:publikasi_id, :dosen_id, :urutan_penulis, :peran)");
            $stmt_link->execute([':publikasi_id' => $new_publikasi_id, ':dosen_id' => $idKetua, ':urutan_penulis' => $urutanKetua, ':peran' => $peranKetua]);

            // Ambil data penulis anggota
            $dataAnggota = $data2['penulis_anggota'];
            $iteration = 2;

            foreach ($dataAnggota as $anggota) {
                $anggotaExplode = explode('|',$anggota);
                $idAnggota = $anggotaExplode[0];
                $urutanAnggota = $iteration++;
                $peranAnggota = $anggotaExplode[2];

                $stmt_link->execute([':publikasi_id' => $new_publikasi_id, ':dosen_id' => $idAnggota, ':urutan_penulis' => $urutanAnggota, ':peran' => $peranAnggota]);
            }

            // Commit Transaksi (Menyimpan permanen)
            $pdo->commit();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public static function update($id, $data)
    {
        global $pdo;

        $query = "UPDATE publikasi
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
        $stmt = $pdo->prepare('DELETE FROM publikasi WHERE id=?');
        $stmt->execute([$id]);
    }

    public static function findByDosenId($dosen_id)
    {
        global $pdo;

        // Query untuk mengambil semua detail publikasi berdasarkan ID Dosen.
        // Kita juga perlu penulis (relasi publikasi_penulis) karena satu publikasi bisa punya banyak penulis.
        $stmt = $pdo->prepare("
            SELECT 
                p.id, 
                p.judul, 
                p.jenis_publikasi, 
                p.tahun_terbit,
                p.nama_penerbit,
                p.doi,
                pp.urutan_penulis,
                d.nama AS nama_penulis,
                d.id AS id_penulis
            FROM publikasi p
            INNER JOIN publikasi_penulis pp ON p.id = pp.publikasi_id
            INNER JOIN dosen d ON pp.dosen_id = d.id
            WHERE p.id IN (
                SELECT publikasi_id FROM publikasi_penulis WHERE dosen_id = :dosen_id_filter
            )
            ORDER BY p.tahun_terbit DESC, p.id DESC, pp.urutan_penulis ASC
        ");

        $stmt->execute([':dosen_id_filter' => $dosen_id]);
        $relasi_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $publikasi_terstruktur = [];

        foreach ($relasi_list as $row) {
            $id_publikasi = $row['id'];

            if (!isset($publikasi_terstruktur[$id_publikasi])) {
                $publikasi_terstruktur[$id_publikasi] = [
                    'id' => $row['id'],
                    'judul' => $row['judul'],
                    'jenis_publikasi' => $row['jenis_publikasi'],
                    'tahun_terbit' => $row['tahun_terbit'],
                    'nama_penerbit' => $row['nama_penerbit'],
                    'doi' => $row['doi'],
                    'penulis' => []
                ];
            }

            // Masukkan setiap penulis ke dalam array penulis publikasi
            $publikasi_terstruktur[$id_publikasi]['penulis'][] = [
                'nama' => $row['nama_penulis'],
                'id' => $row['id_penulis'],
                'urutan' => $row['urutan_penulis']
            ];
        }

        // Kembalikan dalam bentuk array list publikasi (bukan array asosiatif id => publikasi)
        return array_values($publikasi_terstruktur);
    }
}
?>