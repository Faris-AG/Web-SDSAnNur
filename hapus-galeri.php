<?php
session_start();
include 'koneksi.php';

// --- TAG KOMENTAR: 1. CEK LOGIN ---
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// --- TAG KOMENTAR: 2. LOGIKA PENGHAPUSAN (DIJALANKAN DI AWAL) ---
$id = $_GET['id'];
$cek = mysqli_query($conn, "SELECT * FROM galeri WHERE id = '$id'");
$data_hapus = mysqli_fetch_assoc($cek);

if ($data_hapus) {
    // Hapus file fisik di folder img
    $foto_lama = "img/" . $data_hapus['gambar'];
    if (file_exists($foto_lama)) {
        unlink($foto_lama);
    }
    // Hapus data di database
    $hapus = mysqli_query($conn, "DELETE FROM galeri WHERE id = '$id'");
}

// --- TAG KOMENTAR: 3. AMBIL DATA UNTUK TAMPILAN BACKGROUND ---
// Kita ambil data terbaru agar tabel/grid di belakang pop-up terisi kembali
$query = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");

include 'admin-header.php'; 
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Galeri Kegiatan</h1>
        <button class="btn btn-primary shadow-sm disabled">
            <i class="fas fa-plus fa-sm text-white-50"></i> Upload Foto Baru
        </button>
    </div>

    <div class="row">
        <?php
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
        ?>
                <div class="col-md-3 mb-4">
                    <div class="card shadow h-100">
                        <img src="img/<?= $row['gambar']; ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="font-weight-bold text-primary"><?= $row['judul']; ?></h6>
                            <p class="small text-muted mb-2"><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($row['tanggal'])); ?></p>
                            <button class="btn btn-warning btn-sm btn-block mb-2 disabled"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-sm btn-block disabled"><i class="fas fa-trash"></i> Hapus</button>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<div class="col-12 text-center text-gray-500">Belum ada foto galeri.</div>';
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($hapus): ?>
        Swal.fire({
            title: 'Terhapus!',
            text: 'Data galeri berhasil dihapus.',
            icon: 'success',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            window.location.href = 'admin-galeri.php';
        });
    <?php else: ?>
        Swal.fire({
            title: 'Gagal!',
            text: 'Data tidak ditemukan atau gagal dihapus.',
            icon: 'error',
            confirmButtonColor: '#e74a3b'
        }).then((result) => {
            window.location.href = 'admin-galeri.php';
        });
    <?php endif; ?>
</script>

<?php include 'admin-footer.php'; ?>