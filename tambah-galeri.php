<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status_login'])) { 
    header("Location: login"); 
    exit; 
}

// 1. PINDAHKAN LOGIKA REDIRECT KE BAWAH ATAU GUNAKAN VARIABLE STATUS
$status = "";
if (isset($_POST['upload'])) {
    $judul   = htmlspecialchars($_POST['judul']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file  = $_FILES['gambar']['tmp_name'];
    $gambar    = time() . '_' . $nama_file;
    
    if(move_uploaded_file($tmp_file, 'img/' . $gambar)){
        $query = mysqli_query($conn, "INSERT INTO galeri (judul, tanggal, gambar) VALUES ('$judul', '$tanggal', '$gambar')");
        if($query) {
            $status = "sukses";
        } else {
            $status = "gagal";
        }
    }
}

// 2. PANGGIL HEADER TERLEBIH DAHULU
include 'admin-header.php';
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Galeri</h1>
    </div>

    <div class="row">
        <div class="col-lg-8"> <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Foto Kegiatan</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Judul Kegiatan</label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan nama kegiatan..." required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold">File Foto</label>
                            <div class="input-group">
                                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                            </div>
                            <small class="text-muted">Format: JPG, PNG, JPEG. Maks 2MB.</small>
                        </div>

                        <hr>
                        <button type="submit" name="upload" class="btn btn-primary mr-2">
                            <i class="fas fa-save"></i> Simpan Foto
                        </button>
                        <a href="admin-galeri" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if ($status == "sukses"): ?>
<script>
    Swal.fire({
        title: 'Berhasil!',
        text: 'Foto kegiatan berhasil diunggah.',
        icon: 'success',
        confirmButtonColor: '#4e73df'
    }).then(() => { 
        window.location = 'admin-galeri.php'; 
    });
</script>
<?php elseif ($status == "gagal"): ?>
<script>
    Swal.fire({
        title: 'Gagal!',
        text: 'Terjadi kesalahan saat mengunggah.',
        icon: 'error'
    });
</script>
<?php endif; ?>

<?php include 'admin-footer.php'; ?>