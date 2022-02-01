<?php 
include 'koneksi.php';
 
$username = $_POST['username'];
$password = md5($_POST['password']);
 
$login = mysqli_query($koneksi, "SELECT * FROM `admin` where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);
 
if($cek > 0){
	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['login'] = true;
	header("location:dasboard.php");
}else{
	header("location:index.php");	
}
 
?>