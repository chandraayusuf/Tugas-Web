<?php
if(!defined('MyConst')) {
    echo "
         <script>
             document.location.href = 'inventaris_barang.php';
         </script>";
}

if (isset($_GET['hapus'])) {
    $hapus = new inventaris_barang;
    $hapus->hapus_inventaris_barang($_POST);
}

class inventaris_barang{
    public $conn;

    public function __construct()
    {
        include 'koneksi.php';
        $this->conn = $koneksi;
    }

    public function add_inventaris_barang()
    {
        $brg = $_POST['nomor_barang'];
        $nama_barang = $_POST['nama_barang'];
        $jenis = $_POST['jenis_barang'];
        $kondisi = $_POST['kondisi'];
        $jumlah = $_POST['jumlah_barang'];

        $filesname = $_FILES['file']['tmp_name'];
        $datefile = "inventaris_barang_".date('dmYHis');
        $path = "public/inventaris_barang/".$datefile;
        if(!move_uploaded_file($filesname, $path)){header("location:inventaris_barang.php?pesan=gagal_input"); return;}

        $sql = mysqli_query($this->conn, 
                "INSERT INTO tblinventaris_brg
                VALUES('','$brg','$nama_barang','$jenis','$kondisi','$jumlah','$datefile')");
        if ($sql) {
            header("location:inventaris_barang.php?pesan=input");
        } else {
            header("location:inventaris_barang.php?pesan=gagal_input");
        }
    }

    public function edit_inventaris_barang()
    {
        $id = $_POST['id'];
        $brg = $_POST['nomor_barang'];
        $nama_barang = $_POST['nama_barang'];
        $jenis = $_POST['jenis_barang'];
        $kondisi = $_POST['kondisi'];
        $jumlah = $_POST['jumlah_barang'];

        $sql = mysqli_query($this->conn, 
                    "UPDATE tblinventaris_brg
                    SET brg='$brg',
                        namabrg='$nama_barang',
                        jenis='$jenis',
                        kondisi='$kondisi',
                        jumlah='$jumlah'
                    WHERE id='$id'");

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $sqlOldFile = mysqli_query($this->conn, "SELECT * FROM tblinventaris_brg WHERE id=$id");
            $oldFile = mysqli_fetch_assoc($sqlOldFile);
            unlink('public/inventaris_barang/'.$oldFile['file']);

            $filesname = $_FILES['file']['tmp_name'];
            $datefile = "inventaris_barang_".date('dmYHis');
            $path = "public/inventaris_barang/".$datefile;
            if(!move_uploaded_file($filesname, $path)){header("location:inventaris_barang.php?pesan=gagal_update"); return;}

            $sql = mysqli_query($this->conn, 
                    "UPDATE tblinventaris_brg
                    SET file='$datefile'
                    WHERE id='$id'");
        }
        
        if ($sql) {
            header("location:inventaris_barang.php?pesan=update");
        } else {
            header("location:inventaris_barang.php?pesan=gagal_update");
        }
    }

    public function hapus_inventaris_barang()
    {
        $id = $_POST['id'];

        $sqlOldFile = mysqli_query($this->conn, "SELECT * FROM tblinventaris_brg WHERE id=$id");
        $oldFile = mysqli_fetch_assoc($sqlOldFile);
        unlink('public/inventaris_barang/'.$oldFile['file']);

        $sql = mysqli_query($this->conn, "DELETE FROM tblinventaris_brg WHERE id=$id");

        if ($sql) {
            header("location:inventaris_barang.php?pesan=hapus");
        } else {
            header("location:inventaris_barang.php?pesan=gagal_hapus");
        }
    }
}