<?php
session_start();
include 'koneksi.php';

// Cek Login
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// 1. Panggil Header (Otomatis memuat Sidebar, Topbar, dan Buka Container)
include 'admin-header.php'; 
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Berita Sekolah</h1>
    <a href="tambah-berita" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Berita
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Berita & Artikel</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    $query = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <img src="img/<?= $row['gambar']; ?>" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                        </td>
                        <td class="font-weight-bold"><?= $row['judul']; ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
                        <td>
                            <a href="edit-berita.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm mb-1" title="Edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <a href="hapus-berita.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm btn-hapus" title="Hapus">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Script Hapus dengan konfirmasi
    const tombolHapus = document.querySelectorAll('.btn-hapus');
    tombolHapus.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');

            Swal.fire({
                title: 'Yakin mau dihapus?',
                text: "Berita yang dihapus tidak bisa kembali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });
    });
</script>

<?php 
// 3. Panggil Footer (Tutup Container & Load Script JS)
include 'admin-footer.php'; 
?>