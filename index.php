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
            <img class="logo" src="Views/images/ostrich.svg" alt="">
        </header>
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-6">
                    <main>
                        <form id="formulaire" enctype="multipart/form-data" class="form" action="Controller/script.php" method="post">

                            <input type="hidden" name="MAX_FILE_SIZE" value="300000000000" />

                            <input id="fichier" type="file" name="fichier" value="">
                            <span  id="fichier_err"> <?php echo $_SESSION["fichier_erreur"];?></span>

                            <input id="mail_dest" type="email" name="mail_dest" value="" placeholder="Email destinataire">
                            <span  id="mail_dest_err"> <?php echo $_SESSION["mail_dest_erreur"];?></span>

                            <input id="mail_exp" type="email" name="mail_exp" value="" placeholder="Mon Email">
                            <span  id="mail_exp_err"> <?php echo $_SESSION["mail_exp_erreur"];?></span>

                            <button id="env" type="submit" name="env">Envoyer</button>

                            <span  id="alerte"></span>

                        </form>

                    </main>
                </div>
            </div>
        </div>
		<div id="clouds">
		</div>



<?php
	session_unset();
	include ('Controller/retrieve_url.php');
	session_destroy();
?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
        <script src="Views/js/main.js"></script>
		<script src="Views/js/background.js"></script>
    </body>
</html>
