-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql101.infinityfree.com
-- Waktu pembuatan: 17 Apr 2026 pada 10.16
-- Versi server: 11.4.10-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_41078864_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alumni`
--

CREATE TABLE `alumni` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tahun_lulus` year(4) DEFAULT NULL,
  `angkatan` varchar(50) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `status_akun` enum('pending','aktif','ditolak') NOT NULL DEFAULT 'pending',
  `testimoni` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alumni`
--

INSERT INTO `alumni` (`id`, `nama`, `tahun_lulus`, `angkatan`, `status`, `status_akun`, `testimoni`, `foto`) VALUES
(2, 'Ahmad Fauzi', 2008, '8', 'Jendral TNI AD', 'aktif', 'Sekolah nya keren dan teman temannya asik', '1769927852_IMG_20200611_094116.jpg'),
(16, 'Muhammad Rizky', 2010, '10', 'Mahasiswa UI', 'aktif', 'Sekolahan yang keren', '1770725528_IMG_0426.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `tanggal`) VALUES
(1, 'Juara 1 Lomba Futsal', 'Alhamdulillah Tim Sekolah Kita Menang', 'futsal.jpg', '2026-01-25'),
(2, 'Juara 1 Lomba Basket', 'Universitas Atma Jaya Yogyakarta (UAJY) berhasil meraih Juara I pada lomba basket kategori putri dan Juara II untuk kategori putra dalam Pekan Olahraga Mahasiswa Daerah (POMDA) Bola Basket 2024 yang diselenggarakan oleh Badan Pembina Olahraga Mahasiswa (BAPOMI) Daerah Istimewa Yogyakarta (DIY) di GOR Universitas Islam Indonesia (UII). Turnamen ini diselenggarakan pada 25 November hingga 29 November 2024.\r\n\r\nUntuk memberikan performa yang terbaik, proses latihan yang dilakukan oleh 12 anggota tim baik dari tim putra maupun tim putri berlangsung cukup lama. Mereka melakukan persiapan sejak bulan Juni 2024 dengan menggunakan fasilitas yang dimiliki oleh UAJY, yaitu lapangan basket Gd. Slamet Rijadi dan Gd. Alfonsus sehingga dapat mempersiapkan diri untuk mengikuti lomba Liga Mahasiswa dan POMDA Bola Basket.\r\n\r\nNicolas Yosa Pratama, mahasiswa Program Studi Hukum angkatan 2023 menyebutkan tantangan yang dihadapi adalah adaptasi. Karena belum pernah menginjak kaki di lapangan UII, Ia dan tim kaget terhadap suasana dan fasilitas yang terdapat di dalamnya. Namun, hal tersebut bukan menjadi penghalang untuk memberikan performa yang maksimal ketika permainan telah dimulai.\r\n\r\n“Lomba basket di UII ini menambah pengalaman baru terlebih lagi saat ini aku masih mahasiswa baru sehingga senang bisa ikut lomba ini. Lalu, mengesankan juga,” ujar Monica Ignacia Liaotando, mahasiswa Program Studi Manajemen angkatan 2024.\r\n\r\n“Harapannya, semoga basket UAJY bisa selalu aktif mengikuti lomba dan mencetak prestasi yang lebih banyak di tingkat regional dan nasional sehingga dapat membuat nama UAJY unggul di bidang basket,” ungkap Ahmad Sungkar, mahasiswa Program Studi Sosiologi angkatan 2024.\r\n\r\nNicolas, Monica, dan Ahmad mengajak mahasiswa UAJY untuk lebih aktif mengikuti berbagai perlombaan pada bidang olahraga basket dan bidang-bidang lainnya sehingga dapat membawa nama baik UAJY pada tingkat regional, nasional, bahkan tingkat internasional.', 'basket.jpg', '2026-01-01'),
(3, 'Juara 1 Lomba Mobile Legend', 'Turnamen PINTU BATTLEGROUND Mobile Legends: Bang Bang hasil kolaborasi aplikasi PINTU dan klub esports Rex Regum Qeon (RRQ) menghelat partai grand final pada Minggu, 5 Februari 2023.\r\n\r\nBertempat di Epicentrum XXI, Jakarta Selatan dan dihadiri 200 pencinta esports, MT Legends yang merupakan perwakilan dari Jakarta berhadapan dengan Relle Team dari Bogor pada partai puncak.\r\n\r\nMT Legend sukses mengalahkan Relle Team dan keluar sebagai juara PINTU BATTLEGROUND Mobile Legends: Bang Bang. MT Legend pun berhak atas hadiah uang tunai plus Bitcoin (BTC) sebesar Rp40 juta.\r\n\r\nTurnamen ini diikuti 512 tim yang mendaftar dan mengikuti kualifikasi atau sekitar lebih dari 3.000 orang yang berpartisipasi.\r\n\r\n\"Kami senang sekali bisa menjuarai turnamen ini, bahkan dengan mengikuti PINTU BATTLEGROUND kami bisa lebih mengenal dunia investasi dan juga crypto,\" ujar Muhamad Irvan Ramdhani, Kapten Tim esports MT Legends.\r\n\r\n\"Kami ucapkan terima kasih kepada PINTU dan RRQ yang sudah mengadakan turnamen ini, semoga dapat dilanjutkan ke season 2 dengan hadiah yang lebih spektakuler,\" sambungnya.\r\n\r\nSementara itu, kapten Relle Team, Raul, menyebut timnya baru terbentuk sekitar satu bulan. Meski baru seumur jagung, mereka mampu unjuk gigi dan sukses melenggang hingga ke grand final.\r\n\r\n\"Relle Team dibentuk baru sekitar satu bulan dan setelah melihat informasi mengenai turnamen yang diadakan PINTU dengan RRQ di Instagram, kami langsung daftarkan untuk mengikuti turnamen ini,\" ujar Raul.\r\n\r\n\"Overall turnamen PINTU BATTLEGROUND sangat bagus dan kualitasnya oke banget sudah melebihi ekspektasi kami,\" lanjutnya.', '1769753914_033948600_1675756799-IMG_2156.jpg', '2023-01-30'),
(4, 'Juara 1 Membaca Puisi', 'Jovin Christopher Mahasiswa Broadcasting 2018 UEU Berhasil meraih Juara 1 Lomba Cipta Puisi Tingkat Nasional yang diselenggarakan oleh PIKR Attena Universitas Negeri Jakarta 20 Desember 2018.\r\n\r\nDalam perlombaan tersebut, Jovin menciptakan karya puisi yang berjudul ï¿½Keringatku Pupuk Keberhasilankuï¿½ yang berdasarkan tema yang telah ditentukan panitia perlombaan yaitu Generasi Intelek, Unggul dan Sehat.\r\n\r\nJovin mengatakan sangat bersyukur atas raihan yang didapatkannya dari Lomba Cipta Puisi ini karena berhasil mengungguli sejumlah puisi yang dikirimkan oleh mahasiswa dari sejumlah kampus.\r\n\r\nï¿½Saat pengumuman acara tersebut, saya berhasil menjadi Juara 1 dalam perlombaan tersebut dan bersyukur bange karena dapat membawa nama baik Universitas Esa Unggul dalam ajang perlombaan ini,ï¿½ ujar Jovin di Universitas Esa Unggul.\r\n\r\nMahasiswa peraih Top 10 Abang Buku Jakarta Barat ini berharap, dapat kembali berkarya dan berprestasi disejumlah ajang baik nasional maupun internasional. ï¿½Mudah-mudahan bisa berprestasi kembali dalam sejumlah karya,ï¿½ tutupnya.', '1769755666_images.jpeg', '2018-12-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukutamu`
--

CREATE TABLE `bukutamu` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subjek` varchar(200) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'belum_dibaca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bukutamu`
--

INSERT INTO `bukutamu` (`id`, `nama`, `email`, `subjek`, `pesan`, `tanggal`, `status`) VALUES
(11, 'Qui quis deleniti se', 'lozaj@mailinator.com', 'Dolorum sunt lorem ', 'Animi ipsa quaerat', '2026-03-15 06:27:56', 'sudah_dibaca');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `tanggal`, `gambar`) VALUES
(1, 'Pramuka', '2024-02-20', '1770115312_Pramuka 1.jpeg'),
(2, 'Pramuka', '2024-02-20', '1770115374_Pramuka 2.jpeg'),
(3, 'Pramuka', '2024-02-20', '1770115414_Pramuka 3.jpeg'),
(4, 'Pramuka', '2024-02-20', '1770115648_Pramuka 4.jpeg'),
(5, 'Pramuka', '2024-02-20', '1770115694_Pramuka 5.jpeg'),
(6, 'Mabit', '2024-03-12', '1770115821_Mabit 1.jpeg'),
(7, 'Mabit', '2024-03-12', '1770115847_Mabit 2.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nama`, `nip`, `mapel`, `foto`, `facebook`, `instagram`) VALUES
(7, 'Muhammad Bambang.SPD', '2132124213', 'PKN', '1769874198_67964751785-index.jpg', 'contoh', ''),
(8, 'Muhammad Saepul.SPD', '122321412', 'PAI', '1769874371_guru pai.jpg', '', 'contoh'),
(9, 'Siti Maemunah.SPD', '321142214', 'Matematika', '1769874412_guru mtk.jpeg', 'contoh', 'contoh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_reuni`
--

CREATE TABLE `info_reuni` (
  `id` int(11) NOT NULL,
  `judul_acara` varchar(255) NOT NULL,
  `tanggal_acara` date NOT NULL,
  `waktu_acara` time NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `info_reuni`
--

INSERT INTO `info_reuni` (`id`, `judul_acara`, `tanggal_acara`, `waktu_acara`, `lokasi`, `deskripsi`, `foto`) VALUES
(2, 'Reuni Angkatan 11', '2026-01-12', '00:00:00', 'The University Aula Visit Oslo', 'Mari Berkumpul Kembali Kawan!', '1770110482_A6562DCB0665E00C6B5E6C27583372FF10C4B039.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppdb`
--

CREATE TABLE `ppdb` (
  `id` int(11) NOT NULL,
  `no_registrasi` varchar(20) DEFAULT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `pendidikan_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `pendidikan_ibu` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_daftar` date NOT NULL DEFAULT current_timestamp(),
  `file_kk` varchar(255) DEFAULT NULL,
  `file_akta` varchar(255) DEFAULT NULL,
  `file_foto` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bukutamu`
--
ALTER TABLE `bukutamu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `info_reuni`
--
ALTER TABLE `info_reuni`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ppdb`
--
ALTER TABLE `ppdb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `bukutamu`
--
ALTER TABLE `bukutamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `info_reuni`
--
ALTER TABLE `info_reuni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ppdb`
--
ALTER TABLE `ppdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
