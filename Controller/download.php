<?php
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
    <link rel="stylesheet" href="../Views/css/bootstrap.min.css">

    <link rel="stylesheet" href="../Views/css/style.css">

    <title>we transfer like</title>
</head>
<body>
<header>
    <img src="../Views/images/ostrich.svg" alt="">
</header>
<?php
echo ( "$result");
$dir = $result
?>
<div class="">
    <div>
        <div>
            <a class="down" download='<?=$dir?>' href= http://quangb.marmier.codeur.online/wetransfer-like/Downloads<?=$_GET["dossier"]?><?=$dir?>>Télécharger<?=$dir;?></a>
        </div>
    </div>
</div>



<?php
session_unset();
session_destroy();
?>
<script src="/view/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
</body>
</html>