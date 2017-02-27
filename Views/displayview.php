<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">

        <title>Ostifly</title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
            <a href="../index.php"><img class="logo" src="images/ostrich.svg" alt=""></a>
                    </div>
                    <div class="col-md-7">
            <h1 class="text-center">ostifly</h1>
                    </div>

                </div>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-6">
                    <main>
                        <div class="list">

                        <p class="sentence">Les fichiers que vous pouvez télécharger sont ici : </p>
                    <?php
					include ("../Model/PDO.php");

					$filedisp = $dbh->prepare("SELECT url FROM filesurl WHERE emaildestinataire = :email");
					$filedisp->execute([":email" => $_SESSION['dest']]);
					$filetab = $filedisp->fetchAll();

					$item = $_SESSION['filename'];

					foreach ($filetab as $item) {

					print "<p><a class='down' download=".$item['url']." href='http://quangb.marmier.codeur.online/wetransfer-like/Downloads/".$item['url']."'>".$item['url']."</a></p>";

					}

					?>
                    </div>
                    </main>
                </div>
            </div>
        </div>
		<div id="clouds">
		</div>



<?php
	session_unset();
	session_destroy();
?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
        <script src="js/main.js"></script>
		<script src="js/background.js"></script>
    </body>
</html>
