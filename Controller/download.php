<?php
session_start();
require_once "../Model/PDO.php"
?>

<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../Views/css/background.scss">

    <link rel="stylesheet" href="../Views/css/style.css">

    <title>we transfer like</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
        <a href="index.php"><img class="logo" src="../Views/images/ostrich.svg" alt=""></a>
                </div>
                <div class="col-md-7">
        <h1 class="text-center">ostifly</h1>
                </div>

            </div>
        </div>
    </header>
<?php
echo ( "$result");
$dir = $result
?>
<div class="">
    <div>
        <div>

        <p> Bravo ! Votre fichier <?php echo $_SESSION['filename']?> a bien été uploadé. Un mail a été envoyé à <?php echo $_SESSION['dest']?>.</p>

		<a href="../index.php">Retour à l'accueil</a>
        </div>
    </div>
</div>

<script src="/view/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
</body>
</html>
