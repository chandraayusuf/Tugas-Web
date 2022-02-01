<?php
if(!defined('MyConst')) {
    echo "
         <script>
             document.location.href = 'surat_masuk.php';
         </script>";
}
if (isset($_GET['hapus'])) {
    $hapus = new surat_masuk;
    $hapus->hapus_surat_masuk($_POST);
}
class surat_masuk{
    public $conn;

    public function __construct()
    {
        include 'koneksi.php';
        $this->conn = $koneksi;
    }

    public function add_surat_masuk()
    {
        $sm = $_POST['nomor_surat'];
        $tanggal_surat = $_POST['tanggal_surat'];
        $tanggal_diterima = $_POST['tanggal_diterima'];
        $pengirim = $_POST['pengirim'];
        $penerima = $_POST['penerima'];
        $perihal = $_POST['perihal'];

        $filesname = $_FILES['file']['tmp_name'];
        $datefile = "surat_masuk_".date('dmYHis');
        $path = "public/surat_masuk/".$datefile;
        if(!move_uploaded_file($filesname, $path)){header("location:surat_masuk.php?pesan=gagal_input"); return;}

        $sql = mysqli_query($this->conn, 
                "INSERT INTO tblsurat_masuk
                VALUES('','$sm','$tanggal_surat','$tanggal_diterima','$pengirim','$penerima','$perihal','$datefile')");
        if ($sql) {
            header("location:surat_masuk.php?pesan=input");
        } else {
            header("location:surat_masuk.php?pesan=gagal_input");
        }
    }

    public function edit_surat_masuk()
    {
        $id = $_POST['id'];
        $sm = $_POST['no_surat'];
        $tanggal_surat = $_POST['tanggal_surat'];
        $tanggal_diterima = $_POST['tanggal_diterima'];
        $pengirim = $_POST['pengirim'];
        $penerima = $_POST['penerima'];
        $perihal = $_POST['perihal'];

        $sql = mysqli_query($this->conn, 
                    "UPDATE tblsurat_masuk
                    SET sm='$sm',
                        tglsurat='$tanggal_surat',
                        tglterima='$tanggal_diterima',
                        pengirim='$pengirim',
                        penerima='$penerima',
                        perihal='$perihal'
                    WHERE id='$id'");

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $sqlOldFile = mysqli_query($this->conn, "SELECT * FROM tblsurat_masuk WHERE id=$id");
            $oldFile = mysqli_fetch_assoc($sqlOldFile);
            unlink('public/surat_masuk/'.$oldFile['file']);

            $filesname = $_FILES['file']['tmp_name'];
            $datefile = "surat_masuk_".date('dmYHis');
            $path = "public/surat_masuk/".$datefile;
            if(!move_uploaded_file($filesname, $path)){header("location:surat_masuk.php?pesan=gagal_update"); return;}
    
            $sql = mysqli_query($this->conn, 
                    "UPDATE tblsurat_masuk
                    SET file='$datefile'
                    WHERE id='$id'");
        }
        
        if ($sql) {
            header("location:surat_masuk.php?pesan=update");
        } else {
            header("location:surat_masuk.php?pesan=gagal_update");
        }
    }
    
    public function hapus_surat_masuk()
    {
        $id = $_POST['id'];

        $sql = mysqli_query($this->conn, "SELECT * FROM tblsurat_masuk WHERE id=$id");
        $data = mysqli_fetch_assoc($sql);
        unlink('public/surat_masuk/'.$data['file']);

        $sql = mysqli_query($this->conn, "DELETE FROM tblsurat_masuk WHERE id=$id");
        if ($sql) {
            header("location:surat_masuk.php?pesan=hapus");
        } else {
            header("location:surat_masuk.php?pesan=gagal_hapus");
        }
    }
}