<?php
session_start();
include 'koneksi.php';

// cek login
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// --- LOGIKA HAPUS MASSAL ---
if (isset($_POST['hapus_massal'])) {
    if (!empty($_POST['pilih_id'])) {
        $ids = implode(",", $_POST['pilih_id']); // ubah array id jadi string "1,2,3"
        
        $hapus = mysqli_query($conn, "DELETE FROM bukutamu WHERE id IN ($ids)");
        
        // set status untuk sweetalert di bawah
        if ($hapus) {
            $status_hapus = 'sukses';
        } else {
            $status_hapus = 'gagal';
        }
    }
}

// update status pesan jadi terbaca saat halaman dibuka
mysqli_query($conn, "UPDATE bukutamu SET status = 'sudah_dibaca' WHERE status = 'belum_dibaca'");

include 'admin-header.php';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Buku Tamu</h1>
</div>

<form method="post" action="" id="form-hapus">

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Pesan Masuk Pengunjung</h6>
            
            <button type="button" id="btn-hapus-massal" class="btn btn-danger btn-sm" disabled>
                <i class="fas fa-trash"></i> Hapus Terpilih
            </button>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th>No</th>
                            <th>Nama Pengirim</th>
                            <th>Email</th>
                            <th>Judul</th>
                            <th>Isi Pesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM bukutamu ORDER BY id DESC");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="pilih_id[]" value="<?= $row['id']; ?>" class="pilih-item">
                            </td>

                            <td><?= $no++; ?></td>
                            <td class="font-weight-bold"><?= $row['nama']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['subjek']; ?></td>
                            <td><?= $row['pesan']; ?></td>
                            <td>
                                <a href="hapus-bukutamu.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm btn-hapus">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <input type="hidden" name="hapus_massal" value="1">

</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // --- 1. FITUR SELECT ALL & ENABLE TOMBOL ---
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.pilih-item');
    const btnHapusBanyak = document.getElementById('btn-hapus-massal');

    // kalau header dicentang, semua ikut dicentang
    selectAll.addEventListener('change', function() {
        checkboxes.forEach(cb => {
            cb.checked = this.checked;
        });
        cekTombol(); 
    });

    // kalau salah satu item di-uncheck, header jadi uncheck
    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            if (!this.checked) {
                selectAll.checked = false;
            }
            cekTombol();
        });
    });

    // fungsi nyalakan tombol jika ada yg dicentang
    function cekTombol() {
        const jumlah = document.querySelectorAll('.pilih-item:checked').length;
        if (jumlah > 0) {
            btnHapusBanyak.removeAttribute('disabled');
        } else {
            btnHapusBanyak.setAttribute('disabled', true);
        }
    }

    // --- 2. SWEETALERT HAPUS MASSAL ---
    const formHapus = document.getElementById('form-hapus');
    
    btnHapusBanyak.addEventListener('click', function() {
        const jumlah = document.querySelectorAll('.pilih-item:checked').length;
        
        Swal.fire({
            title: 'Hapus ' + jumlah + ' pesan?',
            text: "Pesan yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                formHapus.submit();
            }
        })
    });

    // --- 3. SWEETALERT HAPUS SATUAN (EXISTING) ---
    const tombolHapus = document.querySelectorAll('.btn-hapus');
    tombolHapus.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');

            Swal.fire({
                title: 'Hapus pesan ini?',
                text: "Pesan akan hilang permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });
    });
</script>

<script>
<?php if (isset($status_hapus)) { ?>
    <?php if ($status_hapus == 'sukses') { ?>
        Swal.fire({
            title: 'Terhapus!',
            text: 'Pesan terpilih berhasil dihapus.',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location = 'admin-bukutamu.php';
        });
    <?php } else { ?>
        Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
    <?php } ?>
<?php } ?>
</script>

<?php include 'admin-footer.php'; ?>