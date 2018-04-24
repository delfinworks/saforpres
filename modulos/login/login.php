<?php
require_once("../../includes/funciones/funciones_iniciales_logout.php");

ob_start();
session_start();
?>

<?php
echo $saja->saja_js();
$saja->set_process_file("../../modulos/login/FuncionesLogin.php");
$saja->set_process_class("Login");

$id = base64_decode($_GET['id']); 
$nombre = base64_decode($_GET['token']); 

if($_SESSION['autentificado_safor']=="SI"){
	echo '<script>location.href="../principal/index.php"</script>';
}else{
	if($id== NULL){ ?>
<table align="center" border="0" cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
              <td width="10" rowspan="2" align="center" valign="middle"><img src="../../images/lr.jpg" /></td>
              <td height="51" align="center" valign="middle"><img src="../../images/SAFORPRE_L.jpg" alt="" /></td>
              </tr>
            <tr>
              <td width="350" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td width="374"><table width="100%" border="0" bordercolor="#ff0000" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td colspan="9" align="right"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ImageA','','../../images/ayuda_on.jpg',1)" onClick="<?PHP echo $saja->run("ayuda()"); ?>;return false;"  ><img src="../../images/ayuda_off.jpg" align="right" name="ImageA" width="16" height="16" border="0" id="ImageA" /></a></td>
                        </tr>
                        <tr bordercolor="#CCCCCC">
                          <td colspan="9" align="center"><p>Disculpe ahora para poder acceder al Sistema deber&aacute; validar su  Nombre de usuario y Contrase&ntilde;a en la Pagina Principal de la Oficina de  Planificaci&oacute;n y Presupuesto desde el m&oacute;dulo siguiente.</p>
                            <p><img src="../../images/Acceso2.png" width="114" height="165" /></p>
                          <p>Si usted aun no tiene permiso para entrar al sistema puede  solicitarlo <a href="solicitud.php">aqu&iacute;</a> (Solo Usuarios Nuevos)</p></td>
                        </tr>
                        <tr class="bordeFila">
                          <td colspan="9">&nbsp;</td>
                        </tr>
                        <tr class="bordeFila">
                          <td colspan="9" align="center"><a href="#" onclick="window.location='../../../../../opp.php'; "><img src="../../images/volver_sis.jpg" alt="" width="180" border="0" /></a></td>
                        </tr>
                        <tr class="bordeFila">
                          <td width="10%"></td>
                          <td width="1%"></td>
                          <td colspan="5" height="4"></td>
                          <td width="2%"></td>
                          <td width="9%"></td>
                        </tr>
                      </tbody>
                      </table></td>
                  </tr>
                </tbody>
              </table></td>
              </tr>
          </tbody>
        </table>
	<?php }else{ ?>
<table align="center" border="0" cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
              <td height="51" align="center" valign="middle"><img src="../../images/SAFORPRE_L.jpg" alt="" /></td>
              </tr>
            <tr>
              <td width="350" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td width="374"><table width="100%" border="0" bordercolor="#ff0000" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td colspan="9" align="right"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ImageA','','../../images/ayuda_on.jpg',1)" onClick="<?PHP echo $saja->run("ayuda()"); ?>;return false;"  ><img src="../../images/ayuda_off.jpg" align="right" name="ImageA" width="16" height="16" border="0" id="ImageA" /></a></td>
                        </tr>
                        <tr bordercolor="#CCCCCC">
                          <td colspan="9" align="center"><?PHP echo $nombre; ?> esta a punto de acceder al Sistema de Formulacion de Planes y Presupuesto dise&ntilde;ado por la Oficina de Planificaci&oacute;n y Presupuesto para el Registro y Control de la Proyectos de las Unidades Responsables.</td>
                        </tr>
                        <tr class="bordeFila">
                          <td colspan="9">&nbsp;</td>
                        </tr>
                        <tr class="bordeFila">
                          <td width="10%">&nbsp;</td>
                          <td width="1%">&nbsp;</td>
                          <td width="43%" align="center" bordercolor="#FF0000"><a href="#" onClick="<?PHP echo $saja->run("iniciar_sesion('$id','$nombre')->div2:innerHTML"); ?>;return false;"><img src="../../images/entrar_sis.jpg" width="180" height="59" /></a></td>
                          <td width="2%">&nbsp;</td>
                          <td colspan="3" bordercolor="#FF0000"><a href="#" onclick="window.location='../../../../../opp.php'; "><img src="../../images/volver_sis.jpg" width="180" height="59" /></a></td>
                          <td width="2%">&nbsp;</td>
                          <td width="9%">&nbsp;</td>
                        </tr>
                        <tr class="bordeFila">
                          <td colspan="9">&nbsp;</td>
                        </tr>
                        <tr class="bordeFila">
                          <td></td>
                          <td></td>
                          <td colspan="5" height="4"></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                      </table></td>
                  </tr>
                </tbody>
              </table></td>
              </tr>
          </tbody>
        </table>
    <?php
	}
}
?>
</body>
</html>