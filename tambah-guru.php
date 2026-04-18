<?php
session_start();

// cek login user
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

include 'koneksi.php';
include 'admin-header.php'; // pastikan pakai admin-header

// proses simpan data
if (isset($_POST['simpan'])) {
    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip       = mysqli_real_escape_string($conn, $_POST['nip']);
    $mapel     = mysqli_real_escape_string($conn, $_POST['mapel']);
    $facebook  = mysqli_real_escape_string($conn, $_POST['facebook']);
    $instagram = mysqli_real_escape_string($conn, $_POST['instagram']);

    // upload foto
    $nama_file   = $_FILES['foto']['name'];
    $sumber_file = $_FILES['foto']['tmp_name'];
    $nama_baru   = time() . '_' . $nama_file;

    $upload = move_uploaded_file($sumber_file, 'img/' . $nama_baru);

    if ($upload) {
        $query = "INSERT INTO guru VALUES (
            NULL, 
            '$nama', 
            '$nip', 
            '$mapel', 
            '$nama_baru', 
            '$facebook', 
            '$instagram'
        )";
        $simpan = mysqli_query($conn, $query);
    } else {
        $simpan = false;
    }

    // load sweetalert
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

    if ($simpan) {
        $link_publik = "guru.php";
        $link_admin  = "admin-guru.php";

        echo "
        <script>
            Swal.fire({
                title: 'Berhasil Disimpan!',
                text: 'Data guru baru berhasil ditambahkan.',
                icon: 'success',
                showConfirmButton: false, // Ubah ke true agar muncul tombol OK
                showCloseButton: true,
                html: '<br>' +
                    '<a href=\"$link_publik\" target=\"_blank\" ' +
                    '   class=\"btn btn-success font-weight-bold px-4 py-2\" ' +
                    '   onclick=\"tundaRefresh()\">' + 
                    '   <i class=\"fas fa-eye mr-2\"></i> Lihat Hasil (Tab Baru)' +
                    '</a>' +
                    '<br><br><small class=\"text-muted\">Halaman ini akan kembali otomatis</small>',
                
                // Perbaikan di sini: Tambahkan koma dan gunakan variabel langsung
                willClose: () => {
                    window.location = '$link_admin';
                }
            });

            function tundaRefresh() {
                setTimeout(function() {
                    window.location = '$link_admin';
                }, 1000);
            }
        </script>
        ";
    } else {
        echo "<script>Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan.', 'error');</script>";
    }
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Guru</h1>
    <a href="admin-guru.php" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Data Guru</h6>
            </div>

            <div class="card-body">

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">NIP</label>
                                <input type="text" name="nip" class="form-control" inputmode="numeric" pattern="[0-9]*" maxlength="18" placeholder="Contoh: 198001..." onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Mata Pelajaran / Jabatan</label>
                                <input type="text" name="mapel" class="form-control" placeholder="Contoh: Matematika" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Foto Profil</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*" required>
                        <small class="text-muted d-block mt-1">Format: JPG/PNG, Maks 2MB.</small>
                    </div>

                    <hr>
                    <h6 class="font-weight-bold text-gray-800 mb-3">Media Sosial (Opsional)</h6>

                    <div class="form-group">
                        <label class="text-dark">Link Facebook</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                            </div>
                            <input type="text" name="facebook" class="form-control" placeholder="https://facebook.com/namaguru">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-dark">Link Instagram</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                            </div>
                            <input type="text" name="instagram" class="form-control" placeholder="https://instagram.com/namaguru">
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary mr-2">
                            <i class="fas fa-undo mr-1"></i> Reset
                        </button>
                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Simpan Data
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<?php include 'admin-footer.php'; ?>