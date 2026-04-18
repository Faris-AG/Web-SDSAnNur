<?php
session_start();

// cek login user
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

include 'koneksi.php';
include 'admin-header.php'; // pastikan pakai admin-header agar sidebar muncul

// logika simpan berita
if (isset($_POST['simpan'])) {
    
    $judul   = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi     = mysqli_real_escape_string($conn, $_POST['isi']);
    $tanggal = $_POST['tanggal'];

    // upload foto
    $nama_file   = $_FILES['gambar']['name'];
    $sumber_file = $_FILES['gambar']['tmp_name'];
    $nama_baru   = time() . '_' . $nama_file;
    
    $upload = move_uploaded_file($sumber_file, 'img/' . $nama_baru);
    
    if ($upload) {
        $query = "INSERT INTO berita (judul, isi, gambar, tanggal) 
                  VALUES ('$judul', '$isi', '$nama_baru', '$tanggal')";
        $simpan = mysqli_query($conn, $query);
    } else {
        $simpan = false;
    }

    // load sweetalert
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

    if ($simpan) {
        $link_publik = "berita.php"; 
        $link_admin  = "admin-berita.php"; 

        echo "
        <script>
            Swal.fire({
                title: 'Berhasil Terbit!',
                text: 'Berita Anda sudah tayang.',
                icon: 'success',
                showConfirmButton: false,
                showCancelButton: false,
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

            // fungsi jeda refresh agar tab baru sempat terbuka
            function tundaRefresh() {
                setTimeout(function() {
                    window.location = '$link_admin';
                }, 1000);
            }
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan.', 'error');
        </script>
        ";
    }
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Berita</h1>
    <a href="admin-berita.php" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Berita Baru</h6>
            </div>
            
            <div class="card-body">
                
                <form action="" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukan judul berita..." required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Foto Dokumentasi</label>
                                <input type="file" name="gambar" class="form-control-file" accept="image/*" required>
                                <small class="text-muted">Format: JPG/PNG, Maks 2MB.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Isi Berita</label>
                        <textarea name="isi" class="form-control" rows="8" placeholder="Tulis isi berita secara lengkap..." required></textarea>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary mr-2">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="fas fa-save"></i> Terbitkan Berita
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<?php include 'admin-footer.php'; ?>