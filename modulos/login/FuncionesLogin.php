<?php
/*
======================================
FUNCTIONS usuarios
======================================
*/
include_once("../../includes/configuracion.php");
include_once("../../includes/capa_datos.php");
require_once("../../clases/mail/class.phpmailer.php");

class Login extends saja
{	
	function ayuda()
	{		
		$this->js("alert('Si presentas algún inconveniente o tienes alguna dificultad apara acceder al sistema, por favor comunícate por el teléfono: ".TELF_ADMINISTRADOR.", o por el correo electrónico: " .EMAIL_ADMINISTRADOR."')");
	}
		
	function iniciar_sesion($id, $jnombre)
	{
		$saja = new saja();
		include_once('ObjetoLogin.class.php');
		$login_usr = new login_usr();
		$resultado = $login_usr->iniciar_sesion($id, $jnombre);
		
		if($resultado == 'VALIDO')
		{
			$this->js("window.top.location ='../principal/index.php'");
		}
		else
		{
			$this->alert($resultado);
			echo utf8_encode($resultado);
		}
	}
	
	function MuestraEje()
	{	
		include_once(PATH.'/gui/ObjetoListBox.class.php');
		$lb = new ListBoxObj();
		$lb->setquery(	"SELECT 
					  		safor_eje.descripcion,
							safor_eje.descripcion
						FROM safor_eje 
						ORDER BY safor_eje.id_eje");
		$lb->setnombre_listbox('txt_eje');
		$lb->setvalor_inicial(array('',''));
		$lb->setajax_event('onchange');
		$lb->setajax_div('ejes');
		$lb->setajax_file_root(PATH."/modulos/login/FuncionesLogin.php");
		$lb->setajax_class_name("Login");
		$lb->GENERA_LISTBOX('','',TRUE);			
	}
	
	function Solicitar($nombre, $correo, $telf, $eje)
	{	
		if (empty($nombre) || empty($correo) || empty($telf) || empty($eje))
		{
			$this->js("alert('Por favor indique todos los campos')");
		}else{
			$mail = new PHPMailer ();
			$mail->From = $correo."@seniat.gob.ve";
			$mail->FromName = $nombre;
			$mail->AddAddress (EMAIL_ADMINISTRADOR);
			$mail->Subject = "Solicitud de Usuario para : ".NOMBRE_SITE;
			setlocale(LC_ALL, 'sp'); 				
			$mail->Body = '	<html>
							<body>
							<table width="500" border="1" cellspacing="0" cellpadding="3">
							<tr>
								<td colspan="2" align="center"><strong>'.NOMBRE_SITE.'</strong></td>
							</tr>
							<tr>
								<td>Nombre y Apellido:</td>
								<td>'.$nombre.'</td>
							</tr>
							<tr>
								<td>Tel&eacute;fono:</td>
								<td>'.$telf.'</td>
							</tr>
							<tr>
								<td>Dependencia:</td>
								<td>'.$eje.'</td>
							</tr>
							</table>
							</body>
							</html>';
			$mail->IsHTML (true);
			$mail->IsSMTP();
			$mail->Host = 'correo.seniat.gob.ve';
			$mail->Port = 25;
			$mail->SMTPAuth = false;
			$mail->Username = '';
			$mail->Password = '';
			
			if(!$mail->Send()){
				$this->js("alert('Error al enviar el email: ".$mail->ErrorInfo."')");
			}
			else {
				$this->js("alert('¡Gracias por su solicitud, pronto estaremos en contacto con usted!')");
				
				$this->text("","txt_nombre:value");
				$this->text("","txt_correo:value");
				$this->text("","txt_telf:value");
				$this->text("","txt_eje:value");
			}
		}	
	}
}
?>