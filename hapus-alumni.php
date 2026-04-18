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

// Ambil data foto alumni agar bisa menghapus file fisik di folder img
$ambil = mysqli_query($conn, "SELECT foto FROM alumni WHERE id = '$id'");
$data_lama = mysqli_fetch_assoc($ambil);

if ($data_lama) {
    $foto_lama = $data_lama['foto'];
    if (!empty($foto_lama) && file_exists("img/$foto_lama")) {
        unlink("img/$foto_lama"); // Hapus file fisik foto
    }
}

// Eksekusi hapus data dari database
$hapus = mysqli_query($conn, "DELETE FROM alumni WHERE id = '$id'");

// --- TAG KOMENTAR: 3. AMBIL DATA TERBARU UNTUK BACKGROUND ---
// Kita panggil ulang data alumni agar tabel di belakang pop-up tetap terisi
$query_background = mysqli_query($conn, "SELECT * FROM alumni ORDER BY status_akun ASC, id DESC");

include 'admin-header.php'; // Memanggil Sidebar & Topbar SB Admin
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Alumni</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Alumni Masuk</h6>
            <button type="button" class="btn btn-danger btn-sm" disabled>
                <i class="fas fa-trash"></i> Hapus Terpilih
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th width="5%" class="text-center"><input type="checkbox" disabled></th>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama & Angkatan</th>
                            <th>Pekerjaan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query_background)) {
                        ?>
                            <tr>
                                <td class="text-center align-middle"><input type="checkbox" disabled></td>
                                <td class="align-middle"><?= $no++; ?></td>
                                <td class="align-middle text-center">
                                    <?php if ($row['foto'] != "") { ?>
                                        <img src="img/<?= $row['foto']; ?>" width="50" height="50" class="rounded-circle border shadow-sm" style="object-fit: cover;">
                                    <?php } else { ?>
                                        <span class="badge badge-secondary">No img</span>
                                    <?php } ?>
                                </td>
                                <td class="align-middle">
                                    <div class="font-weight-bold text-dark"><?= $row['nama']; ?></div>
                                    <small class="text-muted">Lulus: <?= $row['tahun_lulus']; ?></small>
                                </td>
                                <td class="align-middle"><?= $row['status']; ?></td>
                                <td class="text-center align-middle">
                                    <?php if ($row['status_akun'] == 'pending') { ?>
                                        <span class="badge badge-warning text-dark px-3 py-2">Menunggu</span>
                                    <?php } else { ?>
                                        <span class="badge badge-success px-3 py-2">Aktif</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center align-middle">
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
            text: 'Data alumni berhasil dihapus.',
            icon: 'success',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            // Kembali ke halaman utama admin-alumni
            window.location.href = 'admin-alumni.php';
        });
    <?php else: ?>
        Swal.fire({
            title: 'Gagal!',
            text: 'Data tidak dapat dihapus, silakan periksa database.',
            icon: 'error',
            confirmButtonColor: '#e74a3b'
        }).then((result) => {
            window.location.href = 'admin-alumni.php';
        });
    <?php endif; ?>
</script>

<?php 
// --- TAG KOMENTAR: PANGGIL FOOTER ---
include 'admin-footer.php'; 
?>