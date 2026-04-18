<?php
session_start();
include 'koneksi.php';

// 1. CEK LOGIN
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM galeri WHERE id = '$id'");
$data  = mysqli_fetch_assoc($query);

// 2. PROSES UPDATE
if (isset($_POST['update'])) {
    $judul   = htmlspecialchars($_POST['judul']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $foto_lama = $_POST['foto_lama'];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $foto_lama;
    } else {
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];
        $gambar    = time() . '_' . $nama_file;
        move_uploaded_file($tmp_file, 'img/' . $gambar);
        if (file_exists("img/" . $foto_lama)) unlink("img/" . $foto_lama);
    }

    $update = mysqli_query($conn, "UPDATE galeri SET judul = '$judul', tanggal = '$tanggal', gambar = '$gambar' WHERE id = '$id'");

    if ($update) {
        header("Location: edit-galeri.php?id=$id&status=sukses");
    } else {
        header("Location: edit-galeri.php?id=$id&status=gagal");
    }
}

include 'admin-header.php'; 
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Galeri</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Perbarui Informasi</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="foto_lama" value="<?= $data['gambar']; ?>">

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Judul Kegiatan</label>
                            <input type="text" name="judul" class="form-control" value="<?= $data['judul']; ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal']; ?>" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold d-block">Foto Dokumentasi</label>
                            <div class="mb-2">
                                <img src="img/<?= $data['gambar']; ?>" width="150" class="img-thumbnail shadow-sm">
                            </div>
                            <div class="input-group">
                                <input type="file" name="gambar" class="form-control" accept="image/*">
                            </div>
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                        </div>

                        <hr>

                        <button type="submit" name="update" class="btn btn-primary mr-2">
                            <i class="fas fa-save"></i> Simpan Perubahan
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

<?php if (isset($_GET['status'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($_GET['status'] == 'sukses'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data galeri telah diperbarui.',
            confirmButtonColor: '#4e73df',
        }).then((result) => {
            window.location.href = 'admin-galeri.php';
        });
    <?php elseif ($_GET['status'] == 'gagal'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat menyimpan data.',
            confirmButtonColor: '#e74a3b'
        });
    <?php endif; ?>
</script>
<?php endif; ?>

<?php include 'admin-footer.php'; ?>