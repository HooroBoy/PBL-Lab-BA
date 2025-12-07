    <?php
include_once __DIR__ . '/../models/Peminjaman.php';

    class PeminjamanController
    {
        // Mengembalikan array pesan (type,msg)
        public static function insertJadwal($nama, $no_induk, $tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai, $keperluan, $no_wa)
        {
            // Server-side validation dasar
            if (!$nama || !$no_induk || !$tanggal_mulai || !$tanggal_selesai || !$jam_mulai || !$jam_selesai || !$keperluan || !$no_wa) {
                return ['type' => 'danger', 'msg' => 'Semua field wajib diisi.'];
            }

            // pastikan tanggal/jam masuk akal
            $startDatetime = $tanggal_mulai . ' ' . $jam_mulai;
            $endDatetime   = $tanggal_selesai . ' ' . $jam_selesai;
            $startTimeInt = strtotime($jam_mulai);
            $endTimeInt   = strtotime($jam_selesai);

            // Jika jam tidak valid
            if ($startTimeInt === false || $endTimeInt === false) {
                return [
                    'type' => 'danger',
                    'msg'  => 'Jam mulai atau jam selesai tidak valid.'
                ];
            }

            // VALIDASI TANGGAL & JAM (SIMPLE)
            if ($tanggal_selesai < $tanggal_mulai) {
                return [
                    'type' => 'danger',
                    'msg'  => 'Tanggal selesai tidak boleh lebih kecil dari tanggal mulai.'
                ];
            }

            // 1. Jika tanggal sama → endTime > startTime
            if ($tanggal_mulai === $tanggal_selesai) {
                if ($endTimeInt <= $startTimeInt) {
                    return [
                        'type' => 'danger',
                        'msg'  => 'Jam selesai harus lebih besar dari jam mulai pada tanggal yang sama.'
                    ];
                }
            }

            // 2. Jika tanggal berbeda → jam selesai tidak boleh lebih kecil dari jam mulai
            if ($tanggal_selesai > $tanggal_mulai) {
                if ($endTimeInt < $startTimeInt) {
                    return [
                        'type' => 'danger',
                        'msg'  => 'Jam selesai tidak boleh lebih kecil dari jam mulai meskipun tanggal berbeda.'
                    ];
                }
            }

            // Cek ketersediaan slot
            if (!self::isSlotAvailable($tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai)) {
                return ['type' => 'danger', 'msg' => 'Gagal! Jadwal bertabrakan (overlap) dengan peminjaman lain.'];
            }

            // Simpan
            $ok = Peminjaman::create($nama, $no_induk, $tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai, $keperluan, $no_wa);

            if ($ok) {
                return ['type' => 'success', 'msg' => 'Pengajuan berhasil dikirim!'];
            } else {
                return ['type' => 'danger', 'msg' => 'Terjadi kesalahan saat menyimpan data.'];
            }
        }

        // Cek overlap dengan rule: existing_start < new_end AND existing_end > new_start
        public static function isSlotAvailable($tgl_mulai, $tgl_selesai, $jam_mulai, $jam_selesai)
        {
            global $pdo;

            $sql = "
            SELECT COUNT(*)
            FROM peminjaman
            WHERE status IN ('diterima','menunggu')
            AND tanggal_mulai = :tanggal
            
            AND (
                    jam_mulai < :jam_selesai
                AND jam_selesai > :jam_mulai
            );
        ";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':tanggal'      => $tgl_mulai,   // hanya cek untuk tanggal mulai
                ':jam_mulai'    => $jam_mulai,
                ':jam_selesai'  => $jam_selesai
            ]);

            return $stmt->fetchColumn() == 0;
        }
        public static function fetchAll(){
            global $pdo;
            $query = "SELECT * FROM peminjaman";
            $stmt =  $pdo->query($query)->fetchAll();
            return $stmt;
        }

        public static function find($id){
            global $pdo;
            $stmt = $pdo->prepare('SELECT * FROM peminjaman WHERE id = ?');
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        public static function addJadwalTidakTersedia($tanggal, $jam, $keterangan, $admin_id)
        {
            if (empty($tanggal) || empty($keterangan)) {
                return ['type' => 'danger', 'msg' => 'Tanggal dan Keterangan wajib diisi!'];
            }

            $jam_fix = empty($jam) ? '00:00:00' : $jam;
            
            $waktu_input = $tanggal . ' ' . $jam_fix;

            try {
                JadwalTidakTersedia::createBlockedDate($waktu_input, $keterangan, $admin_id);
                
                return ['type' => 'success', 'msg' => 'Jadwal berhasil diblokir/ditambahkan.'];
            } catch (Exception $e) {
                return ['type' => 'danger', 'msg' => 'Gagal menyimpan: ' . $e->getMessage()];
            }
        }
        public static function SetStatus($id,$status,$alasan){
            Peminjaman::setStatus($id,$status,$alasan);
        }
    }
    ?>