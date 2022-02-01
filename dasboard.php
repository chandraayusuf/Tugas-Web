<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION["login"])) {
    header("location: index.php");
    exit;
}

$surat_masuk = mysqli_query($koneksi, "SELECT COUNT(*) FROM tblsurat_masuk");
$surat_masuk = mysqli_fetch_assoc($surat_masuk)['COUNT(*)'];

$surat_keluar = mysqli_query($koneksi, "SELECT COUNT(*) FROM tblsurat_keluar");
$surat_keluar = mysqli_fetch_assoc($surat_keluar)['COUNT(*)'];

$surat_keputusan = mysqli_query($koneksi, "SELECT COUNT(*) FROM tblsurat_keputusan");
$surat_keputusan = mysqli_fetch_assoc($surat_keputusan)['COUNT(*)'];

$berita_acara = mysqli_query($koneksi, "SELECT COUNT(*) FROM tblberita_acara");
$berita_acara = mysqli_fetch_assoc($berita_acara)['COUNT(*)'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>Sisfo Administrasi HMAN

    </title>
</head>

<body>
<!--Container -->
<div class="mx-auto bg-grey-400">
    <!--Screen-->
    <div class="min-h-screen flex flex-col">
        <!--Header Section Starts Here-->
        <header class="bg-nav bg-green-400">
        <div class="flex justify-between">
                <div class="p-1 mx-3 inline-flex items-center">
                    <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                     <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                    </i>
                    <h1 class="text-white p-2">HMAN</h1>
                </div>
                <div class="p-1 flex flex-row items-center">

                    <img onclick="profileToggle()" class="inline-block h-10 w-10 rounded-full" src="img/LogoHMAN.png" alt="">
                    <a href="#" onclick="profileToggle()" class="text-white p-2 text-xl no-underline hidden md:block lg:block">HMAN</a>
                    <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                        <ul class="list-reset">
                          <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My account</a></li>
                          <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a></li>
                          <li><hr class="border-t mx-2 border-grey-ligght"></li>
                          <li>
                            <a href="/hapus" class="no-underline px-4 py-2 block text-black hover:bg-grey-light"
                                onclick="event.preventDefault();
                                        let yakin = confirm('Ingin Logout?');
                                        if(yakin){
                                            document.getElementById('logout-form').submit();}">
                                    Logout
                                </a>
                          </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!--/Header-->

        <div class="flex flex-1">
            <!--Sidebar-->
            <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

                <ul class="list-reset flex flex-col">
                    <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                        <a href="dasboard.php"
                           class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fas fa-tachometer-alt float-left mx-2"></i>
                            Dashboard
                            <span><i class="fas fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <li class="w-full h-full py-3 px-2 border-b border-light-border">
                        <a href="berita_acara.php"
                           class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fab fa-wpforms float-left mx-2"></i>
                            Berita Acara
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <li class="w-full h-full py-3 px-2 border-b border-light-border">
                        <a href="surat_masuk.php"
                           class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fas fa-grip-horizontal float-left mx-2"></i>
                            Surat Masuk
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <li class="w-full h-full py-3 px-2 border-b border-light-border">
                        <a href="surat_keluar.php"
                           class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fas fa-table float-left mx-2"></i>
                            Surat Keluar
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <li class="w-full h-full py-3 px-2 border-b border-light-border">
                        <a href="surat_keputusan.php" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fab fa-uikit float-left mx-2"></i>
                            Surat Keputusan
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <li class="w-full h-full py-3 px-2 border-b border-300-border">
                        <a href="inventaris_arsip.php" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fas fa-square-full float-left mx-2"></i>
                            Invetaris Arsip
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <li class="w-full h-full py-3 px-2 border-b border-300-border">
                        <a href="inventaris_barang.php" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                            <i class="fas fa-square-full float-left mx-2"></i>
                            Invetaris Barang
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <li class="w-full h-full py-3 px-2">
                    <a href="/hapus" class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline"
                        onclick="event.preventDefault();
                                let yakin = confirm('Ingin Logout?');
                                if(yakin){
                                    document.getElementById('logout-form').submit();}">
                      <i class="far fa-file float-left mx-2"></i>
                      Logout
                      <span><i class="fa fa-angle-down float-right"></i></span>
                    </a>
                </li>
                </ul>

            </aside>

            </aside>
            <!--/Sidebar-->
            <!--Main-->
            <main class="bg-white-300 flex-1 p-3 overflow-hidden">

                <div class="flex flex-col">
                    <!-- Stats Row Starts Here -->
                    <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                        <div class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    <?= $surat_masuk ?>
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                   Surat Masuk
                                </a>
                            </div>
                        </div>

                        <div class="shadow bg-info border-l-8 hover:bg-info-dark border-info-dark mb-2 p-2 md:w-1/4 mx-2">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    <?= $surat_keluar ?>
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    Surat Keluar
                                </a>
                            </div>
                        </div>

                        <div class="shadow bg-warning border-l-8 hover:bg-warning-dark border-warning-dark mb-2 p-2 md:w-1/4 mx-2">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    <?= $surat_keputusan ?>
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    Surat Keputusan
                                </a>
                            </div>
                        </div>

                        <div class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2">
                            <div class="p-4 flex flex-col">
                                <a href="#" class="no-underline text-white text-2xl">
                                    <?= $berita_acara ?>
                                </a>
                                <a href="#" class="no-underline text-white text-lg">
                                    Berita Acara
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /Stats Row Ends Here -->
                    <!-- Card Sextion Starts Here -->      
    </div>
    <!--/footer-->
</div>
<footer class="footer bg-white relative pt-1 border-b-2 border-blue-700">
    <div class="container mx-auto px-6">
        <div class="mt-16 border-t-2 border-gray-300 flex flex-col items-center">
            <div class="sm:w-2/3 text-center py-6">
                <p class="text-sm text-green-700 font-bold mb-2">
                    © 2021 by UKH Jurnalistik
                </p>
            </div>
        </div>
    </div>
</footer>
<script src="js/main.js"></script>
</body>
<form id="logout-form" action="logout.php" method="POST">
</form>
</html>