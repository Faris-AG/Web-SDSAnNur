<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// Menangkap nilai filter dari URL (jika ada)
$filter_status = isset($_GET['status']) ? mysqli_real_escape_string($conn, $_GET['status']) : '';

include 'admin-header.php';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Data PPDB</h1>
    <a href="laporan-ppdb.php?status=<?= $filter_status ?>" class="btn btn-success shadow-sm">
        <i class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Calon Siswa Terdaftar</h6>
            </div>
            <div class="col-md-3">
                <form action="" method="GET" id="filterForm">
                    <select name="status" class="form-control form-control-sm" onchange="document.getElementById('filterForm').submit()">
                        <option value="">-- Filter Semua Status --</option>
                        <option value="Pending" <?= $filter_status == 'Pending' ? 'selected' : ''; ?>>Pending (Menunggu)</option>
                        <option value="Diterima" <?= $filter_status == 'Diterima' ? 'selected' : ''; ?>>Diterima</option>
                        <option value="Ditolak" <?= $filter_status == 'Ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
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
                    
                    // Modifikasi Query berdasarkan Filter
                    $sql = "SELECT * FROM ppdb";
                    if ($filter_status != '') {
                        $sql .= " WHERE status = '$filter_status'";
                    }
                    $sql .= " ORDER BY id DESC";
                    
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
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
                        <td>
                            <a href="https://wa.me/62<?= substr($row['no_hp'], 1); ?>" target="_blank" class="text-success">
                                <i class="fab fa-whatsapp"></i> <?= $row['no_hp']; ?>
                            </a>
                        </td>
                        <td class="text-center">
                            <?php if($row['status'] == 'Pending'): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php elseif($row['status'] == 'Diterima'): ?>
                                <span class="badge badge-success">Diterima</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Ditolak</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="detail-ppdb.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="hapus-ppdb.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm btn-hapus" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
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
    const tombolHapus = document.querySelectorAll('.btn-hapus');
    tombolHapus.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');

            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: "Data siswa akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });
    });
</script>

<?php include 'admin-footer.php'; ?>