<?php include 'koneksi.php'; ?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Semua Galeri - SDS Islam An Nur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body class="bg-light">

  <?php include 'header.php'; ?>

  <div class="container py-5 mt-5">
    <div class="text-center mb-5" data-aos="fade-down">
      <h1 class="fw-bold" style="color: #0b2e13;">Semua Galeri Kegiatan</h1>
      <p class="text-muted">Kumpulan dokumentasi kegiatan dan momen berharga di SDS Islam An Nur</p>
      <hr class="w-25 mx-auto text-success border-2 opacity-75">
    </div>

    <div class="row g-4">
      <?php
      // --- LOGIKA PAGINATION ---
      $batas = 3; // Jumlah gambar per halaman
      $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
      $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

      $data = mysqli_query($conn, "SELECT * FROM galeri");
      $jumlah_data = mysqli_num_rows($data);
      $total_halaman = ceil($jumlah_data / $batas);

      // Ambil data dengan LIMIT untuk pagination
      $query_semua = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC LIMIT $halaman_awal, $batas");

      while ($row = mysqli_fetch_array($query_semua)) {
      ?>
        <div class="col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in">
          <div class="card shadow-sm border-0 h-100 card-hover" style="border-radius: 12px; overflow: hidden;">
            <a href="img/<?= $row['gambar'] ?>" class="glightbox" data-gallery="gallery-sekolah" data-title="<?= $row['judul'] ?>">
              <img src="img/<?= $row['gambar'] ?>" class="card-img-top" alt="<?= $row['judul'] ?>" loading="lazy" style="height: 250px; object-fit: cover;">
            </a>
            <div class="card-body text-center p-3">
              <h6 class="card-title fw-semibold text-dark mb-1"><?= $row['judul'] ?></h6>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

    <nav class="mt-5">
      <ul class="pagination justify-content-center">
        <li class="page-item <?= ($halaman <= 1) ? 'disabled' : '' ?>">
          <a class="page-link shadow-sm" href="galeri.php?halaman=<?= $halaman - 1 ?>">Previous</a>
        </li>

        <?php for ($x = 1; $x <= $total_halaman; $x++): ?>
          <li class="page-item <?= ($halaman == $x) ? 'active' : '' ?>">
            <a class="page-link shadow-sm" href="galeri.php?halaman=<?= $x ?>"><?= $x ?></a>
          </li>
        <?php endfor; ?>

        <li class="page-item <?= ($halaman >= $total_halaman) ? 'disabled' : '' ?>">
          <a class="page-link shadow-sm" href="galeri.php?halaman=<?= $halaman + 1 ?>">Next</a>
        </li>
      </ul>
    </nav>

    <div class="text-center mt-4" data-aos="fade-up">
      <a href="index.php#galeri" class="btn btn-outline-success px-4 py-2 rounded-pill fw-bold">
        <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
      </a>
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 800
    });
  </script>

  <script>
    const lightbox = GLightbox({
      selector: '.glightbox',
      touchNavigation: true,
      loop: true,
      descPosition: 'none' // Tambahkan ini
    });
</script>
</body>

</html>