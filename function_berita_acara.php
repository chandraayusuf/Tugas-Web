<?php
if(!defined('MyConst')) {
    echo "
         <script>
             document.location.href = 'berita_acara.php';
         </script>";
}
if (isset($_GET['hapus'])) {
    $hapus = new berita_acara;
    $hapus->hapus_berita_acara($_POST);
}
class berita_acara{
    public $conn;

    public function __construct()
    {
        include 'koneksi.php';
        $this->conn = $koneksi;
    }

    public function add_berita_acara()
    {
        $ba = $_POST['nomor_berita_acara'];
        $tanggal = $_POST['tanggal'];
        $waktu = $_POST['waktu'];
        $divisi = $_POST['divisi'];
        $perihal = $_POST['perihal'];

        $filesname = $_FILES['file']['tmp_name'];
        $datefile = "berita_acara_".date('dmYHis');
        $path = "public/berita_acara/".$datefile;
        if(!move_uploaded_file($filesname, $path)){header("location:berita_acara.php?pesan=gagal_input"); return;}

        $sql = mysqli_query($this->conn, "INSERT INTO tblberita_acara VALUES('','$ba','$tanggal','$waktu','$divisi','$perihal','$datefile')");
        if ($sql) {
            header("location:berita_acara.php?pesan=input");
        } else {
            header("location:berita_acara.php?pesan=gagal_input");
        }
        
    }

    public function edit_berita_acara()
    {
        $id=$_GET['id'];
        $ba = $_POST['nomor_berita_acara'];
        $tanggal = $_POST['tanggal'];
        $waktu = $_POST['waktu'];
        $divisi = $_POST['divisi'];
        $perihal = $_POST['perihal'];

        $sql = mysqli_query($this->conn, "UPDATE tblberita_acara 
                                SET  ba='$ba',
                                     tanggal='$tanggal',
                                     waktu='$waktu',
                                     divisi='$divisi',
                                     perihal='$perihal' 
                                WHERE id=$id");

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $sqlOldFile = mysqli_query($this->conn, "SELECT * FROM tblberita_acara WHERE id=$id");
            $oldFile = mysqli_fetch_assoc($sqlOldFile);
            unlink('public/berita_acara/'.$oldFile['file']);

            $filesname = $_FILES['file']['tmp_name'];
            $datefile = "berita_acara_".date('dmYHis');
            $path = "public/berita_acara/".$datefile;
            if(!move_uploaded_file($filesname, $path)){header("location:berita_acara.php?pesan=gagal_update");return;}

            $sql = mysqli_query($this->conn, "UPDATE tblberita_acara 
                                SET  file='$datefile'
                                WHERE id='$id'");
        }
        if ($sql) {
            header("location:berita_acara.php?pesan=update");
        } else {
            header("location:berita_acara.php?pesan=gagal_update");
        }
    }

    public function hapus_berita_acara()
    {
        $id=$_POST['id'];

        $sql = mysqli_query($this->conn, "SELECT * FROM tblberita_acara WHERE id=$id");
        $data = mysqli_fetch_assoc($sql);
        unlink('public/berita_acara/'.$data['file']);

        $sql = mysqli_query($this->conn, "DELETE FROM tblberita_acara WHERE id=$id");
        if ($sql) {
            header("location:berita_acara.php?pesan=hapus");
        } else {
            header("location:berita_acara.php?pesan=gagal_hapus");
        }
    }
}
