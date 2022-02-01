<?php
if(!defined('MyConst')) {
    echo "
         <script>
             document.location.href = 'surat_keputusan.php';
         </script>";
}

if (isset($_GET['hapus'])) {
    $hapus = new surat_keputusan;
    $hapus->hapus_surat_keputusan($_POST);
}

class surat_keputusan{
    public $conn;

    public function __construct()
    {
        include 'koneksi.php';
        $this->conn = $koneksi;
    }

    public function add_surat_keputusan()
    {
        $sk = $_POST['nomor_surat'];
        $perihal = $_POST['perihal'];
        $tanggal_surat = $_POST['tanggal_surat'];

        $filesname = $_FILES['file']['tmp_name'];
        $datefile = "surat_keputusan_".date('dmYHis');
        $path = "public/surat_keputusan/".$datefile;
        if(!move_uploaded_file($filesname, $path)){header("location:surat_keputusan.php?pesan=gagal_input"); return;}

        $sql = mysqli_query($this->conn, 
                "INSERT INTO tblsurat_keputusan
                VALUES('','$sk','$tanggal_surat','$perihal','$datefile')");
        if ($sql) {
            header("location:surat_keputusan.php?pesan=input");
        } else {
            header("location:surat_keputusan.php?pesan=gagal_input");
        }
    }

    public function edit_surat_keputusan()
    {
        $id = $_POST['id'];
        $sk = $_POST['nomor_surat'];
        $perihal = $_POST['perihal'];
        $tanggal_surat = $_POST['tanggal_surat'];

        $sql = mysqli_query($this->conn, 
                    "UPDATE  tblsurat_keputusan
                    SET sk='$sk',
                        perihal='$perihal',
                        tglsurat='$tanggal_surat'
                    WHERE id='$id'");

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $sqlOldFile = mysqli_query($this->conn, "SELECT * FROM tblsurat_keputusan WHERE id=$id");
            $oldFile = mysqli_fetch_assoc($sqlOldFile);
            unlink('public/surat_keputusan/'.$oldFile['file']);

            $filesname = $_FILES['file']['tmp_name'];
            $datefile = "surat_keputusan_".date('dmYHis');
            $path = "public/surat_keputusan/".$datefile;
            if(!move_uploaded_file($filesname, $path)){header("location:surat_keputusan.php?pesan=gagal_update"); return;}
    
            $sql = mysqli_query($this->conn, 
                    "UPDATE  tblsurat_keputusan
                    SET file='$datefile'
                    WHERE id='$id'");
        }
        
        if ($sql) {
            header("location:surat_keputusan.php?pesan=update");
        } else {
            header("location:surat_keputusan.php?pesan=gagal_update");
        }
    }

    public function hapus_surat_keputusan()
    {
        $id = $_POST['id'];
        $sql = mysqli_query($this->conn, "SELECT * FROM tblsurat_keputusan WHERE id=$id");
        $data = mysqli_fetch_assoc($sql);
        unlink('public/surat_keputusan/'.$data['file']);

        $sql = mysqli_query($this->conn, "DELETE FROM tblsurat_keputusan WHERE id=$id");

        if ($sql) {
            header("location:surat_keputusan.php?pesan=hapus");
        } else {
            header("location:surat_keputusan.php?pesan=gagal_hapus");
        }
    }
}