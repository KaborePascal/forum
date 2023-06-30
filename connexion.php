<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "forum2023";
// create connexion
$cn = mysqli_connect($host,$username,$password,$dbname);

if(!$cn){
    die("connexion failed:".mysqli_connect_error());
}


?>