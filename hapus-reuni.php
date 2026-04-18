<?php
session_start();
include 'koneksi.php';

// --- TAG KOMENTAR: 1. CEK LOGIN ---
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// --- TAG KOMENTAR: 2. LOGIKA HAPUS DATA ---
$id = $_GET['id'];

// Ambil data foto reuni agar bisa menghapus file fisik di folder img
$cek = mysqli_query($conn, "SELECT foto FROM info_reuni WHERE id = '$id'");
$data_lama = mysqli_fetch_assoc($cek);

if ($data_lama) {
    $foto_lama = $data_lama['foto'];
    // Hapus file fisik jika ada dan bukan gambar default
    if ($foto_lama != 'default_reuni.jpg' && file_exists("img/$foto_lama")) {
        unlink("img/$foto_lama");
    }
}

// Eksekusi hapus data dari database
$hapus = mysqli_query($conn, "DELETE FROM info_reuni WHERE id = '$id'");

// --- TAG KOMENTAR: 3. AMBIL DATA TERBARU UNTUK BACKGROUND ---
// Memanggil ulang data agar tabel di belakang pop-up tetap terisi
$query_background = mysqli_query($conn, "SELECT * FROM info_reuni ORDER BY id DESC");

include 'admin-header.php'; // Memastikan Sidebar & Topbar tetap muncul
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Agenda Reuni</h1>
        <button class="btn btn-primary shadow-sm disabled">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Agenda Baru
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Acara Reuni</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Acara</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query_background)) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['judul_acara']; ?></td>
                                <td><?= date('d/m/Y', strtotime($row['tanggal_acara'])); ?></td>
                                <td><?= $row['lokasi']; ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm disabled"><i class="fas fa-edit mb-1"></i> Edit</button>
                                    <button class="btn btn-danger btn-sm disabled"><i class="fas fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($hapus): ?>
        Swal.fire({
            title: 'Terhapus!',
            text: 'Agenda reuni berhasil dihapus.',
            icon: 'success',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            // Kembali ke halaman admin-reuni setelah sukses
            window.location.href = 'admin-reuni.php';
        });
    <?php else: ?>
        Swal.fire({
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat menghapus agenda.',
            icon: 'error',
            confirmButtonColor: '#e74a3b'
        }).then((result) => {
            window.location.href = 'admin-reuni.php';
        });
    <?php endif; ?>
</script>

<?php 
// --- TAG KOMENTAR: PANGGIL FOOTER ---
include 'admin-footer.php'; 
?>