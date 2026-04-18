<?php
include 'koneksi.php';
include 'header.php';

$hasil_pencarian = null;
$error = null;

if (isset($_POST['cari'])) {
    $no_reg = mysqli_real_escape_string($conn, $_POST['no_reg']);
    
    // Query untuk mengambil data berdasarkan nomor registrasi
    $query = "SELECT * FROM ppdb WHERE no_registrasi = '$no_reg'";
    $eksekusi = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($eksekusi) > 0) {
        $hasil_pencarian = mysqli_fetch_assoc($eksekusi);
    } else {
        $error = "Nomor Registrasi tidak ditemukan. Silakan periksa kembali.";
    }
}
?>

<section class="py-5 bg-light" style="min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Cek Status Pendaftaran</h3>
                    <p class="text-muted">Masukkan nomor registrasi Anda untuk melihat status pendaftaran.</p>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <form action="" method="post">
                            <div class="input-group">
                                <input type="text" name="no_reg" class="form-control" placeholder="Contoh: REG-2026..." required>
                                <button type="submit" name="cari" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Cari Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> <?= $error; ?>
                    </div>
                <?php endif; ?>

                <?php if ($hasil_pencarian): ?>
                    <div class="card border-0 shadow-sm animate__animated animate__fadeIn">
                        <div class="card-header bg-white border-bottom p-3">
                            <h5 class="mb-0 fw-bold text-primary">Hasil Pencarian</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row mb-3">
                                <div class="col-5 text-muted">Nomor Registrasi</div>
                                <div class="col-7 fw-bold"><?= $hasil_pencarian['no_registrasi']; ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-5 text-muted">Nama Siswa</div>
                                <div class="col-7"><?= $hasil_pencarian['nama_siswa']; ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-5 text-muted">Tanggal Daftar</div>
                                <div class="col-7"><?= date('d F Y', strtotime($hasil_pencarian['tanggal_daftar'])); ?></div>
                            </div>
                            <hr>
                            <div class="text-center mt-4">
                                <p class="mb-2 text-muted small">Status Pendaftaran Anda:</p>
                                
                                <?php if ($hasil_pencarian['status'] == 'Pending'): ?>
                                    <span class="badge bg-warning text-dark p-2 px-4 fs-6">
                                        <i class="bi bi-clock-history"></i> MENUNGGU VERIFIKASI
                                    </span>
                                    <p class="mt-3 small text-muted">Mohon tunggu, admin sedang memeriksa berkas Anda.</p>
                                
                                <?php elseif ($hasil_pencarian['status'] == 'Diterima'): ?>
                                    <span class="badge bg-success p-2 px-4 fs-6">
                                        <i class="bi bi-check-circle-fill"></i> SELAMAT! ANDA DITERIMA
                                    </span>
                                    <p class="mt-3 small text-muted">Silakan datang ke sekolah untuk proses daftar ulang.</p>
                                
                                <?php else: ?>
                                    <span class="badge bg-danger p-2 px-4 fs-6">
                                        <i class="bi bi-x-circle-fill"></i> MOHON MAAF, DITOLAK
                                    </span>
                                    <p class="mt-3 small text-muted">Silakan hubungi panitia untuk informasi lebih lanjut.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>