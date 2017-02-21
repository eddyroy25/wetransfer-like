<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="Views/css/style.css">

        <title>we transfer like</title>
    </head>
    <body>
        <header>
            <img class ="logo" src="Views/images/ostrich.svg" alt="ostifly logo">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
        <script src="Views/js/main.js"></script>
    </body>
</html>
