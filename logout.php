<?php
session_start();
session_destroy(); // Hapus semua tiket masuk
header("Location: login"); // Kembalikan ke login
?>