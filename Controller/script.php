<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

$fichier = $destinataire = $expediteur = "";
$erreur = false;

if ((empty($_FILES["fichier"]['name']))) {
    $_SESSION["fichier_erreur"] = "Fichier non sélectionné";
    $fichier = "";
    $erreur = true;
}

if ( (isset($_POST["mail_dest"])) && (strlen(trim($_POST["mail_dest"])) > 0) && (filter_var($_POST["mail_dest"], FILTER_VALIDATE_EMAIL)) ) {
    $destinataire = stripslashes(strip_tags($_POST["mail_dest"]));
} elseif (empty($_POST["mail_dest"])) {
    $_SESSION['mail_dest_erreur'] = "Merci d'écrire une adresse email";
    $destinataire = "";
    $erreur = true;
} else {
    $_SESSION['mail_dest_erreur'] = "Email invalide";
    $destinataire = "";
    $erreur = true;
}

if ( (isset($_POST["mail_exp"])) && (strlen(trim($_POST["mail_exp"])) > 0) && (filter_var($_POST["mail_exp"], FILTER_VALIDATE_EMAIL)) ) {
    $expediteur = stripslashes(strip_tags($_POST["mail_exp"]));
} elseif (empty($_POST["mail_dest"])) {
    $_SESSION['mail_dest_erreur'] = "Merci d'écrire une adresse email";
    $expediteur = "";
    $erreur = true;
} else {
    $_SESSION['mail_dest_erreur'] = "Email invalide";
    $expediteur = "";
    $erreur = true;
}

if ($erreur == false) {
	
	include ("../Model/PDO.php");

    $target = "../Downloads/";

    $file_tmp = $_FILES["fichier"]['tmp_name'];
    $file = $_FILES["fichier"]['name'];
    $extension = pathinfo($file,PATHINFO_EXTENSION);
    var_dump($extension);
    $files = $file.".".$extension;
    move_uploaded_file($file_tmp, $target.$file);

    $exp = $_POST['mail_exp'];
	$dest = $_POST['mail_dest'];
    $loginins = $dbh->prepare("INSERT INTO login (email, email_destinataire) VALUES (:mail, :maild)");
    $loginins->execute(	[	":mail" =>$exp,
							":maild" =>$dest ]);
							
	// $dest_select = $dbh->prepare("SELECT :email_destinataire FROM login");
	// $dest_user = $dbh->lastInsertId();
	// $dest_exe = $dest_select->execute(	[":email_destinataire" => $dest]);_
	// $dest_files = $dbh->prepare("INSERT INTO filesurl (email_destinataire) VALUES (:mail, :maild)");
	
    $id_select = $dbh->prepare("SELECT :id_user, :email_destinataire FROM login");
    $id_user = $dbh->lastInsertId();
    $id_exe = $id_select->execute( [":id_user" => $id_user,
									":email_destinataire" => $dest]);
    $urlins = $dbh->prepare("INSERT INTO filesurl (url, id_user, emaildestinataire) VALUES (:url, :id_user, :email_destinataire)");
    $urlins->execute(	[":url" => $file,
						":id_user" => $id_user,
						":email_destinataire" => $dest]);
	
	$download_file = $target.$file;
	$download_page = "http://eddyr.marmier.codeur.online/Ostifly/wetransfer-like/Controller/download.php";
	$download_directory = "http://eddyr.marmier.codeur.online/Ostifly/wetransfer-like/Downloads/".$file;
	$_SESSION['download'] = $download_directory;
	$_SESSION['file'] = $download_file;
	$_SESSION['filename'] = $file;
	$_SESSION ['dest'] = $dest;
	$dest = $_POST['mail_dest'];
    $objet        	= "Fichier à télécharger sur Ostifly !";
    $contenu      	= "Mail de l'expéditeur l'expéditeur : " .$_POST['mail_exp']. "\r\n";
    $contenu     	= "Bonjour ! \r\n Vous avez reçu une invition de la part de ".$_POST['mail_exp']." pour télécharger un fichier. Nous vous invitons à cliquer sur le lien suivant pour le télécharger : ".$download_page.". Bonne journée et à bientôt ! L'équipe d'Ostifly.\r\n\n";
    $headers 		= "Content-Type: text/plain; charset=\"utf-8\"; DelSp=\"Yes\"; format=flowed /r/n";
    $headers 		.= "Content-Disposition: inline \r\n";
    $headers 		.= "Content-Transfer-Encoding: 7bit \r\n";
    $headers 		.= "MIME-Version: 1.0";
    mail($dest, $objet, utf8_decode($contenu), $headers);
	
	
}
$mail = $_POST["mail_exp"];
$query = "SELECT id_user FROM login WHERE email = $mail";

$query = "SELECT * FROM filesurl, login WHERE login.id_user = filesurl.id_user";
$query=$dbh->query($query);
$result=$query->fetchAll();

if ($result == false){
    header('Location:../index.php');

}

else {
header('Location:download.php');
};

