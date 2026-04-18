<?php
session_start();
include 'koneksi.php';

// cek apakah user sudah login
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// hitung jumlah data guru
$q_guru = mysqli_query($conn, "SELECT * FROM guru");
$jml_guru = mysqli_num_rows($q_guru);

// hitung jumlah berita
$q_berita = mysqli_query($conn, "SELECT * FROM berita");
$jml_berita = mysqli_num_rows($q_berita);

// hitung total alumni
$q_alumni = mysqli_query($conn, "SELECT * FROM alumni");
$jml_alumni = mysqli_num_rows($q_alumni);

// hitung alumni status pending
$q_alumni_pending = mysqli_query($conn, "SELECT * FROM alumni WHERE status_akun = 'pending'");
$jml_alumni_pending = mysqli_num_rows($q_alumni_pending);

// hitung pendaftar ppdb
$q_ppdb = mysqli_query($conn, "SELECT * FROM ppdb");
$jml_ppdb = mysqli_num_rows($q_ppdb);

// hitung pesan masuk
$q_bukutamu = mysqli_query($conn, "SELECT * FROM bukutamu");
$jml_bukutamu = mysqli_num_rows($q_bukutamu);

include 'admin-header.php';
?>

<?php
// notifikasi pesan baru
$q_pesan_baru = mysqli_query($conn, "SELECT * FROM bukutamu WHERE status = 'belum_dibaca'");
$jumlah_pesan_baru = mysqli_num_rows($q_pesan_baru);

if ($jumlah_pesan_baru > 0) {
?>
    <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
        <i class="fas fa-envelope-open-text me-2"></i>
        <strong>Halo Admin!</strong> Kamu memiliki <span class="badge badge-danger"><?= $jumlah_pesan_baru; ?></span> pesan baru di Buku Tamu.
        <a href="admin-bukutamu.php" class="alert-link">Lihat Pesan</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php
// notifikasi alumni pending
if ($jml_alumni_pending > 0) {
?>
    <div class="alert alert-info alert-dismissible fade show mb-4 border-left-info shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <div class="mr-3">
                <i class="fas fa-user-clock fa-2x text-info"></i>
            </div>
            <div>
                <h5 class="alert-heading font-weight-bold h6 mb-1">Verifikasi Diperlukan!</h5>
                <span>Ada <strong><?= $jml_alumni_pending; ?> Data Alumni Baru</strong> yang menunggu persetujuan Anda.</span>
                <br>
                <a href="admin-alumni.php" class="btn btn-sm btn-info mt-2 shadow-sm">
                    <i class="fas fa-arrow-right mr-1"></i> Periksa & Setujui Sekarang
                </a>
            </div>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
    <a href="/" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
        <i class="fas fa-globe fa-sm text-white-50"></i> Lihat Website Utama
    </a>
</div>

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Guru</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_guru; ?> Orang</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="admin-guru.php" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Berita & Artikel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_berita; ?> Postingan</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="admin-berita.php" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Alumni
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_alumni; ?> Terdaftar</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="admin-alumni.php" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pendaftar PPDB</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_ppdb; ?> Siswa</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="admin-ppdb.php" class="stretched-link"></a>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Pesan Yang Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_bukutamu; ?> Pesan</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="admin-bukutamu.php" class="stretched-link"></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang, Administrator!</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                        src="assets/img/undraw_posting_photo.svg" alt="...">
                </div>
                <p class="text-center">
                    Ini adalah Panel Admin Sekolah. Anda dapat mengelola data Guru, Berita, Alumni, dan Agenda Reuni melalui menu di sebelah kiri. <br>
                    Gunakan sistem ini dengan bijak untuk kemajuan informasi sekolah kita.
                </p>
            </div>
        </div>
    </div>
</div>

<?php include 'admin-footer.php'; ?>