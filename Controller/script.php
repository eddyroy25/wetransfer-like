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
        $expediteur = stripslashes(strip_tags($_POST["Email"]));
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
		$objet        = "Fichier à télécharger sur Ostifly !";
		$contenu      = "Mail de l'expéditeur l'expéditeur : " .$_POST['mail_exp']. "\r\n";
		$contenu     	="Bonjour ! \r\n Vous avez reçu une invition de la part de".$_POST['mail_exp']." pour télécharger un fichier. Nous vous invitons à cliquer sur le lien suivant pour le télécharger : lien . Bonne journée et à bientôt ! L'équipe d'Ostifly.\r\n\n";
	 
		$headers .= "Content-Type: text/plain; charset=\"utf-8\"; DelSp=\"Yes\"; format=flowed /r/n";
		$headers .= "Content-Disposition: inline \r\n";
		$headers .= "Content-Transfer-Encoding: 7bit \r\n";
		$headers .= "MIME-Version: 1.0";
	 
		// if ( (empty($_FILES["fichier"]['name'])) && (empty($_POST["mail_dest"])) && (empty($_POST["mail_exp"]))) {
			// echo 'Erreur <br /><a href="../index.html">Retour</a>';
		// }
		
			mail($dest, $objet, utf8_decode($contenu), $headers);
			$target = "Views/";
			$file = $_FILES["fichier"]['tmp_name'];
			move_uploaded_file($target,$file);
	}
	
	 header('Location: ../index.php');