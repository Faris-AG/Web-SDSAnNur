<?php
include 'koneksi.php';

// Menangkap filter status jika ingin mencetak laporan berdasarkan kategori tertentu
$filter_status = isset($_GET['status']) ? mysqli_real_escape_string($conn, $_GET['status']) : '';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data PPDB - SDS Islam An Nur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            @page { size: landscape; margin: 1cm; }
            table { width: 100% !important; font-size: 9pt; }
            .badge { color: black !important; border: 1px solid #ccc; }
        }
        th { vertical-align: middle; text-align: center; }
    </style>
</head>

<body onload="window.print()">
    <div class="container-fluid mt-4">

        <div class="text-center mb-4">
            <h3 class="fw-bold">LAPORAN PENERIMAAN PESERTA DIDIK BARU (PPDB)</h3>
            <h4 class="fw-bold">SDS ISLAM AN NUR</h4>
            <p>Gg. An Nur Jl. Kp. Baru, RT.002/RW.012, Ciapus, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610</p>
            <?php if($filter_status != ''): ?>
                <span class="badge bg-secondary">Filter Status: <?= strtoupper($filter_status) ?></span>
            <?php endif; ?>
            <hr style="border: 2px solid black;">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered border-dark">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>No. Reg</th>
                        <th>Nama Siswa</th>
                        <th>L/P</th>
                        <th>Tempat, Tgl Lahir</th>
                        <th>Asal Sekolah</th>
                        <th>Nama Ayah</th>
                        <th>Nama Ibu</th>
                        <th>No. HP (WA)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = "SELECT * FROM ppdb";
                    if ($filter_status != '') {
                        $sql .= " WHERE status = '$filter_status'";
                    }
                    $sql .= " ORDER BY nama_siswa ASC";
                    
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center small"><?= $row['no_registrasi']; ?></td>
                            <td><?= $row['nama_siswa']; ?></td>
                            <td class="text-center"><?= ($row['jenis_kelamin'] == 'Laki-laki') ? 'L' : 'P'; ?></td>
                            <td>
                                <?= $row['tempat_lahir']; ?>, 
                                <?= ($row['tgl_lahir'] != '0000-00-00') ? date('d/m/Y', strtotime($row['tgl_lahir'])) : '-'; ?>
                            </td>
                            <td><?= $row['asal_sekolah']; ?></td>
                            <td><?= $row['nama_ayah']; ?></td>
                            <td><?= $row['nama_ibu']; ?></td>
                            <td class="text-center"><?= $row['no_hp']; ?></td>
                            <td class="text-center fw-bold">
                                <?= strtoupper($row['status']); ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-5">
            <div class="text-center" style="width: 250px;">
                <p>Bogor, <?= date('d F Y') ?><br>Kepala Sekolah</p>
                <br><br><br>
                <p class="fw-bold text-decoration-underline">Bpk. Kepala Sekolah, M.Pd</p>
                <p>NIP. 19800101 200001 1 001</p>
            </div>
        </div>

        <div class="fixed-bottom p-3 no-print text-center bg-white border-top">
            <a href="admin-ppdb.php" class="btn btn-secondary">Kembali ke Admin</a>
            <button onclick="window.print()" class="btn btn-primary">Cetak Laporan</button>
        </div>
    </div>
</body>
</html>