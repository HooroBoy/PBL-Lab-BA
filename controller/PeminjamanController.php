<?php 
include_once '../model/Peminjaman.php';

class PeminjamanController {

    // Mengembalikan array pesan (type,msg)
    public static function insertJadwal($nama, $no_induk, $tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai, $keperluan) {

        // Server-side validation dasar
        if (!$nama || !$no_induk || !$tanggal_mulai || !$tanggal_selesai || !$jam_mulai || !$jam_selesai || !$keperluan) {
            return ['type' => 'danger', 'msg' => 'Semua field wajib diisi.'];
        }

        // pastikan tanggal/jam masuk akal
        $startDatetime = $tanggal_mulai . ' ' . $jam_mulai;
        $endDatetime   = $tanggal_selesai . ' ' . $jam_selesai;
        if (strtotime($startDatetime) === false || strtotime($endDatetime) === false) {
            return ['type' => 'danger', 'msg' => 'Format tanggal/jam tidak valid.'];
        }
        if (strtotime($startDatetime) >= strtotime($endDatetime)) {
            return ['type' => 'danger', 'msg' => 'Waktu mulai harus lebih kecil dari waktu selesai.'];
        }

        // Cek ketersediaan slot
        if (!self::isSlotAvailable($tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai)) {
            return ['type' => 'danger', 'msg' => 'Gagal! Jadwal bertabrakan (overlap) dengan peminjaman lain.'];
        }

        // Simpan
        $ok = Peminjaman::create($nama, $no_induk, $tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai, $keperluan);

        if ($ok) {
            return ['type' => 'success', 'msg' => 'Pengajuan berhasil dikirim!'];
        } else {
            return ['type' => 'danger', 'msg' => 'Terjadi kesalahan saat menyimpan data.'];
        }
    }

    // Cek overlap dengan rule: existing_start < new_end AND existing_end > new_start
    public static function isSlotAvailable($tgl_mulai, $tgl_selesai, $jam_mulai, $jam_selesai) {
        global $pdo;

        // Kita akan membandingkan timestamp: (tanggal + jam)
        $sql = "
            SELECT COUNT(*) FROM peminjaman
            WHERE status IN ('diterima','menunggu')
            AND (
                ( (tanggal_mulai + jam_mulai) < ( :new_end::date + :new_end_time::time ) )
                AND
                ( (tanggal_selesai + jam_selesai) > ( :new_start::date + :new_start_time::time ) )
            );
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':new_start'      => $tgl_mulai,
            ':new_start_time' => $jam_mulai,
            ':new_end'        => $tgl_selesai,
            ':new_end_time'   => $jam_selesai
        ]);

        $count = (int) $stmt->fetchColumn();
        return $count === 0;
    }
}
?>