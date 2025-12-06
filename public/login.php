<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

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

    if (isset($_SESSION['nama'])) {
        header('Location: /PBL-Lab-BA/admin/index.php?halaman=beranda');
        exit;
    }

    try {
        if (isset($_POST['login'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $sql = "SELECT * FROM admin WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':username' => $username]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                if (password_verify($password, $data['password'])) {
                    $_SESSION['nama'] = $data['nama'];
                    $_SESSION["timeout"] = time() + (24 * 60 * 60);
                    $_SESSION['id'] = $data['id'];
                    // Update last_login
                    $updateLogin = $pdo->prepare("UPDATE admin SET last_login = NOW() WHERE id = :id");
                    $updateLogin->execute([':id' => $data['id']]);
                    echo "
            <script>
            Swal.fire({
                title: 'Berhasil',
                text: 'Berhasil Login!',
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
                    echo "
            <script>
            Swal.fire({
                title: 'Gagal',
                text: 'username / password yang anda masukkan salah!',
                icon: 'error',
                showConfirmButton: true,
                timer: 2000,
                timerProgressBar: true,
            }).then(() => {
                window.location.href = 'login.php';
            })
            </script>
            ";
                }
            } else {
                echo "
            <script>
            Swal.fire({
                title: 'Gagal',
                text: 'Akun yang anda masukkan tidak ada!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            }).then(() => {
                window.location.href = 'login.php';
            })
            </script>
            ";
            }
        }
    } catch (Exception $th) {
        echo "
            <script>
            Swal.fire({
                title: 'Gagal',
                text: 'Server error!',
                icon: 'error',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            }).then(() => {
                window.location.href = 'login.php';
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
            font-size: 2.5rem;
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
            <h1>Halo, Admin!</h1>
            <p>Masuk dengan data yang sudah anda daftarkan pada halaman register.</p>
            <form action="" method="post" style="width:100%">
                <input type="text" placeholder="Username" name="username" required />
                <input type="password" placeholder="Password" name="password" required />
                <button type="submit" name="login">Masuk</button>
            </form>
            <div class="register-link">
                Belum punya akun? <a href="register.php">Daftar</a>.
            </div>
        </div>
    </div>
</body>

</html>