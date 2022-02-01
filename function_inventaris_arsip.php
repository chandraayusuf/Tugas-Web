<?php
if(!defined('MyConst')) {
    echo "
         <script>
             document.location.href = 'inventaris_arsip.php';
         </script>";
}

if (isset($_GET['hapus'])) {
    $hapus = new inventaris_arsip;
    $hapus->hapus_inventaris_arsip($_POST);
}

class inventaris_arsip{
    public $conn;

    public function __construct()
    {
        include 'koneksi.php';
        $this->conn = $koneksi;
    }

    public function add_inventaris_arsip()
    {
        $isurat = $_POST['nomor_surat'];
        $tanggal_surat = $_POST['tanggal_surat'];
        $tanggal_ritensi = $_POST['tanggal_ritensi'];
        $perihal = $_POST['perihal'];

        $filesname = $_FILES['file']['tmp_name'];
        $datefile = "inventaris_arsip_".date('dmYHis');
        $path = "public/inventaris_arsip/".$datefile;
        if(!move_uploaded_file($filesname, $path)){header("location:inventaris_arsip.php?pesan=gagal_input"); return;}

        $sql = mysqli_query($this->conn, 
                "INSERT INTO tblinventaris_surat
                VALUES('','$isurat','$tanggal_surat','$tanggal_ritensi','$perihal','$datefile')");
        if ($sql) {
            header("location:inventaris_arsip.php?pesan=input");
        } else {
            header("location:inventaris_arsip.php?pesan=gagal_input");
        }
    }

    public function edit_inventaris_arsip()
    {
        $id = $_POST['id'];
        $isurat = $_POST['nomor_surat'];
        $tanggal_surat = $_POST['tanggal_surat'];
        $tanggal_ritensi = $_POST['tanggal_ritensi'];
        $perihal = $_POST['perihal'];

        $sql = mysqli_query($this->conn, 
        "UPDATE tblinventaris_surat
        SET isurat='$isurat',
            tglsurat='$tanggal_surat',
            tglritensi='$tanggal_ritensi',
            perihal='$perihal'
            WHERE id='$id'");

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $sqlOldFile = mysqli_query($this->conn, "SELECT * FROM tblinventaris_surat WHERE id=$id");
            $oldFile = mysqli_fetch_assoc($sqlOldFile);
            unlink('public/inventaris_arsip/'.$oldFile['file']);

            $filesname = $_FILES['file']['tmp_name'];
            $datefile = "inventaris_arsip_".date('dmYHis');
            $path = "public/inventaris_arsip/".$datefile;
            if(!move_uploaded_file($filesname, $path)){header("location:inventaris_arsip.php?pesan=gagal_update"); return;}
    
            $sql = mysqli_query($this->conn, 
                    "UPDATE tblinventaris_surat
                    SET file='$datefile'
                    WHERE id='$id'");
        }
        
        if ($sql) {
            header("location:inventaris_arsip.php?pesan=update");
        } else {
            header("location:inventaris_arsip.php?pesan=gagal_update");
        }
    }

    public function hapus_inventaris_arsip()
    {
        $id = $_POST['id'];

        $sql = mysqli_query($this->conn, "SELECT * FROM tblinventaris_surat WHERE id=$id");
        $data = mysqli_fetch_assoc($sql);
        unlink('public/inventaris_arsip/'.$data['file']);

        $sql = mysqli_query($this->conn, "DELETE FROM tblinventaris_surat WHERE id=$id");
        if ($sql) {
            header("location:inventaris_arsip.php?pesan=hapus");
        } else {
            header("location:inventaris_arsip.php?pesan=gagal_hapus");
        }
    }
}