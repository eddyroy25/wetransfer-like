<?php
require_once ('../Model/PDO.php');




    $mail = $_POST{"email_exp"};
$query = "SELECT id_user FROM login WHERE email = $mail";

$query = "SELECT * FROM filesurl, login WHERE login.id_user = filesurl.id_user";
$query=$dbh->query($query);
$result=$query->fetchAll();

header('Location:download.php');
