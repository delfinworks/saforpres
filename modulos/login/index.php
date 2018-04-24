<?php
	include('../../../../../ecojoom15.php');
	include_once("../../includes/capa_datos.php");
		
	$user = JFactory::getUser(); 
	
	$SQL = ("SELECT seniat_users_id FROM seniat_users WHERE seniat_users_id = '".$user->username."'");
	$db=DB_CONECCION();
	$rs = $db->Execute($SQL) or die("Error consultando");
	
	if (!$rs->EOF){
		echo "<script>location.href='login.php?id=".base64_encode($user->username)."&token=".base64_encode($user->name)."'</script>";
	}else{
		echo "<script>location.href='login.php?id=&token=".base64_encode($user->name)."'</script>";
	}
?>