<?php
session_start();
require_once("bootstrap.php");
$med = new med();
$license = new license();
//This is a comment....
if (isset($_POST["i"]) && !$user->auth) {

	$chk = $user->login($_POST);

	}
?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta name="application-name" content="MED" data-MED-Version="<?=$med->version;?>" data-MED-License="true">
<link rel="stylesheet" href="lib/css/base.css">
<link rel="stylesheet" href="lib/css/ui.css">
<link rel="stylesheet" href="lib/css/login.css">
<link rel="stylesheet" href="lib/css/slide.css">
<link rel="icon" type="image/png" href="img/icons/icon.png">
<link rel="shortcut icon" type="image/png" href="img/icons/icon.png">
<script src="lib/js/med.js"></script>
<script>
MED.load();
MED.ready(function(){if (document.getElementById("username")) document.getElementById("username").focus();});
</script>
<title>
Med.
</title>
</head>
<body>
<div class="banner">
<div class="subbanner">
Your Logo Here
</div>
<div class="iconholder">
<img src="img/icons/help.png" alt="HELP!">
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="img/icons/css3.png" alt="css3" title="CSS Validator"></a>
<a href="http://validator.w3.org/check?uri=<?=urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");?>&amp;charset=%28detect+automatically%29&amp;doctype=Inline&amp;group=0"><img src="img/icons/html5.png" alt="html5" title="HTML Validator"></a>
</div>
</div>
<?php include MED_PAGE; ?>
<footer>
Bottom Content
</footer>
<div class="copyright">
<?=$med->copyright();?>
</div>
</body>
</html>