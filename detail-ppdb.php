<?php
session_start();
include 'koneksi.php';

// 1. Cek Login
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// 2. Ambil ID Siswa dari URL
$id = mysqli_real_escape_string($conn, $_GET['id']);

// 3. Logika Update Status (Jika tombol ditekan)
$update_sukses = false;
if (isset($_POST['update_status'])) {
    $status_baru = $_POST['status'];
    $update = mysqli_query($conn, "UPDATE ppdb SET status = '$status_baru' WHERE id = '$id'");
    if ($update) {
        $update_sukses = true;
    }
}

// 4. Ambil Data Lengkap dari Database
$query = mysqli_query($conn, "SELECT * FROM ppdb WHERE id = '$id'");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='admin-ppdb.php';</script>";
    exit;
}

include 'admin-header.php';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Calon Siswa</h1>
    <a href="admin-ppdb.php" class="btn btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">Biodata Lengkap: <?= $data['nama_siswa']; ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr><th width="35%">No. Registrasi</th><td>: <span class="badge badge-dark"><?= $data['no_registrasi']; ?></span></td></tr>
                        <tr><th>Nama Lengkap</th><td>: <strong><?= $data['nama_siswa']; ?></strong></td></tr>
                        <tr><th>NIK / NISN</th><td>: <?= $data['nik']; ?> / <?= $data['nisn']; ?></td></tr>
                        <tr><th>Asal Sekolah</th><td>: <?= $data['asal_sekolah']; ?></td></tr>
                        <tr><th>Tempat, Tgl Lahir</th><td>: <?= $data['tempat_lahir']; ?>, <?= date('d M Y', strtotime($data['tgl_lahir'])); ?></td></tr>
                        <tr><th>Jenis Kelamin</th><td>: <?= $data['jenis_kelamin']; ?></td></tr>
                        <tr><th>Alamat</th><td>: <?= $data['alamat']; ?></td></tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Berkas Pendukung</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <p class="small fw-bold">Pas Foto</p>
                        <a href="uploads/<?= $data['file_foto']; ?>" target="_blank">
                            <img src="uploads/<?= $data['file_foto']; ?>" class="img-thumbnail" style="height: 150px;">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <p class="small fw-bold">Kartu Keluarga</p>
                        <a href="uploads/<?= $data['file_kk']; ?>" target="_blank" class="btn btn-outline-info btn-block">
                            <i class="fas fa-file-download"></i> Lihat KK
                        </a>
                    </div>
                    <div class="col-md-4">
                        <p class="small fw-bold">Akta Kelahiran</p>
                        <a href="uploads/<?= $data['file_akta']; ?>" target="_blank" class="btn btn-outline-info btn-block">
                            <i class="fas fa-file-download"></i> Lihat Akta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4 border-left-success">
            <div class="card-header py-3 bg-success text-white">
                <h6 class="m-0 font-weight-bold">Data Orang Tua / Wali</h6>
            </div>
            <div class="card-body">
                <p class="mb-1 text-muted small">Ayah:</p>
                <p class="font-weight-bold mb-0"><?= $data['nama_ayah']; ?></p>
                <p class="small"><?= $data['pekerjaan_ayah']; ?> (<?= $data['pendidikan_ayah']; ?>)</p>
                <hr>
                <p class="mb-1 text-muted small">Ibu:</p>
                <p class="font-weight-bold mb-0"><?= $data['nama_ibu']; ?></p>
                <p class="small"><?= $data['pekerjaan_ibu']; ?> (<?= $data['pendidikan_ibu']; ?>)</p>
                <hr>
                <a href="https://wa.me/62<?= substr($data['no_hp'], 1); ?>" target="_blank" class="btn btn-success btn-block">
                    <i class="fab fa-whatsapp"></i> Hubungi Orang Tua
                </a>
            </div>
        </div>

        <div class="card shadow mb-4 border-left-primary">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kelola Status Pendaftaran</h6>
            </div>
            <div class="card-body text-center">
                <p class="small text-muted mb-3">Status Saat Ini: 
                    <span class="badge badge-<?= ($data['status'] == 'Pending' ? 'warning' : ($data['status'] == 'Diterima' ? 'success' : 'danger')) ?>">
                        <?= strtoupper($data['status']); ?>
                    </span>
                </p>
                <form action="" method="POST">
                    <select name="status" class="form-control mb-3" required>
                        <option value="Pending" <?= $data['status'] == 'Pending' ? 'selected' : ''; ?>>Pending (Menunggu)</option>
                        <option value="Diterima" <?= $data['status'] == 'Diterima' ? 'selected' : ''; ?>>Diterima</option>
                        <option value="Ditolak" <?= $data['status'] == 'Ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                    </select>
                    <button type="submit" name="update_status" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i> Simpan Status
                    </button>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body p-2">
                <a href="hapus-ppdb.php?id=<?= $data['id']; ?>" class="btn btn-danger btn-sm btn-block btn-hapus">
                    <i class="fas fa-trash"></i> Hapus Data Permanen
                </a>
            </div>
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
                title: 'Hapus Pendaftar Ini?',
                text: "Data akan hilang selamanya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });
    });
</script>

<script>
    // Pop-up saat Berhasil Simpan Status
    <?php if ($update_sukses): ?>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Status pendaftaran telah diperbarui menjadi <?= $_POST['status'] ?>',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Oke'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = 'detail-ppdb.php?id=<?= $id ?>';
            }
        });
    <?php endif; ?>
</script>

<?php include 'admin-footer.php'; ?>