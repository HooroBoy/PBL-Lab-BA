<?php 
require_once __DIR__ . '/../../config/database.php';

class Publikasi 
{
    public static function all()
    {
        global $pdo;
        // $stmt = $pdo->query("SELECT * from publikasi");
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $pdo->query("SELECT p.id AS id_publikasi, p.judul AS judul, p.jenis_publikasi AS jenis_publikasi, d.nama AS nama_dosen, pp.peran AS peran FROM publikasi p INNER JOIN publikasi_penulis pp ON p.id = pp.publikasi_id INNER JOIN dosen d ON pp.dosen_id = d.id ORDER BY p.id DESC");
        $relasi_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $publikasi_terstruktur = [];

        foreach ($relasi_list as $row) {
            $id_publikasi = $row['id_publikasi'];

            if (!isset($publikasi_terstruktur[$id_publikasi])) {
                $publikasi_terstruktur[$id_publikasi] = [
                    'id_publikasi' => $row['id_publikasi'],
                    'judul' => $row['judul'],
                    'jenis_publikasi' => $row['jenis_publikasi'],
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

    public static function allByDosen($id)
    {
        global $pdo;
        // $stmt = $pdo->query("SELECT * from publikasi");
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $stmt = $pdo->prepare("SELECT p.id AS id_publikasi, p.judul AS judul, p.jenis_publikasi AS jenis_publikasi, d.nama AS nama_dosen, pp.peran AS peran FROM publikasi p INNER JOIN publikasi_penulis pp ON p.id = pp.publikasi_id INNER JOIN dosen d ON pp.dosen_id = d.id WHERE pp.dosen_id = :dosen_id AND pp.peran = :peran ORDER BY p.id DESC");
        // $stmt->execute([':dosen_id' => $id, ':peran' => 'Ketua Penulis']);
        $stmt = $pdo->prepare("SELECT p.id AS id_publikasi, p.judul AS judul, p.jenis_publikasi AS jenis_publikasi, d.nama AS nama_dosen, pp.peran AS peran FROM publikasi p INNER JOIN publikasi_penulis pp ON p.id = pp.publikasi_id INNER JOIN dosen d ON pp.dosen_id = d.id WHERE pp.dosen_id = :dosen_id ORDER BY p.id DESC");
        $stmt->execute([':dosen_id' => $id]);

        $relasi_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $publikasi_terstruktur = [];

        foreach ($relasi_list as $row) {
            $id_publikasi = $row['id_publikasi'];

            if (!isset($publikasi_terstruktur[$id_publikasi])) {
                $publikasi_terstruktur[$id_publikasi] = [
                    'id_publikasi' => $row['id_publikasi'],
                    'judul' => $row['judul'],
                    'jenis_publikasi' => $row['jenis_publikasi'],
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

    public static function ketuaSelected($id)
    {
        global $pdo;
        $stmt_selected = $pdo->prepare("SELECT dosen_id FROM publikasi_penulis WHERE publikasi_id = :id AND peran = :peran");
        $stmt_selected->execute([':id' => $id, ':peran' => 'Ketua Penulis']);
        return $stmt_selected->fetchAll(PDO::FETCH_COLUMN, 0); // Ambil hanya kolom dosen_id
    }

    public static function anggotaSelected($id)
    {
        global $pdo;
        $stmt_selected = $pdo->prepare("SELECT dosen_id FROM publikasi_penulis WHERE publikasi_id = :id AND peran = :peran");
        $stmt_selected->execute([':id' => $id, ':peran' => 'Penulis Anggota']);
        return $stmt_selected->fetchAll(PDO::FETCH_COLUMN, 0); // Ambil hanya kolom dosen_id
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

    public static function update($id, $data, $data2)
    {
        global $pdo;

        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("UPDATE publikasi SET kategori_id=:kategori_id, judul=:judul, jenis_publikasi=:jenis_publikasi, nama_penerbit=:nama_penerbit, tahun_terbit=:tahun_terbit, doi=:doi, link_dokumen=:link_dokumen, deskripsi=:deskripsi WHERE id=:id");
            $stmt->execute($data);

            $stmt_delete = $pdo->prepare("DELETE FROM publikasi_penulis WHERE publikasi_id = :publikasi_id");
            $stmt_delete->execute([':publikasi_id' => $id]);

            // Ambil data ketua penulis
            $dataKetua = explode('|', $data2['ketua_penulis']);
            $idKetua = $dataKetua[0];
            $urutanKetua = $dataKetua[1];
            $peranKetua = $dataKetua[2];

            // Masukkan ketua penulis di tabel relasi publikasi_penulis
            $stmt_link = $pdo->prepare("INSERT INTO publikasi_penulis (publikasi_id, dosen_id, urutan_penulis, peran) VALUES (:publikasi_id, :dosen_id, :urutan_penulis, :peran)");
            $stmt_link->execute([':publikasi_id' => $id, ':dosen_id' => $idKetua, ':urutan_penulis' => $urutanKetua, ':peran' => $peranKetua]);

            // Ambil data penulis anggota
            $dataAnggota = $data2['penulis_anggota'];
            $iteration = 2;

            foreach ($dataAnggota as $anggota) {
                $anggotaExplode = explode('|',$anggota);
                $idAnggota = $anggotaExplode[0];
                $urutanAnggota = $iteration++;
                $peranAnggota = $anggotaExplode[2];

                $stmt_link->execute([':publikasi_id' => $id, ':dosen_id' => $idAnggota, ':urutan_penulis' => $urutanAnggota, ':peran' => $peranAnggota]);
            }

            // Commit Transaksi (Menyimpan permanen)
            $pdo->commit();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public static function delete($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM publikasi WHERE id=?');
        $stmt->execute([$id]);
    }
}
?>