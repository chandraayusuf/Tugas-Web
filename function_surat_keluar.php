<?php
if(!defined('MyConst')) {
    echo "
         <script>
             document.location.href = 'surat_keluar.php';
         </script>";
}

if (isset($_GET['hapus'])) {
    $hapus = new surat_keluar;
    $hapus->hapus_surat_keluar($_POST);
}

class surat_keluar{
    public $conn;

    public function __construct()
    {
        include 'koneksi.php';
        $this->conn = $koneksi;
    }

    public function add_surat_keluar()
    {
        $skl = $_POST['nomor_surat'];
        $tanggal_surat = $_POST['tanggal_surat'];
        $tanggal_keluar = $_POST['tanggal_dikeluarkan'];
        $pengirim = $_POST['pengirim'];
        $tujuan = $_POST['tujuan'];
        $perihal = $_POST['perihal'];

        $filesname = $_FILES['file']['tmp_name'];
        $datefile = "surat_keluar_".date('dmYHis');
        $path = "public/surat_keluar/".$datefile;
        if(!move_uploaded_file($filesname, $path)){header("location:surat_keluar.php?pesan=gagal_input"); return;}

        $sql = mysqli_query($this->conn, 
                "INSERT INTO tblsurat_keluar
                VALUES('','$skl','$tanggal_surat','$tanggal_keluar','$pengirim','$tujuan','$perihal','$datefile')");
        if ($sql) {
            header("location:surat_keluar.php?pesan=input");
        } else {
            header("location:surat_keluar.php?pesan=gagal_input");
        }
    }

    public function edit_surat_keluar()
    {
        $id = $_POST['id'];
        $skl = $_POST['nomor_surat'];
        $tanggal_surat = $_POST['tanggal_surat'];
        $tanggal_keluar = $_POST['tanggal_dikeluarkan'];
        $pengirim = $_POST['pengirim'];
        $tujuan = $_POST['tujuan'];
        $perihal = $_POST['perihal'];

        $sql = mysqli_query($this->conn, 
                    "UPDATE tblsurat_keluar
                    SET skl='$skl',
                        tglsurat='$tanggal_surat',
                        tglkeluar='$tanggal_keluar',
                        pengirim='$pengirim',
                        tujuan='$tujuan',
                        perihal='$perihal'
                    WHERE id=$id");


        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $sqlOldFile = mysqli_query($this->conn, "SELECT * FROM tblsurat_keluar WHERE id=$id");
            $oldFile = mysqli_fetch_assoc($sqlOldFile);
            unlink('public/surat_keluar/'.$oldFile['file']);

            $filesname = $_FILES['file']['tmp_name'];
            $datefile = "surat_keluar_".date('dmYHis');
            $path = "public/surat_keluar/".$datefile;
            if(!move_uploaded_file($filesname, $path)){header("location:surat_keluar.php?pesan=gagal_update"); return;}
    
            $sql = mysqli_query($this->conn, 
                    "UPDATE tblsurat_keluar
                    SET file='$datefile'
                    WHERE id=$id");
        }
        
        if ($sql) {
            header("location:surat_keluar.php?pesan=update");
        } else {
            header("location:surat_keluar.php?pesan=gagal_update");
        }
    }

    public function hapus_surat_keluar()
    {
        $id = $_POST['id'];

        $sql = mysqli_query($this->conn, "SELECT * FROM tblsurat_keluar WHERE id=$id");
        $data = mysqli_fetch_assoc($sql);
        unlink('public/surat_keluar/'.$data['file']);

        $sql = mysqli_query($this->conn, "DELETE FROM tblsurat_keluar WHERE id=$id");
        if ($sql) {
            header("location:surat_keluar.php?pesan=hapus");
        } else {
            header("location:surat_keluar.php?pesan=gagal_hapus");
        }
    }
}