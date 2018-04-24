<?php 
/*
======================================
*/
include_once("../../includes/capa_datos.php");


class login_usr
{
	public  $seniat_users_id;
	public  $seniat_users_nombre;
	public  $seniat_users_eje;
	public  $ahora;
	public  $error;
	
	/**
 Get the seniat_users_id column value.
 * @return int
 */
	public function getseniat_users_id()
	{
		return $this->seniat_users_id;
	}

	/**
 Set the seniat_users_id column value.
 * @param int $seniat_users_id new value
 * @return void
 */
	public function setseniat_users_id( $seniat_users_id)
	{
		$this->seniat_users_id= $seniat_users_id;
	}

	/**
 Get the seniat_users_nombre column value.
 * @return 
 */
	public function getseniat_users_nombre()
	{
		return $this->seniat_users_nombre;
	}

	/**
 Set the seniat_users_nombre column value.
 * @param  $seniat_users_nombre new value
 * @return void
 */
	public function setseniat_users_nombre( $seniat_users_nombre)
	{
		$this->seniat_users_nombre= $seniat_users_nombre;
	}

	public function getseniat_users_eje()
	{
		return $this->seniat_users_eje;
	}
	
	/**
 Set the seniat_users_eje column value.
 * @param int $seniat_users_eje new value
 * @return void
 */
	public function setseniat_users_eje( $seniat_users_eje)
	{
		$this->seniat_users_eje= $seniat_users_eje;
	}


	/**
 Get the error validation.
 * @return string
 */
	public function geterror()
	{
		return $this->error;
	}

	/**
 Set the error validation.
 * @param string $error new value
 * @return string
 */
	public function seterror($error)
	{
		if ($this->error=='' && $error!='')$this->error='Verifique los siguentes errores: \n\n';
		$this->error .= $error.'\n';
	}
	
	function  iniciar_sesion($id , $jnombre)
	{
		$error = '';
		$id = trim($id);
		
		$SQL = "SELECT * FROM seniat_users  where seniat_users_id='".$id."' AND seniat_users_bloqueado=0";

		$DB=DB_CONECCION();
		$rs = $DB->Execute($SQL) or die("Error verificando");

		if (!$rs->EOF){
			$_SESSION['seniat_users_id_safor'] = $rs->fields['seniat_users_id'];
			$_SESSION['seniat_users_nombre_safor'] = $rs->fields['seniat_users_nombre'];
			$_SESSION['seniat_users_eje_safor'] = $rs->fields['seniat_users_eje'];
			$SQL = "SELECT descripcion FROM safor_eje WHERE id_eje='".$_SESSION['seniat_users_eje_safor']."'";
			$rseje = $DB->Execute($SQL) or die("Error Consultando");
			$_SESSION['seniat_users_eje_des_safor'] = $rseje->fields['descripcion'];
			$_SESSION['autentificado_safor'] = "SI";
			$this->ahora = date("Y-n-j H:i:s");
			$_SESSION["ultimoAcceso_safor"] = $this->ahora;			
			$_SESSION["fingerprint_safor"] = $this->fingerprint();
			//para que no modifique
			$SQL = "UPDATE seniat_users SET fingerprint ='".$_SESSION["fingerprint_safor"] ."' WHERE seniat_users_id='".$_SESSION['seniat_users_id_safor']."'";
			$rs = $DB->Execute($SQL )or die('error db');
			$this->inicio_log($id, utf8_encode("Logeado"), $_SESSION['seniat_users_eje_safor']);
			return "VALIDO";
		}else{
			$this->inicio_log($id, utf8_encode("Usuario no esta en la base de datos"), 0);
			return  "Usuario $id no esta en la base de datos o fue bloqueado para acceder";
		}
	}

	function inicio_log($id, $mensaje, $eje)
	{	 
		$SQL= "INSERT INTO `seniat_users_log` (id, ip, accion, valor, id_eje) VALUES ('$id' , '".$_SERVER [ 'REMOTE_ADDR' ]."', '$mensaje', 'Login', ".$eje.")";
		$db=DB_CONECCION();
		$rs = $db->Execute($SQL) or die("Error consultando");
	}

	 /**
	 * huella de seguridad de la session
	 *
	 * @return md5[string]
	 */
	function fingerprint()
	{
		$fingerprint .= $_SERVER['HTTP_USER_AGENT'];
		$fingerprint .= $_SESSION['seniat_users_id_sigme'];
		$fingerprint .= $_SERVER['REMOTE_ADDR'];
		
		return md5($fingerprint);
	}
	
	 /**
	 * Metodo para verificar la sesion del usuario logeado
	 *
	 * @return boolean
	 */
	function  Chequear_sesion()
	{	
		$DB = DB_CONECCION();	
		$SQL = "select fingerprint  from  seniat_users  where  seniat_users_id  = '". $_SESSION['seniat_users_id_sigme'] ."'";
		$rs = $DB->Execute($SQL )or die('error db');
		if($_SESSION['fingerprint_sigme']=="") return '0'; 
		if($rs->fields['fingerprint']!= $_SESSION['fingerprint_sigme']) return '0';		
		if($rs->fields['fingerprint']== $_SESSION['fingerprint_sigme']) return '1';
	}
}
?>