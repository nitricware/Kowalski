<?php
	/** @var siteVars $siteVars */
	/** @var Tonic $tpl */
	
	use NitricWare\Tonic;
	
	require "init.php";
	
	if (isset($_POST["password"])) {
		if (sha1($_POST["password"]) == $siteVars->passHash) {
			setcookie("kowalski_admin", true);
			header("Location: admin.php");
		}
	}
	
	$tpl->load("./system/view/".$siteVars->adminDesign."/html/admin_login.html");
	
	echo $tpl->render();
