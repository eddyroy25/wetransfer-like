<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

$erreur = false;


if ( (isset($_POST["login"])) && (strlen(trim($_POST["login"])) > 0) && (filter_var($_POST["login"], FILTER_VALIDATE_EMAIL)) ) {
    $destinataire = stripslashes(strip_tags($_POST["login"]));
} 
else if (empty($_POST["login"])) {
    $_SESSION['login_erreur'] = "Merci d'écrire une adresse email";
    $erreur = true;
} 
else {
    $_SESSION['login_erreur'] = "Email invalide";
    $erreur = true;
}

if ($erreur == false) {
	
		include ("../Model/PDO.php");
		
		$mail_dest = $_POST["login"];
		$_SESSION['dest'] = $mail_dest;
		$target = "../Downloads/";
		$filedisp = $dbh->prepare("SELECT url FROM filesurl WHERE emaildestinataire = :email");
					$filedisp->execute([":email" => $_SESSION['dest']]);
					$filetab = $filedisp->fetchAll();

					foreach ($filetab as $item) {
						print $item["url"];
					
		$download_directory = "http://eddyr.marmier.codeur.online/Ostifly/wetransfer-like/Downloads/".$item["url"];
		$download_file = $target.$item["url"];
		$file = $item["url"];
					}
		$_SESSION['file'] = $download_file;
		$_SESSION['download'] = $download_directory;
		$_SESSION['filename'] = $file;

	header ('Location: ../Views/displayview.php');
	
}
	
	
	