<?php
session_start();
include 'koneksi.php';

// 1. CEK LOGIN
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// 2. PROSES SIMPAN DATA
$status_simpan = ""; // Variabel bantu untuk trigger SweetAlert
if (isset($_POST['simpan'])) {
    $judul   = htmlspecialchars($_POST['judul_acara']);
    $tanggal = htmlspecialchars($_POST['tanggal_acara']);
    $waktu   = htmlspecialchars($_POST['waktu_acara']);
    $lokasi  = htmlspecialchars($_POST['lokasi']);
    $isi     = $_POST['deskripsi'];

    // LOGIKA UPLOAD FOTO
    $nama_file = $_FILES['foto']['name'];
    $tmp_file  = $_FILES['foto']['tmp_name'];
    $foto = time() . '_' . $nama_file;
    
    if (move_uploaded_file($tmp_file, 'img/' . $foto)) {
        $query = "INSERT INTO info_reuni (judul_acara, tanggal_acara, waktu_acara, lokasi, deskripsi, foto) 
                  VALUES ('$judul', '$tanggal', '$waktu', '$lokasi', '$isi', '$foto')";
        
        if (mysqli_query($conn, $query)) {
            $status_simpan = "sukses";
        } else {
            $status_simpan = "gagal";
        }
    } else {
        $status_simpan = "gagal_upload";
    }
}

include 'admin-header.php';
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Agenda Reuni</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="font-weight-bold text-dark">Tema / Judul Acara</label>
                    <input type="text" name="judul_acara" class="form-control" placeholder="Contoh: Reuni Akbar Angkatan 2010" required>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold text-dark">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_acara" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold text-dark">Waktu (Jam)</label>
                        <input type="time" name="waktu_acara" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold text-dark">Lokasi Kegiatan</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Aula Utama" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold text-dark">Foto Poster / Flyer</label>
                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold text-dark">Deskripsi & Susunan Acara</label>
                    <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
                </div>

                <hr>
                <button type="submit" name="simpan" class="btn btn-success mr-2">
                    <i class="fas fa-save"></i> Simpan Agenda
                </button>
                <a href="admin-reuni.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Menjalankan SweetAlert berdasarkan status simpan
    <?php if ($status_simpan == "sukses"): ?>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Agenda reuni telah dipublikasikan.',
            icon: 'success',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'admin-reuni.php';
            }
        });
    <?php elseif ($status_simpan == "gagal" || $status_simpan == "gagal_upload"): ?>
        Swal.fire({
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat menyimpan data.',
            icon: 'error',
            confirmButtonColor: '#e74a3b'
        });
    <?php endif; ?>
</script>

<?php include 'admin-footer.php'; ?>