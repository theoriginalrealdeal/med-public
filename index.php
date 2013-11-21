<?php
session_start();
date_default_timezone_set('America/Chicago');
if (isset($_POST["i"])) die(var_dump($_POST));
?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="lib/css/base.css">
<script src="lib/js/med.js"></script>
<title>
Med.
</title>
</head>
<body>
<div class="banner">
<div class="subbanner">
Your Logo Here
</div>
<a href="javascript:;">
<img src="img/icons/help.png" alt="HELP!">
</a>
</div>
<div class="content">
<div class="loginbody">
<div class="login" id="login">
<form method="post" action="index.php" onsubmit="return MED.validate('login');" autocomplete="off">
<input type="hidden" name="i" value="<?=session_id();?>">
<input type="hidden" name="t" value="<?=strtotime(date("Y-m-d H:i:s"));?>">
<input type="hidden" name="p" value="<?=base64_encode($_SERVER["REMOTE_ADDR"]);?>">
<div class="head">
Please log in
</div>
<label for="username">Username</label><br>
<input type="text" name="username" id="username" size="20" maxlength="40"><br>
<label for="password">Password</label><br>
<input type="password" name="password" id="password" size="20" maxlength="40">
</p>
<input type="submit" value="Log In">
</form>
<div class="loginhelp">
<p>
<a href="javascript:;">Reset Password</a> || <a href="javascript:;">About</a>
</p>
</div>
</div>
</div>
</div>
<div class="copyright">
&copy; 2013. V0.0.1a
</div>
</body>
</html>