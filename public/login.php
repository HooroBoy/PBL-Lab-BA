<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Sistem</title>

    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon" />
    
    <link rel="stylesheet" href="./assets/compiled/css/app.css" />
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="./assets/compiled/css/auth.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    include_once __DIR__ .'/../config/database.php';
    session_start();

    // Cek jika user sudah login
    if (isset($_SESSION['user_id'])) {
        header('Location: /PBL-Lab-BA/admin/index.php?halaman=beranda');
        exit;
    }

    try {
        if (isset($_POST['login'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            // 1. Ambil data user dari tabel admin
            $sql = "SELECT * FROM admin WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':username' => $username]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                // 2. Verifikasi Password
                if (password_verify($password, $data['password'])) {
                    
                    // --- SETUP SESSION ---
                    $_SESSION['user_id'] = $data['id']; // ID tabel admin
                    $_SESSION['nama']    = $data['nama'];
                    $_SESSION['role']    = $data['role']; // Simpan Role (admin/dosen)
                    $_SESSION["timeout"] = time() + (24 * 60 * 60);

                    // 3. LOGIKA KHUSUS DOSEN (MODIFIKASI: CEK BY NIP)
                    if ($data['role'] == 'dosen') {
                        // Logika Baru: Cari data dosen berdasarkan NIP (username)
                        // Karena Username login dosen = NIP
                        $stmtDosen = $pdo->prepare("SELECT id FROM dosen WHERE nip = :nip");
                        $stmtDosen->execute([':nip' => $data['username']]); 
                        $dosenData = $stmtDosen->fetch(PDO::FETCH_ASSOC);
                        
                        // Simpan dosen_id ke session
                        $_SESSION['dosen_id'] = $dosenData ? $dosenData['id'] : null;

                        // Opsional: Jika data ketemu tapi admin_id di tabel dosen masih kosong/salah,
                        // kita bisa perbaiki sekalian (Auto-fix relation)
                        if ($dosenData) {
                             $fixRelasi = $pdo->prepare("UPDATE dosen SET admin_id = :uid WHERE id = :did");
                             $fixRelasi->execute([':uid' => $data['id'], ':did' => $dosenData['id']]);
                        }
                    }

                    // 4. Update last_login
                    $updateLogin = $pdo->prepare("UPDATE admin SET last_login = NOW() WHERE id = :id");
                    $updateLogin->execute([':id' => $data['id']]);

                    // Alert Sukses
                    echo "
                    <script>
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Login Berhasil! Selamat Datang, " . htmlspecialchars($data['nama']) . "',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    }).then(() => {
                        window.location.href = '/PBL-Lab-BA/admin/index.php?halaman=beranda';
                    })
                    </script>
                    ";
                } else {
                    // Password Salah
                    echo "
                    <script>
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Password yang anda masukkan salah!',
                        icon: 'error',
                        showConfirmButton: true,
                        timer: 2000
                    })
                    </script>
                    ";
                }
            } else {
                // Akun Tidak Ditemukan
                echo "
                <script>
                Swal.fire({
                    title: 'Gagal',
                    text: 'Username tidak ditemukan!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                })
                </script>
                ";
            }
        }
    } catch (Exception $th) {
        echo "
            <script>
            Swal.fire({
                title: 'Error',
                text: 'Terjadi kesalahan server: " . $th->getMessage() . "',
                icon: 'error'
            })
            </script>
            ";
    }
    ?>
    
    <script src="assets/static/js/initTheme.js"></script>
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #124874 0%, #2563eb 100%);
        }
        .center-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(60,72,88,0.16);
            padding: 48px 40px 40px 40px;
            min-width: 340px;
            max-width: 520px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .maskot-img {
            width: 110px;
            height: 110px;
            object-fit: contain;
            margin-bottom: 28px;
            margin-top: -10px;
            border-radius: 50%;
            background: #f3f6fa;
            box-shadow: 0 2px 8px rgba(60,72,88,0.10);
        }
        .login-card h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1e293b;
            text-align: center;
        }
        .login-card p {
            color: #64748b;
            margin-bottom: 32px;
            text-align: center;
        }
        .login-card input {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 18px;
            width: 100%;
            margin-bottom: 24px;
            font-size: 1.15rem;
            background: #f8fafc;
        }
        .login-card button {
            width: 100%;
            padding: 18px;
            border-radius: 8px;
            background: #2563eb;
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            box-shadow: 0 2px 8px rgba(37,99,235,0.10);
            margin-top: 12px;
            transition: background 0.2s;
        }
        .login-card button:hover {
            background: #1d4ed8;
        }
        .login-card .register-link {
            margin-top: 24px;
            text-align: center;
            color: #6b7280;
            font-size: 1.08rem;
        }
        .login-card .register-link a {
            color: #2563eb;
            font-weight: 500;
            text-decoration: none;
        }
        @media (max-width: 600px) {
            .login-card {
                min-width: 90vw;
                max-width: 95vw;
                border-radius: 12px;
                padding: 18px 6vw 12px 6vw;
            }
            .maskot-img {
                width: 56px;
                height: 56px;
                margin-bottom: 10px;
            }
            .login-card h1 {
                font-size: 1.1rem;
            }
            .login-card p {
                font-size: 0.95rem;
                margin-bottom: 12px;
            }
            .login-card input {
                font-size: 0.95rem;
                padding: 10px;
                margin-bottom: 10px;
            }
            .login-card button {
                font-size: 0.95rem;
                padding: 10px;
            }
            .login-card .register-link {
                font-size: 0.92rem;
                margin-top: 8px;
            }
        }
    </style>
    <div class="center-container">
        <div class="login-card">
            <img src="./assets/compiled/png/maskot.png" alt="Logo Maskot" class="maskot-img" />
            <h1>Selamat Datang!</h1> 
            <p>Silakan masuk menggunakan akun yang terdaftar.</p>
            
            <form action="" method="post" style="width:100%">
                <input type="text" placeholder="Username / NIP" name="username" required />
                <input type="password" placeholder="Password" name="password" required />
                <button type="submit" name="login">Masuk</button>
            </form>
            
            <div class="register-link">
                Belum punya akun? <a href="register.php">Daftar Sekarang</a>.
            </div>
        </div>
    </div>
</body>

</html>