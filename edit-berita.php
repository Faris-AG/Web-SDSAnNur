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

// 3. AMBIL DATA BERITA LAMA
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id = '$id'");
$data  = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) < 1) {
    header("Location: admin-berita");
    exit;
}

// 4. PROSES UPDATE DATA
if (isset($_POST['update'])) {
    $judul   = htmlspecialchars($_POST['judul']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $isi     = $_POST['isi'];
    $foto_lama = $_POST['foto_lama'];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $foto_lama;
    } else {
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];
        $ekstensi  = explode('.', $nama_file);
        $ekstensi  = strtolower(end($ekstensi));
        $gambar    = uniqid() . '.' . $ekstensi;
        move_uploaded_file($tmp_file, 'img/' . $gambar);
    }

    $update = mysqli_query($conn, "UPDATE berita SET 
                judul   = '$judul',
                tanggal = '$tanggal',
                isi     = '$isi',
                gambar  = '$gambar'
                WHERE id = '$id'");

    if ($update) {
        header("Location: edit-berita.php?id=$id&status=sukses");
    } else {
        header("Location: edit-berita.php?id=$id&status=gagal");
    }
}

// PANGGIL HEADER ADMIN AGAR SIDEBAR MUNCUL
include 'admin-header.php'; 
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Berita</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Perbarui Informasi</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <input type="hidden" name="foto_lama" value="<?= $data['gambar']; ?>">

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Judul Berita</label>
                            <input type="text" name="judul" class="form-control" value="<?= $data['judul']; ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Tanggal Terbit</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal']; ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Isi Berita</label>
                            <textarea name="isi" class="form-control" rows="8" required><?= $data['isi']; ?></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold d-block">Foto Berita</label>
                            <div class="mb-2">
                                <img src="img/<?= $data['gambar']; ?>" width="120" class="img-thumbnail shadow-sm">
                            </div>
                            <div class="input-group">
                                <input type="file" name="gambar" class="form-control" accept="image/*">
                            </div>
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                        </div>

                        <hr>

                        <button type="submit" name="update" class="btn btn-primary mr-2">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="admin-berita" class="btn btn-secondary">
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
            text: 'Data berita telah diperbarui.',
            confirmButtonColor: '#4e73df',
        }).then((result) => {
            window.location.href = 'admin-berita.php';
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