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

// 3. AMBIL DATA GURU LAMA DARI DATABASE
$query = mysqli_query($conn, "SELECT * FROM guru WHERE id = '$id'");
$data  = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (mysqli_num_rows($query) < 1) {
    header("Location: admin-guru");
    exit;
}

// 4. PROSES UPDATE DATA
if (isset($_POST['update'])) {
    $nama      = htmlspecialchars($_POST['nama']);
    $nip       = htmlspecialchars($_POST['nip']);
    $mapel     = htmlspecialchars($_POST['mapel']);
    $facebook  = htmlspecialchars($_POST['facebook']);
    $instagram = htmlspecialchars($_POST['instagram']);
    $foto_lama = $_POST['foto_lama'];

    // LOGIKA UPLOAD FOTO
    if ($_FILES['foto']['error'] === 4) {
        $foto = $foto_lama; 
    } else {
        $nama_file = $_FILES['foto']['name'];
        $tmp_file  = $_FILES['foto']['tmp_name'];
        $foto = time() . '_' . $nama_file;
        move_uploaded_file($tmp_file, 'img/' . $foto);
        
        if (file_exists("img/" . $foto_lama)) {
            unlink("img/" . $foto_lama);
        }
    }

    // QUERY UPDATE
    $update = mysqli_query($conn, "UPDATE guru SET 
                           nama = '$nama',
                           nip = '$nip',
                           mapel = '$mapel',
                           foto = '$foto',
                           facebook = '$facebook',
                           instagram = '$instagram'
                           WHERE id = '$id'");

    // Redirect dengan status agar memicu pop-up (Sesuai edit-galeri)
    if ($update) {
        echo "<script>window.location='edit-guru.php?id=$id&status=sukses';</script>";
    } else {
        echo "<script>window.location='edit-guru.php?id=$id&status=gagal';</script>";
    }
    exit;
}

include 'admin-header.php'; 
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Data Guru</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Guru</h6>
    </div>
    <div class="card-body">
        
        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label class="font-weight-bold text-dark">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold text-dark">NIP (Nomor Induk Pegawai)</label>
                    <input type="text" name="nip" class="form-control" inputmode="numeric" pattern="[0-9]*" maxlength="18" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?= $data['nip']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold text-dark">Mata Pelajaran / Jabatan</label>
                    <input type="text" name="mapel" class="form-control" value="<?= $data['mapel']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold text-dark"><i class="fab fa-facebook text-primary"></i> Link Facebook (Opsional)</label>
                    <input type="text" name="facebook" class="form-control" value="<?= $data['facebook']; ?>" placeholder="https://facebook.com/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold text-dark"><i class="fab fa-instagram text-danger"></i> Link Instagram (Opsional)</label>
                    <input type="text" name="instagram" class="form-control" value="<?= $data['instagram']; ?>" placeholder="https://instagram.com/...">
                </div>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold text-dark d-block">Foto Profil Saat Ini</label>
                <img src="img/<?= $data['foto']; ?>" width="120" class="img-thumbnail mb-2 rounded">
                <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">
                
                <div class="input-group mb-3">
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
            </div>

            <hr>

            <button type="submit" name="update" class="btn btn-primary mr-2">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="admin-guru" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
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
            text: 'Data guru berhasil diperbarui.',
            confirmButtonColor: '#4e73df'
        }).then((result) => {
            // Setelah klik OK, pindah ke halaman admin-guru
            window.location.href = 'admin-guru.php';
        });
    <?php elseif ($_GET['status'] == 'gagal'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan sistem.',
            confirmButtonColor: '#e74a3b'
        });
    <?php endif; ?>
</script>
<?php endif; ?>

<?php 
include 'admin-footer.php'; 
?>