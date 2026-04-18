<?php
include 'header.php';
?>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Panduan Pendaftaran Online</h2>
                    <p class="text-muted">Ikuti langkah-langkah di bawah ini untuk mendaftarkan putra/putri Anda.</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm text-center p-4">
                            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; margin: 0 auto;">
                                <i class="bi bi-file-earmark-text fs-3"></i>
                            </div>
                            <h5 class="fw-bold">1. Persiapkan Berkas</h5>
                            <p class="small text-muted">Scan atau foto dokumen asli: KK, Akta Kelahiran, dan Pas Foto 3x4 (format JPG/PNG/PDF).</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm text-center p-4">
                            <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; margin: 0 auto;">
                                <i class="bi bi-pencil-square fs-3"></i>
                            </div>
                            <h5 class="fw-bold">2. Isi Formulir</h5>
                            <p class="small text-muted">Klik tombol "PPDB Online" dan isi data siswa, orang tua, serta alamat dengan benar sesuai KK.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm text-center p-4">
                            <div class="rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; margin: 0 auto;">
                                <i class="bi bi-qr-code fs-3"></i>
                            </div>
                            <h5 class="fw-bold">3. Simpan No. Registrasi</h5>
                            <p class="small text-muted">Setelah berhasil, sistem akan memberikan Nomor Registrasi. Simpan nomor tersebut untuk cek status.</p>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mt-5">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4"><i class="bi bi-info-circle text-primary me-2"></i>Informasi Penting</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-start px-0">
                                <span class="badge bg-primary rounded-pill me-3">!</span>
                                <div>Pastikan <strong>NIK</strong> dan <strong>NISN</strong> sudah benar karena tidak bisa diubah setelah dikirim.</div>
                            </li>
                            <li class="list-group-item d-flex align-items-start px-0">
                                <span class="badge bg-primary rounded-pill me-3">!</span>
                                <div>Gunakan nomor <strong>WhatsApp aktif</strong> agar pihak sekolah bisa menghubungi Anda untuk verifikasi lanjutan.</div>
                            </li>
                            <li class="list-group-item d-flex align-items-start px-0">
                                <span class="badge bg-primary rounded-pill me-3">!</span>
                                <div>Data Wali hanya diisi jika siswa tidak tinggal bersama orang tua kandung.</div>
                            </li>
                        </ul>
                        <div class="mt-4 text-center">
                            <a href="ppdb.php" class="btn btn-success btn-lg px-5 shadow">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>