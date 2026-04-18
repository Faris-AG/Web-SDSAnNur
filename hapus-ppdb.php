<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// 1. Eksekusi hapus data
$hapus = mysqli_query($conn, "DELETE FROM ppdb WHERE id = '$id'");

// 2. Ambil data terbaru untuk background (sinkronkan kolom dengan admin-ppdb.php)
$query_background = mysqli_query($conn, "SELECT * FROM ppdb ORDER BY id DESC");

include 'admin-header.php';
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Data PPDB</h1>
        <button class="btn btn-success shadow-sm disabled">
            <i class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Calon Siswa Terdaftar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>No. Reg</th>
                            <th>Nama Siswa</th>
                            <th>Orang Tua (Pendidikan)</th>
                            <th>No HP</th>
                            <th>Status</th>
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
                                <td><small class="badge badge-secondary"><?= $row['no_registrasi']; ?></small></td>
                                <td class="font-weight-bold"><?= $row['nama_siswa']; ?></td>
                                <td>
                                    <small>
                                        <b>Ayah:</b> <?= $row['nama_ayah']; ?> (<?= $row['pendidikan_ayah']; ?>)<br>
                                        <b>Ibu:</b> <?= $row['nama_ibu']; ?> (<?= $row['pendidikan_ibu']; ?>)
                                    </small>
                                </td>
                                <td><?= $row['no_hp']; ?></td>
                                <td class="text-center">
                                    <span class="badge badge-secondary"><?= $row['status']; ?></span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm disabled"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-danger btn-sm disabled"><i class="fas fa-trash"></i></button>
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
            text: 'Data calon siswa berhasil dihapus secara permanen.',
            icon: 'success',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            window.location.href = 'admin-ppdb.php';
        });
    <?php else: ?>
        Swal.fire({
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat menghapus data.',
            icon: 'error',
            confirmButtonColor: '#e74a3b'
        }).then((result) => {
            window.location.href = 'admin-ppdb.php';
        });
    <?php endif; ?>
</script>

<?php include 'admin-footer.php'; ?>