<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard - Sekolah</title>
    <link rel="icon" href="img/icon.png" type="image/png">

    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php
    // Ambil nama file dari URL (misal: admin-dashboard.php)
    $page = basename($_SERVER['PHP_SELF']);
    ?>

    <div id="wrapper" style="min-height: 100vh;">

        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
                <div class="sidebar-brand-icon">
                    <img src="img/icon.png" alt="Logo" width="40">
                </div>
                <div class="sidebar-brand-text mx-3">Admin Sekolah</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item <?= ($page == 'dashboard.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Menu Utama
            </div>

            <li class="nav-item <?= ($page == 'admin-galeri.php' || $page == 'tambah-galeri.php' || $page == 'edit-galeri.php' || $page == 'hapus-galeri.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="admin-galeri">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Galeri Kegiatan</span></a>
            </li>

            <?php
            $menu_guru = ['admin-guru.php', 'tambah-guru.php', 'edit-guru.php', 'hapus-guru.php'];
            $aktif_guru = in_array($page, $menu_guru) ? 'active' : '';
            ?>
            <li class="nav-item <?= $aktif_guru; ?>">
                <a class="nav-link" href="admin-guru">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Data Guru</span></a>
            </li>

            <?php
            $menu_berita = ['admin-berita.php', 'tambah-berita.php', 'edit-berita.php'];
            $aktif_berita = in_array($page, $menu_berita) ? 'active' : '';
            ?>
            <li class="nav-item <?= $aktif_berita; ?>">
                <a class="nav-link" href="admin-berita">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Data Berita</span></a>
            </li>

            <li class="nav-item <?= ($page == 'admin-alumni.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="admin-alumni">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Data Alumni</span></a>
            </li>

            <li class="nav-item <?= ($page == 'admin-ppdb.php' || $page == 'detail-ppdb.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="admin-ppdb">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Data PPDB</span></a>
            </li>

            <li class="nav-item <?= ($page == 'admin-bukutamu.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="admin-bukutamu">
                    <i class="fas fa-fw fa-address-book"></i>
                    <span>Buku Tamu</span></a>
            </li>

            <li class="nav-item <?= ($page == 'admin-reuni.php' || $page == 'tambah-reuni.php' || $page == 'edit-reuni.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="admin-reuni">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Agenda Reuni</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column" style="min-height: 100vh;">

            <div id="content" class="flex-grow-1">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 sticky-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                                <img class="img-profile rounded-circle"
                                    src="assets/img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">