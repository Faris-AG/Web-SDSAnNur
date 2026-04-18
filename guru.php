<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="img/icon.png">
  <title>Tenaga Pengajar - SDS Islam An Nur</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <div class="top-bar bg-dark text-white py-2 small">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8 d-none d-md-block">
          <span class="me-3"><i class="bi bi-envelope-fill me-2 text-warning"></i>info@sdsannur.sch.id</span>
          <span><i class="bi bi-telephone-fill me-2 text-warning"></i>(0251) 8345678</span>
        </div>
        <div class="col-md-4 text-md-end text-center">
          <span class="me-2">Ikuti Kami:</span>
          <a href="https://www.facebook.com/sdislamannur.sdislamannur/" target="_blank" rel="noopener noreferrer" class="text-white me-2"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/sekolahdasarannur?igsh=eHA0Y2FncHJva2Jp" target="_blank" rel="noopener noreferrer" class="text-white me-2"><i class="bi bi-instagram"></i></a>
          <a href="https://www.youtube.com/@sdsannur3943" target="_blank" rel="noopener noreferrer" class="text-white"><i class="bi bi-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>

  <?php
  // 1. PANGGIL KONEKSI DATABASE
  include "header.php";
  include "koneksi.php";
  ?>

  <header class="page-header py-5 text-white position-relative overflow-hidden">
    <div class="container py-5 position-relative z-2 text-center text-lg-start">
      <h1 class="display-4 fw-bold" data-aos="fade-down">Tenaga Pengajar</h1>
      <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
        <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
          <li class="breadcrumb-item"><a href="/" class="text-white-50 text-decoration-none">Beranda</a></li>
          <li class="breadcrumb-item active text-white" aria-current="page">Guru</li>
        </ol>
      </nav>
    </div>
    <div class="header-shape shape-1"></div>
    <div class="header-shape shape-2"></div>
  </header>

  <section class="py-5">
    <div class="container py-4">

      <div class="text-center mb-5" data-aos="fade-up">
        <h5 class="text-primary fw-bold text-uppercase">SDM Berkualitas</h5>
        <h2 class="fw-bold mb-3">Guru & Staf Profesional</h2>
        <p class="text-muted mb-4">
          Kami memiliki tenaga pendidik yang berpengalaman, solid, dan
          berdedikasi tinggi untuk mencerdaskan bangsa.
        </p>

        <div class="row justify-content-center mb-5">
          <div class="col-lg-10">
            <div class="position-relative rounded-4 overflow-hidden shadow-lg border border-4 border-white">
              <img src="img/guru.jpeg" class="img-fluid w-100" alt="Foto Bersama Guru" style="pointer-events: none" />
            </div>
            <p class="small text-muted mt-2 fst-italic">
              Keluarga Besar Tenaga Pendidik SDS Islam An Nur
            </p>
          </div>
        </div>
      </div>

      <div class="row g-4">

        <?php
        // 2. QUERY MENGAMBIL DATA GURU
        $query = mysqli_query($conn, "SELECT * FROM guru ORDER BY id DESC");

        // 3. LOOPING DATA
        if (mysqli_num_rows($query) > 0) {
          while ($row = mysqli_fetch_assoc($query)) {
            // Cek apakah ada foto, jika tidak pakai placeholder
            $foto = !empty($row['foto']) ? "img/" . $row['foto'] : "https://via.placeholder.com/300x400?text=No+Image";
        ?>

            <div class="col-lg-3 col-md-6" data-aos="fade-up">
              <div class="teacher-card rounded shadow-sm overflow-hidden bg-white text-center h-100">
                <div class="teacher-img-wrapper position-relative">
                  <img
                    src="<?= $foto; ?>"
                    class="img-fluid w-100 object-fit-cover"
                    style="height: 300px;"
                    alt="<?= $row['nama']; ?>" />
                  <div class="teacher-social d-flex justify-content-center gap-2">

                    <?php if (!empty($row['facebook'])) { ?>
                      <a href="<?= $row['facebook']; ?>" target="_blank" class="btn btn-sm btn-primary rounded-circle">
                        <i class="bi bi-facebook"></i>
                      </a>
                    <?php } ?>

                    <?php if (!empty($row['instagram'])) { ?>
                      <a href="<?= $row['instagram']; ?>" target="_blank" class="btn btn-sm btn-danger rounded-circle">
                        <i class="bi bi-instagram"></i>
                      </a>
                    <?php } ?>

                  </div>
                </div>
                <div class="p-4">
                  <h5 class="fw-bold mb-1"><?= $row['nama']; ?></h5>

                  <small class="text-primary fw-bold text-uppercase"><?= $row['mapel']; ?></small>

                  <p class="text-muted small mt-2 mb-0">NIY: <?= $row['nip']; ?></p>
                </div>
              </div>
            </div>

        <?php
          } // Tutup While
        } else {
          echo '<div class="col-12 text-center py-5">Belum ada data guru yang diinput.</div>';
        }
        ?>

      </div>
      <div class="text-center mt-5" data-aos="fade-up">
        <p class="text-muted">
          Ingin bergabung menjadi bagian dari tenaga pengajar kami?
        </p>
        <a href="kontak" class="btn btn-outline-primary rounded-pill px-4">Hubungi Kami</a>
      </div>
    </div>
  </section>

  <?php include "footer.php"; ?>

</body>

</html>