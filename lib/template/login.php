<div class="content">
<div class="loginbody">
<div class="login" id="login">
<form method="post" action="index.php" onsubmit="return MED.validate('login');" autocomplete="off">
<input type="hidden" name="i" value="<?=session_id();?>">
<input type="hidden" name="t" value="<?=strtotime(date("Y-m-d H:i:s"));?>">
<input type="hidden" name="p" value="<?=base64_encode(ip2long($_SERVER["REMOTE_ADDR"]));?>">
<input type="hidden" name="d" value="<?=$debug?"true":"false";?>">
<input type="hidden" name="l" value="<?=$license->key;?>">
<div class="head">
Please Log In Below
</div>
<?php if (isset($errorArray["login"])) echo "<div class=\"error\">".$errorArray["login"][0]."</div>\n"; ?>
<label for="username">Username</label><br>
<input type="text" name="username" id="username" size="20" maxlength="40"><br>
<label for="password">Password</label><br>
<input type="password" name="password" id="password" size="20" maxlength="40">
<p>
<input type="submit" value="Log In">
</p>
</form>
<div class="loginhelp">
<a href="javascript:;">Reset Password</a> || <a href="javascript:;">About</a>
</div>
</div>
</div>
</div>
<div class="info">
<div class="bold">
Demonstration
</div>
To view information about Med, please <a href="index.php?MED_DO=information">click here</a>
</div>