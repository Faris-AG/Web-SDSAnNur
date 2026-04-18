<?php
session_start();
include 'koneksi.php';

// Variabel alert
$script_alert = "";

// Cek Tombol Login
if (isset($_POST['login'])) {
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Cek Database (MD5)
    $cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username' AND password = MD5('$password')");
    
    if (mysqli_num_rows($cek) > 0) {
        // --- LOGIN SUKSES ---
        $_SESSION['status_login'] = true;
        $_SESSION['nama_user'] = $username;
        
        $script_alert = "
        <script>
            Swal.fire({
                title: 'Login Berhasil!',
                text: 'Selamat datang kembali, Administrator.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location = 'dashboard.php';
            });
        </script>
        ";
    } else {
        // --- LOGIN GAGAL ---
        $script_alert = "
        <script>
            Swal.fire({
                title: 'Gagal Masuk',
                text: 'Username atau Password salah.',
                icon: 'error',
                confirmButtonColor: '#1cc88a'
            });
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Administrator Sekolah</title>

    <link rel="icon" type="image/x-icon" href="img/icon.png">

    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .btn-success {
            background-color: #1cc88a;
            border-color: #1cc88a;
        }
        .btn-success:hover {
            background-color: #17a673;
            border-color: #17a673;
        }
        .text-success {
            color: #1cc88a !important;
        }
    </style>
</head>

<body class="bg-gradient-success">

    <div class="container">

        <div class="row justify-content-center mt-5">

            <div class="col-xl-5 col-lg-6 col-md-8"> <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <img src="img/icon.png" alt="Logo Sekolah" style="width: 90px; height: auto;">
                                        </div>
                                        <h1 class="h4 text-gray-900 mb-2 font-weight-bold">PANEL ADMIN</h1>
                                        <p class="mb-4 text-muted small">Sistem Informasi Manajemen Sekolah</p>
                                    </div>
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user shadow-sm"
                                                id="exampleInputEmail" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user shadow-sm"
                                                id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        
                                        <button type="submit" name="login" class="btn btn-success btn-user btn-block mt-4 font-weight-bold">
                                            MASUK SISTEM
                                        </button>
                                    </form>
                                    
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-success font-weight-bold" href="./">
                                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Halaman Utama
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>

    <?= $script_alert; ?>

</body>
</html>