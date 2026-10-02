<?php  
$host="localhost"; 
$user="root";
$password="";
$database="bansos";
$koneksi=mysqli_connect($host,$user,$password) or die ("koneksi gagal");
 mysqli_select_db($koneksi,$database)or die ("Db tidak bisa di buka");
?>