<?php
session_start();
include 'koneksi.php';

// Cek Login
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// --- BAGIAN 1: Panggil Header & Sidebar SB Admin ---
include 'admin-header.php';
?>

<h1 class="h3 mb-4 text-gray-800">Data Guru</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="tambah-guru" class="btn btn-primary btn-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Guru
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    $query = mysqli_query($conn, "SELECT * FROM guru");
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><img src="img/<?= $row['foto']; ?>" width="50"></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['nip']; ?></td>
                            <td>
                                <a href="edit-guru.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="hapus-guru.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm btn-hapus">
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
    // Seleksi semua tombol dengan class 'btn-hapus'
    const tombolHapus = document.querySelectorAll('.btn-hapus');

    tombolHapus.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault(); // Matikan fungsi link asli sementara
            const href = this.getAttribute('href'); // Ambil link hapus-guru.php?id=...

            Swal.fire({
                title: 'Yakin mau menghapus?',
                text: "Data guru ini akan hilang selamanya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kalau user klik Ya, baru arahkan ke link hapus
                    document.location.href = href;
                }
            })
        });
    });
</script>

<?php
// --- BAGIAN 3: Panggil Footer & Script SB Admin ---
include 'admin-footer.php';
?>