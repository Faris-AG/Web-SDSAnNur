<?php
session_start();
include 'koneksi.php';
include 'header.php';

// PROSES PENYIMPANAN DATA
if (isset($_POST['kirim'])) {
    
    // 1. CEK CAPTCHA DULU
    // Pastikan session ada isinya sebelum dicek
    if (!isset($_SESSION['hasil_captcha'])) {
        // Kalau session kosong (mungkin session expired), anggap salah
        $captcha_valid = false;
    } else {
        $captcha_valid = ($_POST['jawaban_user'] == $_SESSION['hasil_captcha']);
    }

    if (!$captcha_valid) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Hitungan Salah!',
                    text: 'Mohon isi jawaban matematika dengan benar.',
                }).then(function() {
                    window.history.back(); 
                });
            }, 100);
        </script>";
        exit;
    } // <--- KURUNG TUTUP PENTING DISINI

    // 2. JIKA CAPTCHA BENAR, LANJUT AMBIL DATA
    $nama      = htmlspecialchars($_POST['nama']);
    $tahun     = htmlspecialchars($_POST['tahun']);
    $angkatan  = htmlspecialchars($_POST['angkatan']);
    $status    = htmlspecialchars($_POST['status']);
    $testimoni = htmlspecialchars($_POST['testimoni']);

    // LOGIKA UPLOAD FOTO
    if ($_FILES['foto']['name'] != "") {
        $nama_file   = $_FILES['foto']['name'];
        $sumber_file = $_FILES['foto']['tmp_name'];
        // Buat nama unik
        $nama_baru   = time() . '_' . $nama_file;
        move_uploaded_file($sumber_file, 'img/' . $nama_baru);
    } else {
        $nama_baru = "";
    }
    $status_pekerjaan = htmlspecialchars($_POST['status']);
    // QUERY INSERT
    $query = "INSERT INTO alumni (nama, tahun_lulus, angkatan, status, testimoni, foto, status_akun) 
              VALUES ('$nama', '$tahun', '$angkatan', '$status_pekerjaan', '$testimoni', '$nama_baru', 'pending')";
    
    $simpan = mysqli_query($conn, $query);

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    if ($simpan) {
        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'Terima Kasih!',
                    text: 'Data Anda berhasil ditambahkan.',
                    icon: 'success',
                    confirmButtonColor: '#155e37'
                }).then(function() {
                    window.location = 'alumni.php';
                });
            }, 100);
        </script>";
    } else {
        echo "<script>
            setTimeout(function() {
                Swal.fire('Gagal!', 'Terjadi kesalahan sistem.', 'error');
            }, 100);
        </script>";
    }
}
?>

<header class="py-5 bg-success text-white position-relative overflow-hidden">
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold" data-aos="fade-down">Form Data Alumni</h1>
        <p class="lead" data-aos="fade-up">Mari terhubung kembali! Isi data Anda untuk masuk ke direktori alumni.</p>
    </div>
</header>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" data-aos="fade-up">
                    <div class="card-header bg-success text-white p-4">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-person-lines-fill me-2"></i> Biodata Alumni</h4>
                    </div>
                    <div class="card-body p-5">
                        
                        <form action="" method="post" enctype="multipart/form-data">
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control py-3 bg-light" required placeholder="Sesuai Ijazah">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold">Tahun Lulus <span class="text-danger">*</span></label>
                                    <input type="number" name="tahun" class="form-control py-3 bg-light" required placeholder="Contoh: 2015">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold">Angkatan Ke- (Opsional)</label>
                                    <input type="text" name="angkatan" class="form-control py-3 bg-light" placeholder="Contoh: V (Lima)">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Status / Aktivitas Saat Ini <span class="text-danger">*</span></label>
                                <input type="text" name="status" class="form-control py-3 bg-light" required placeholder="Contoh: Mahasiswa UI / Bekerja di BUMN">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Foto Terbaru (Format JPG/PNG)</label>
                                <input type="file" name="foto" class="form-control py-3 bg-light" accept="image/*">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Kesan & Pesan <span class="text-danger">*</span></label>
                                <textarea name="testimoni" class="form-control py-3 bg-light" rows="4" required></textarea>
                            </div>

                            <div class="mb-4 p-3 border rounded bg-white">
                                <label class="form-label fw-bold text-success">Keamanan (Anti Spam) <span class="text-danger">*</span></label>
                                <?php
                                    $angka1 = rand(1, 9);
                                    $angka2 = rand(1, 9);
                                    $_SESSION['hasil_captcha'] = $angka1 + $angka2;
                                ?>
                                <p class="mb-2">Berapa hasil dari: <strong class="fs-5"><?php echo $angka1; ?> + <?php echo $angka2; ?></strong> ?</p>
                                <input type="number" name="jawaban_user" class="form-control py-3 bg-light" required placeholder="Tulis jawabannya (angka)">
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" name="kirim" class="btn btn-success btn-lg fw-bold shadow-sm">
                                    <i class="bi bi-send-fill me-2"></i> Kirim Data Alumni
                                </button>
                                <a href="alumni" class="btn btn-outline-secondary btn-lg fw-bold">Batal / Kembali</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>