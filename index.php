<?php 
error_reporting(E_ALL & ~E_NOTICE);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>we transfer like</title>
    </head>
    <body>
        <header>
            <img src="" alt="">
        </header>
        <main>
            <form id="formulaire" enctype="multipart/form-data" class="form" action="Controller/script.php" method="post">
				<input type="hidden" name="MAX_FILE_SIZE" value="300000000000" />
                <input id="fichier" type="file" name="fichier" value="">
				<span  id="fichier_err"> <?php echo $_SESSION["fichier_erreur"];?></span>
                <input id="mail_dest" type="text" name="mail_dest" value="">
				<span  id="mail_dest_err"> <?php echo $_SESSION["mail_dest_erreur"];?></span>
                <input id="mail_exp" type="text" name="mail_exp" value="">
				<span  id="mail_exp_err"> <?php echo $_SESSION["mail_exp_erreur"];?></span>
                <input type="submit" name="envoyer" value="">
				<span  id="alerte"></span>
            </form>
        </main>
<?php
	session_unset(); 
	session_destroy(); 
?>
    </body>
</html>
