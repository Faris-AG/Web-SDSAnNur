<?php
session_start();
include 'koneksi.php';

// 1. CEK LOGIN
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// 2. AMBIL ID DARI URL
$id = $_GET['id'];

// 3. AMBIL DATA LAMA
$query = mysqli_query($conn, "SELECT * FROM info_reuni WHERE id = '$id'");
$data  = mysqli_fetch_assoc($query);

// Jika ID tidak ditemukan
if (mysqli_num_rows($query) < 1) {
    header("Location: admin-reuni");
    exit;
}

// 4. PROSES UPDATE DATA
if (isset($_POST['update'])) {
    $judul   = htmlspecialchars($_POST['judul_acara']);
    $tanggal = htmlspecialchars($_POST['tanggal_acara']);
    $lokasi  = htmlspecialchars($_POST['lokasi']);
    $isi     = $_POST['deskripsi']; 
    $foto_lama = $_POST['foto_lama'];

    if ($_FILES['foto']['error'] === 4) {
        $foto = $foto_lama; 
    } else {
        $nama_file = $_FILES['foto']['name'];
        $tmp_file  = $_FILES['foto']['tmp_name'];
        $foto      = time() . '_' . $nama_file;
        move_uploaded_file($tmp_file, 'img/' . $foto);
        
        if (file_exists("img/" . $foto_lama)) {
            unlink("img/" . $foto_lama);
        }
    }

    $update = mysqli_query($conn, "UPDATE info_reuni SET 
                           judul_acara = '$judul',
                           tanggal_acara = '$tanggal',
                           lokasi = '$lokasi',
                           deskripsi = '$isi',
                           foto = '$foto' 
                           WHERE id = '$id'");

    // Redirect dengan status agar memicu pop-up (Metode paling aman agar tidak menciut)
    if ($update) {
        echo "<script>window.location='edit-reuni.php?id=$id&status=sukses';</script>";
    } else {
        echo "<script>window.location='edit-reuni.php?id=$id&status=gagal';</script>";
    }
    exit;
}

include 'admin-header.php'; 
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Agenda Reuni</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Acara</h6>
    </div>
    <div class="card-body">
        
        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label class="font-weight-bold text-dark">Nama Acara / Tema Reuni</label>
                <input type="text" name="judul_acara" class="form-control" value="<?= $data['judul_acara']; ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold text-dark">Tanggal Acara</label>
                    <input type="date" name="tanggal_acara" class="form-control" value="<?= $data['tanggal_acara']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold text-dark">Lokasi Kegiatan</label>
                    <input type="text" name="lokasi" class="form-control" value="<?= $data['lokasi']; ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold text-dark">Foto / Flyer Acara</label><br>
                <img src="img/<?= $data['foto']; ?>" width="150" class="img-thumbnail mb-2">
                <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">
                
                <input type="file" name="foto" class="form-control">
                <small class="text-muted">Biarkan kosong jika foto tidak berubah.</small>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold text-dark">Deskripsi & Susunan Acara</label>
                <textarea name="deskripsi" class="form-control" rows="5" required><?= $data['deskripsi']; ?></textarea>
            </div>

            <hr>

            <button type="submit" name="update" class="btn btn-primary mr-2">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="admin-reuni" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Batal
            </a>

        </form>
    </div>
</div>

<?php if (isset($_GET['status'])): ?>
<script>
    <?php if ($_GET['status'] == 'sukses'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Agenda Reuni berhasil diperbarui.',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            // Setelah klik OK, pindah ke halaman daftar reuni
            window.location.href = 'admin-reuni.php';
        });
    <?php elseif ($_GET['status'] == 'gagal'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan sistem saat menyimpan data.',
            confirmButtonColor: '#e74a3b'
        });
    <?php endif; ?>
</script>
<?php endif; ?>

<?php include 'admin-footer.php'; ?>