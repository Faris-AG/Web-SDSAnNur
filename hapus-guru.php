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

// Ambil data foto agar bisa menghapus file fisik di folder img
$ambil = mysqli_query($conn, "SELECT foto FROM guru WHERE id = '$id'");
$data_lama = mysqli_fetch_assoc($ambil);

if ($data_lama) {
    $foto_lama = $data_lama['foto'];
    if (!empty($foto_lama) && file_exists("img/$foto_lama")) {
        unlink("img/$foto_lama"); // Menghapus file foto asli
    }
}

// Eksekusi hapus data dari database
$hapus = mysqli_query($conn, "DELETE FROM guru WHERE id = '$id'");

// --- TAG KOMENTAR: 3. AMBIL DATA TERBARU UNTUK BACKGROUND ---
// Kita panggil ulang data guru agar tabel di belakang pop-up tetap terisi
$query_background = mysqli_query($conn, "SELECT * FROM guru");

include 'admin-header.php'; // Memanggil Sidebar & Topbar SB Admin
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Guru</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary btn-sm disabled">
                <i class="fas fa-plus fa-sm"></i> Tambah Guru
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>NIP</th>
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
                                <td><img src="img/<?= $row['foto']; ?>" width="50" class="img-thumbnail"></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['nip']; ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm disabled"><i class="fas fa-edit"></i> Edit</button>
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
            text: 'Data guru berhasil dihapus dari sistem.',
            icon: 'success',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            // Kembali ke halaman admin-guru setelah sukses
            window.location.href = 'admin-guru.php';
        });
    <?php else: ?>
        Swal.fire({
            title: 'Gagal!',
            text: 'Data tidak dapat dihapus, silakan periksa database.',
            icon: 'error',
            confirmButtonColor: '#e74a3b'
        }).then((result) => {
            window.location.href = 'admin-guru.php';
        });
    <?php endif; ?>
</script>

<?php 
// --- TAG KOMENTAR: PANGGIL FOOTER ---
include 'admin-footer.php'; 
?>