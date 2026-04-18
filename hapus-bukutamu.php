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

// Eksekusi hapus data pesan dari database
$hapus = mysqli_query($conn, "DELETE FROM bukutamu WHERE id = '$id'");

// --- TAG KOMENTAR: 3. AMBIL DATA TERBARU UNTUK BACKGROUND ---
// Kita panggil ulang daftar pesan agar tabel tetap terisi di belakang pop-up
$query_background = mysqli_query($conn, "SELECT * FROM bukutamu ORDER BY id DESC");

include 'admin-header.php'; // Memastikan Sidebar & Topbar tetap muncul
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buku Tamu</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pesan Masuk</h6>
            <button class="btn btn-danger btn-sm disabled">
                <i class="fas fa-trash"></i> Hapus Terpilih
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th width="5%" class="text-center"><input type="checkbox" disabled></th>
                            <th width="5%">No</th>
                            <th width="20%">Nama & Email</th>
                            <th>Pesan</th>
                            <th width="15%">Tanggal</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (mysqli_num_rows($query_background) > 0) {
                            while ($row = mysqli_fetch_assoc($query_background)) {
                        ?>
                                <tr>
                                    <td class="text-center align-middle"><input type="checkbox" disabled></td>
                                    <td class="align-middle"><?= $no++; ?></td>
                                    <td class="align-middle">
                                        <div class="font-weight-bold"><?= $row['nama']; ?></div>
                                        <small class="text-muted"><?= $row['email']; ?></small>
                                    </td>
                                    <td class="align-middle"><?= $row['pesan']; ?></td>
                                    <td class="align-middle"><?= date('d/m/Y H:i', strtotime($row['tanggal'])); ?></td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-danger btn-sm disabled"><i class="fas fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Tidak ada pesan.</td></tr>";
                        }
                        ?>
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
            text: 'Pesan berhasil dihapus dari sistem.',
            icon: 'success',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            // Kembali ke halaman admin-bukutamu setelah sukses
            window.location.href = 'admin-bukutamu.php';
        });
    <?php else: ?>
        Swal.fire({
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat menghapus data.',
            icon: 'error',
            confirmButtonColor: '#e74a3b'
        }).then((result) => {
            window.location.href = 'admin-bukutamu.php';
        });
    <?php endif; ?>
</script>

<?php 
// --- TAG KOMENTAR: PANGGIL FOOTER ---
include 'admin-footer.php'; 
?>