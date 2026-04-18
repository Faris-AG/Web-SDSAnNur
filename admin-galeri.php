<?php
session_start();
include 'koneksi.php';

// Cek Login
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

include 'admin-header.php';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Galeri Kegiatan</h1>
    <a href="tambah-galeri" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Upload Foto Baru
    </a>
</div>

<div class="row">
    <?php
    $query = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
    ?>
            <div class="col-md-3 mb-4">
                <div class="card shadow h-100">
                    <img src="img/<?= $row['gambar']; ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h6 class="font-weight-bold text-primary"><?= $row['judul']; ?></h6>
                        <p class="small text-muted mb-2"><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($row['tanggal'])); ?></p>
                        <a href="edit-galeri.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm btn-block mb-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="hapus-galeri.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm btn-block btn-hapus">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const tombolHapus = document.querySelectorAll('.btn-hapus');
    tombolHapus.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            Swal.fire({
                title: 'Hapus Foto Ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) document.location.href = href;
            })
        });
    });
</script>

<?php include 'admin-footer.php'; ?>