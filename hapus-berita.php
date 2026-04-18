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

// Ambil data gambar agar bisa menghapus file fisik di folder img
$data = mysqli_query($conn, "SELECT gambar FROM berita WHERE id = '$id'");
$row_hapus = mysqli_fetch_assoc($data);

if ($row_hapus) {
    $foto_lama = "img/" . $row_hapus['gambar'];
    // Hapus file fisik foto jika ada dan bukan default
    if ($row_hapus['gambar'] != 'default.jpg' && file_exists($foto_lama)) {
        unlink($foto_lama);
    }
}

// Eksekusi hapus data dari database
$hapus = mysqli_query($conn, "DELETE FROM berita WHERE id = '$id'");

// --- TAG KOMENTAR: 3. AMBIL DATA TERBARU UNTUK BACKGROUND ---
// Kita panggil ulang daftar berita agar tabel di belakang pop-up tetap terisi
$query_background = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");

include 'admin-header.php'; // Memanggil Sidebar & Topbar SB Admin
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Berita Sekolah</h1>
        <button class="btn btn-primary shadow-sm disabled">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Berita
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Berita & Artikel</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Gambar</th>
                            <th>Judul Berita</th>
                            <th>Tanggal</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query_background)) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><img src="img/<?= $row['gambar']; ?>" width="80" class="img-thumbnail"></td>
                                <td><?= $row['judul']; ?></td>
                                <td><?= date('d/m/Y', strtotime($row['tanggal'])); ?></td>
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
            text: 'Berita berhasil dihapus dari sistem.',
            icon: 'success',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            // Kembali ke halaman admin-berita setelah sukses
            window.location.href = 'admin-berita.php';
        });
    <?php else: ?>
        Swal.fire({
            title: 'Gagal!',
            text: 'Data tidak ditemukan atau gagal dihapus.',
            icon: 'error',
            confirmButtonColor: '#e74a3b'
        }).then((result) => {
            window.location.href = 'admin-berita.php';
        });
    <?php endif; ?>
</script>

<?php 
// --- TAG KOMENTAR: PANGGIL FOOTER ---
include 'admin-footer.php'; 
?>