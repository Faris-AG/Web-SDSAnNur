<?php
session_start();
include 'koneksi.php';

// Cek Login
if (!isset($_SESSION['status_login'])) {
    header("Location: login");
    exit;
}

// --- 1. PROSES ACC / SETUJUI DATA ---
if (isset($_GET['acc'])) {
    $id_acc = $_GET['acc'];
    // Ubah status_akun jadi aktif
    $update = mysqli_query($conn, "UPDATE alumni SET status_akun = 'aktif' WHERE id = '$id_acc'");
    
    if ($update) {
        $pesan_acc = "sukses";
    } else {
        $pesan_acc = "gagal";
    }
}

// --- 2. PROSES HAPUS MASSAL ---
if (isset($_POST['hapus_massal'])) {
    if (!empty($_POST['pilih_id'])) {
        $ids = implode(",", $_POST['pilih_id']); 

        // Hapus foto dulu
        $cek_foto = mysqli_query($conn, "SELECT foto FROM alumni WHERE id IN ($ids)");
        while ($f = mysqli_fetch_assoc($cek_foto)) {
            if ($f['foto'] != "" && file_exists("img/" . $f['foto'])) {
                unlink("img/" . $f['foto']);
            }
        }

        // Hapus datanya
        $hapus = mysqli_query($conn, "DELETE FROM alumni WHERE id IN ($ids)");

        if ($hapus) {
            $status_hapus = "sukses";
        } else {
            $status_hapus = "gagal";
        }
    }
}

include 'admin-header.php';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Alumni</h1>
</div>

<form method="post" action="" id="form-hapus">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Alumni Masuk</h6>
            
            <button type="button" id="btn-hapus-massal" class="btn btn-danger btn-sm" disabled>
                <i class="fas fa-trash"></i> Hapus Terpilih
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th width="5%" class="text-center">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama & Angkatan</th>
                            <th>Pekerjaan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Tampilkan semua data, urutkan yang pending di paling atas
                        $query = mysqli_query($conn, "SELECT * FROM alumni ORDER BY status_akun ASC, id DESC");
                        
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td class="text-center align-middle">
                                    <input type="checkbox" name="pilih_id[]" value="<?= $row['id']; ?>" class="pilih-item">
                                </td>
                                <td class="align-middle"><?= $no++; ?></td>
                                <td class="align-middle text-center">
                                    <?php if ($row['foto'] != "") { ?>
                                        <img src="img/<?= $row['foto']; ?>" width="50" height="50" class="rounded-circle object-fit-cover border shadow-sm">
                                    <?php } else { ?>
                                        <span class="badge badge-secondary">No img</span>
                                    <?php } ?>
                                </td>
                                <td class="align-middle">
                                    <div class="fw-bold text-dark"><?= $row['nama']; ?></div>
                                    <small class="text-muted">Lulus: <?= $row['tahun_lulus']; ?></small>
                                </td>
                                <td class="align-middle"><?= $row['status']; ?></td>
                                
                                <td class="text-center align-middle">
                                    <?php if ($row['status_akun'] == 'pending') { ?>
                                        <span class="badge badge-warning text-dark px-3 py-2">
                                            <i class="fas fa-clock mr-1"></i> Menunggu
                                        </span>
                                    <?php } else { ?>
                                        <span class="badge badge-success px-3 py-2">
                                            <i class="fas fa-check-circle mr-1"></i> Aktif
                                        </span>
                                    <?php } ?>
                                </td>

                                <td class="text-center align-middle">
                                    <?php if ($row['status_akun'] == 'pending') { ?>
                                        <a href="admin-alumni.php?acc=<?= $row['id']; ?>" class="btn btn-success btn-sm btn-acc mb-1" title="Setujui Data">
                                            <i class="fas fa-check"></i> Setujui
                                        </a>
                                    <?php } ?>

                                    <a href="hapus-alumni.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm btn-hapus" title="Hapus Permanen">
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
    <input type="hidden" name="hapus_massal" value="yes">
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // --- 1. SCRIPT LOGIKA ACC (SETUJUI) ---
    const tombolAcc = document.querySelectorAll('.btn-acc');
    tombolAcc.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');

            Swal.fire({
                title: 'Setujui Data Ini?',
                text: "Data alumni akan langsung tampil di website publik.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1cc88a', // Warna Hijau
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Tayangkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });
    });

    // --- 2. NOTIFIKASI SUKSES ACC (DARI PHP) ---
    <?php if (isset($pesan_acc)) { ?>
        <?php if ($pesan_acc == 'sukses') { ?>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data alumni telah diaktifkan.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location = 'admin-alumni.php'; // Hilangkan parameter url
            });
        <?php } ?>
    <?php } ?>

    // --- 3. LOGIKA SELECT ALL & HAPUS MASSAL (BAWAAN LAMA) ---
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.pilih-item');
    const btnHapusBanyak = document.getElementById('btn-hapus-massal');
    const formHapus = document.getElementById('form-hapus');

    selectAll.addEventListener('change', function() {
        checkboxes.forEach(cb => { cb.checked = this.checked; });
        cekTombol();
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            if (!this.checked) selectAll.checked = false;
            cekTombol();
        });
    });

    function cekTombol() {
        const jumlah = document.querySelectorAll('.pilih-item:checked').length;
        if (jumlah > 0) btnHapusBanyak.removeAttribute('disabled');
        else btnHapusBanyak.setAttribute('disabled', true);
    }

    btnHapusBanyak.addEventListener('click', function() {
        const jumlah = document.querySelectorAll('.pilih-item:checked').length;
        Swal.fire({
            title: 'Hapus ' + jumlah + ' data?',
            text: "Data yang dihapus tidak bisa kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Semua!'
        }).then((result) => {
            if (result.isConfirmed) formHapus.submit();
        })
    });

    // Notif Hapus Massal
    <?php if (isset($status_hapus) && $status_hapus == 'sukses') { ?>
        Swal.fire({ icon: 'success', title: 'Terhapus!', text: 'Data berhasil dihapus.', timer: 1500, showConfirmButton: false }).then(() => { window.location = 'admin-alumni.php'; });
    <?php } ?>

    // --- 4. HAPUS SATUAN ---
    const tombolHapus = document.querySelectorAll('.btn-hapus');
    tombolHapus.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            Swal.fire({
                title: 'Yakin hapus?',
                text: "Data akan hilang permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) document.location.href = href;
            })
        });
    });
</script>

<?php include 'admin-footer.php'; ?>