<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tim Robotik Juara 1 Nasional - Berita SDS Islam An Nur</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <?php 
    include 'koneksi.php';

    // 1. Tangkap ID dari URL (misal: ?id=5)
    $id = $_GET['id'];

    // 2. Ambil data berita spesifik berdasarkan ID tersebut
    $query = "SELECT * FROM berita WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    // (Opsional) Cek kalau data tidak ketemu, kembalikan ke halaman berita
    if (!$data) {
        header("Location: berita");
        exit;
    }
    ?>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="/"
          >SDS ISLAM AN NUR</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="berita">Kembali ke Berita</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="py-5 mt-5">
      <div class="container py-4">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <span class="badge bg-primary mb-2">Prestasi</span>
            <?= $data["judul"]; ?>
            <div class="text-muted mb-4">
              <?= $data["tanggal"]; ?>
              <i class="bi bi-person me-2"></i>Admin Sekolah
            </div>

            <img
              src="img/<?= $data["gambar"]; ?>"
              class="img-fluid rounded-4 w-100 mb-4 shadow-sm"
              alt="Robotik"
            />

            <div class="article-content" style="line-height: 1.8">
              <p><?= nl2br(string: $data["isi"]); ?> </p>
            </div>

            <div class="mt-5 pt-4 border-top">
              <span class="fw-bold me-3">Bagikan:</span>

              <a
                href="https://wa.me/?text=Baca%20berita%20keren%20ini%20di%20SMA%20Harapan!%20(Link%20nya%20nanti%20otomatis)"
                target="_blank"
                class="btn btn-outline-success btn-sm rounded-circle me-1"
              >
                <i class="bi bi-whatsapp"></i>
              </a>

              <a
                href="https://www.facebook.com/sharer/sharer.php?u=example.com"
                target="_blank"
                class="btn btn-outline-primary btn-sm rounded-circle me-1"
              >
                <i class="bi bi-facebook"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="bg-dark text-white pt-4 pb-2 mt-5">
      <div class="container text-center">
        <p class="small">© 2026 SDS Islam An Nur.</p>
      </div>
    </footer>

    <footer class="bg-dark text-white pt-4 pb-2 mt-auto"></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
