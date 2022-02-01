<?php 
session_start();
include 'koneksi.php';
if (!isset($_SESSION["login"])) {
  header("location: index.php");
  exit;
}
if(isset($_POST['submit'])) {
  define('MyConst', TRUE);
  include 'function_berita_acara.php';
  $berita_acara = new berita_acara();
  $berita_acara -> edit_berita_acara($_POST);
}

$id =$_GET['id'];
$query ="SELECT * FROM tblberita_acara WHERE id=$id";
$sql = mysqli_query($koneksi,$query);
if (mysqli_num_rows($sql) == 0) {
    header("location:./berita_acara.php");
  } else {
    $data = mysqli_fetch_array($sql);
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

<body>
<!--Container -->
<div class="mx-auto bg-grey-400">
    <!--Screen-->
    <div class="min-h-screen flex flex-col">
        <!--Header Section Starts Here-->
        <header class="bg-nav bg-green-400">
            <div class="flex justify-between">
                <div class="p-1 mx-3 inline-flex items-center">
                    <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
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
            <!--/Sidebar-->
            <div class="container mt-10 sm:mt-0 py-5">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                  <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                      <h3 class="text-lg font-medium leading-6 text-gray-900 px-10 px-5">Edit Berita Acara</h3>
                    </div>
                  </div>
                  <div class="mt-5 md:mt-0 md:col-span-2 py-5 px-10">
                    <form method="POST" enctype="multipart/form-data">
                          <input type="" class="form-control" id="id" name="id" value=<?php echo $id ?> hidden>
                            <div class="text-gray-700">
                                <label class="block mb-1" for="forms-labelOverInputCode">No Berita Acara</label>
                                <input name="nomor_berita_acara" class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" value="<?= $data['ba'] ?>" placeholder="" id="forms-labelOverInputCode"/>
                              </div>
              
                              <div class="text-gray-700">
                                <label class="block mb-1" for="forms-labelOverInputCode">Tanggal</label>
                                <input name="tanggal" class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="date" value="<?= $data['tanggal'] ?>" placeholder="Regular input" id="forms-labelOverInputCode"/>
                              </div>
              
                              <div class="text-gray-700">
                                <label class="block mb-1" for="forms-labelOverInputCode">Waktu</label>
                                <input name="waktu" class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" value="<?= $data['waktu'] ?>" placeholder="" id="forms-labelOverInputCode"/>
                              </div>
              
                            <div class="col-span-6 sm:col-span-3">
                              <label for="country" class="block text-sm font-medium text-gray-700">Divisi</label>
                              <select id="country" name="divisi" autocomplete="country-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option <?php echo ($data['divisi'] == 'Ketua Umum') ? 'selected' : '' ; ?>                   >Ketua Umum</option>
                                <option <?php echo ($data['divisi'] == 'Ketua 1') ? 'selected' : '' ; ?>                      >Ketua 1</option>
                                <option <?php echo ($data['divisi'] == 'Ketua 2') ? 'selected' : '' ; ?>                      >Ketua 2</option>
                                <option <?php echo ($data['divisi'] == 'Sekretaris Umum') ? 'selected' : '' ; ?>              >Sekretaris Umum</option>
                                <option <?php echo ($data['divisi'] == 'Bendahara Umum') ? 'selected' : '' ; ?>               >Bendahara Umum</option>
                                <option <?php echo ($data['divisi'] == 'Dept Pengaderan') ? 'selected' : '' ; ?>              >Dept Pengaderan</option>
                                <option <?php echo ($data['divisi'] == 'Dept Pemberdayaan Perempuan') ? 'selected' : '' ; ?>  >Dept Pemberdayaan Perempuan</option>
                                <option <?php echo ($data['divisi'] == 'Dept Humas') ? 'selected' : '' ; ?>                   >Dept Humas</option>
                                <option <?php echo ($data['divisi'] == 'Dept Pendidikan') ? 'selected' : '' ; ?>              >Dept Pendidikan</option>
                                <option <?php echo ($data['divisi'] == 'Dept Kesekretaiatan') ? 'selected' : '' ; ?>          >Dept Kesekretaiatan</option>
                                <option <?php echo ($data['divisi'] == 'Dept Kerohanian') ? 'selected' : '' ; ?>              >Dept Kerohanian</option>
                                <option <?php echo ($data['divisi'] == 'UKH Seni') ? 'selected' : '' ; ?>                     >UKH Seni</option>
                                <option <?php echo ($data['divisi'] == 'UKH Olahraga') ? 'selected' : '' ; ?>                 >UKH Olahraga</option>
                                <option <?php echo ($data['divisi'] == 'UKH Jurnalistik') ? 'selected' : '' ; ?>              >UKH Jurnalistik</option>
                                <option <?php echo ($data['divisi'] == 'UKH Cinta Alam') ? 'selected' : '' ; ?>               >UKH Cinta Alam</option>
                                <option <?php echo ($data['divisi'] == 'UKH Kewirausahaan') ? 'selected' : '' ; ?>            >UKH Kewirausahaan</option>
                                <option <?php echo ($data['divisi'] == 'UKH Bahasa') ? 'selected' : '' ; ?>                   >UKH Bahasa</option>
                              </select>
                            </div>
              
                            <div class="text-gray-700">
                                <label class="block mb-1" for="forms-labelOverInputCode">Perihal</label>
                                <input name="perihal" class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" value="<?= $data['perihal'] ?>" type="text" placeholder="" id="forms-labelOverInputCode"/>
                              </div>
              
                              <div class="text-gray-700">
                                <label class="block mb-1" for="forms-labelOverInputCode">File</label>
                                <input name="file" class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="file" placeholder="Regular input" id="forms-labelOverInputCode"/>
                              </div>
              
                          </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-indigo bg-white-600 hover:bg-indigo-700 ">
                               <a href="berita_acara.php">Cancel</a>
                              </button>
                            <button type="submit" name="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Edit
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
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
    <!--/footer-->
</div>
<script src="js/main.js"></script>
</body>
<form id="logout-form" action="logout.php" method="POST">
</form>
</html>