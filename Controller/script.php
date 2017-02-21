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
		$dest = $_POST['mail_dest'];
		$objet        	= "Fichier à télécharger sur Ostifly !";
		$contenu      	= "Mail de l'expéditeur l'expéditeur : " .$_POST['mail_exp']. "\r\n";
		$contenu     	= "Bonjour ! \r\n Vous avez reçu une invition de la part de ".$_POST['mail_exp']." pour télécharger un fichier. Nous vous invitons à cliquer sur le lien suivant pour le télécharger : lien . Bonne journée et à bientôt ! L'équipe d'Ostifly.\r\n\n";
		$headers 		= "Content-Type: text/plain; charset=\"utf-8\"; DelSp=\"Yes\"; format=flowed /r/n";
		$headers 		.= "Content-Disposition: inline \r\n";
		$headers 		.= "Content-Transfer-Encoding: 7bit \r\n";
		$headers 		.= "MIME-Version: 1.0";
	
			$target = "../Views/";
			
			$file_tmp = $_FILES["fichier"]['tmp_name'];
			$file = $_FILES["fichier"]['name'];
			$extension = pathinfo($file,PATHINFO_EXTENSION);
			var_dump($extension);
			$files = $file.".".$extension;
			move_uploaded_file($file_tmp, $target.$file);
			mail($dest, $objet, utf8_decode($contenu), $headers);
			
			include ("../Model/PDO.php");
			$exp = $_POST['mail_exp'];
			
			$loginins = $dbh->prepare("INSERT INTO login (email) VALUES (:mail)");
			$loginins->execute([":mail" =>$exp]);
			
			$id_select = $dbh->prepare("SELECT :id_user FROM login");
			$id_user = $dbh->lastInsertId();
			$id_exe = $id_select->execute( [":id_user" => $id_user]);
			$urlins = $dbh->prepare("INSERT INTO filesurl (url, id_user) VALUES (:url, :id_user)");
			$urlins->execute(	[":url" => $target.$file,
								":id_user" => $id_user]);
	}
	
	 // header('Location: ../index.php');