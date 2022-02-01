<?php 
session_start(); // agar tab yang di sebelah juga log out apabila ditutup yang utama.
include 'koneksi.php';

if (isset($_SESSION['login'])){
    header("location:./dasboard.php");
  } 
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
<body class>
    <div class="lg:flex">
        <div class="lg:w-1/2 xl:max-w-screen-sm">
            <div class="py-12 bg-indigo-100 lg:bg-white flex justify-center lg:justify-start lg:px-12">
                <div class="cursor-pointer flex items-center">
                    <div>
                        <img onclick="profileToggle()" class="inline-block h-10 w-10 rounded-full" src="img/LogoHMAN.png" alt="">
                    </div>
                    <div class="text-2xl text-green-400 tracking-wide ml-2 font-semibold">Himpunan Administarsi Niaga</div>
                </div>
            </div>
            <div class="mt-10 px-12 sm:px-24 md:px-48 lg:px-12 lg:mt-16 xl:px-24 xl:max-w-2xl">
                <h2 class="text-center text-4xl text-green-900 font-display font-semibold lg:text-left xl:text-5xl
                xl:text-bold">Login</h2>
                <div class="mt-12">
                    <form method="post" action="cek.php">
                        <div>
                            <div class="text-sm font-bold text-gray-700 tracking-wide">Username</div>
                            <input class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-green-500" type="text" name="username" placeholder="Masukkan Username">
                        </div>
                        <div class="mt-8">
                            <div class="flex justify-between items-center">
                                <div class="text-sm font-bold text-gray-700 tracking-wide">
                                    Password
                                </div>
                            </div>
                            <input class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-green-500" type="password" name="password" placeholder="Masukkan password">
                        </div>
                        <div class="mt-10">
                            <button  class="bg-green-500 text-gray-100 p-4 w-full rounded-full tracking-wide
                            font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-green-600
                            shadow-lg" type="submit" >
                               LogIn
                            </button>
                            <a href="login_user.php" class="text-black p-2 text-xl no-underline hidden md:block lg:block">Login Users</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="hidden lg:flex items-center justify-center bg-green-100 flex-1 h-screen">
            <div class="max-w-xs transform duration-200 hover:scale-110 cursor-pointer">
                <img onclick="profileToggle()" class="inline-block rounded-full" src="img/LogoHMAN.png" alt="">
            </div>
        </div>
    </div>
</body>
</html>
