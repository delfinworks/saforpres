<?php
require_once("../../includes/funciones/funciones_iniciales_logout.php");
ob_start();
session_start();
$saja->set_process_file(PATH."/modulos/login/FuncionesLogin.php");
$saja->set_process_class("Login");

echo $saja->saja_js();
?>

<body>
<script language="JavaScript">
	<?php echo $saja->run("MuestraEje()->eje"); ?>
</script>

<table width="100%" height="268"  border="0" cellpadding="0" cellspacing="0"; background-repeat: no-repeat; text-align: center;>
      <tr>
      <td width="127" height="268"  >&nbsp;</td>
        <td width="546"  >
		<table width="386" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td width="250" align="left" valign="top">
              <img src="../../images/solicitud.jpg" width="250" height="40" />
            <div id="div2" ></div></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr valign="bottom">
                <td width="24">&nbsp;</td>
                <td width="225">&nbsp;</td>
                <td width="21" ><img src="../../images/der_top.gif" width="21" height="15" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><table width="500" border="0" cellspacing="0" cellpadding="3">
                  
                  <tr>
                    <td colspan="3"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ImageA','','../../images/ayuda_on.jpg',1)" onClick="<?PHP echo $saja->run("ayuda()"); ?>;return false;"  ><img src="../../images/ayuda_off.jpg" align="right" name="ImageA" width="16" height="16" border="0" id="ImageA" /></a></td>
                    </tr>
                  <tr>
                    <td><img src="../../images/flecha_roja.gif" alt="" width="9" height="15" /></td>
                    <td class="contenidohome">Nombre y Apellido:</td>
                    <td><input id="txt_nombre" type="text" class="campos" size="30" onChange="javascript:this.value=this.value.toUpperCase();"/></td>
                  </tr>
                  <tr>
                    <td width="12"><img src="../../images/flecha_roja.gif" width="9" height="15" /></td>
                    <td width="120" class="contenidohome">Correo SENIAT:</td>
                    <td width="350"><input name="txt_correo" id="txt_correo" type="text" value="" size="8" maxlength="8" onChange="javascript:this.value=this.value.toLowerCase();" />@seniat.gob.ve</td>
                  </tr>
                  <tr>
                    <td width="12"><img src="../../images/flecha_roja.gif" width="9" height="15" /></td>
                    <td width="120" class="contenidohome">Tel&eacute;fono:</td>
                    <td width="350"><input name="txt_telf" id="txt_telf" type="text" value="" size="20" maxlength="20" /></td>
                    </tr>
                  <tr>
                    <td><img src="../../images/flecha_roja.gif" alt="" width="9" height="15" /></td>
                    <td class="contenidohome">Dependencia:</td>
                    <td><label><div id="eje"></div></label></td>
                  </tr>
                  <tr>
                    <td height="28" colspan="3" align="center"></td>
                  </tr>
                  <tr>
                    <td height="28" colspan="3" align="center"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('enviar','','../../images/b_enviar_on.gif',1)" onClick="<?php echo $saja->run("Solicitar(txt_nombre:value, txt_correo:value, txt_telf:value, txt_eje:value)");?>;return false;" ><img src="../../images/b_enviar_off.gif" name="Image13" width="58" height="22" border="0" id="enviar" /></a><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancelar','','../../images/b_cancelar_on.gif',1)"  onclick="window.location='index.php'; "  ><img src="../../images/b_cancelar_off.gif"  width="58" height="22" border="0" id="cancelar" /></a></td>
                    </tr>
                  </table>  
				  <div id="div_datos" style="display:none" >            
                  <table width="179" border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="10"><img src="../../images/flecha_roja.gif" width="9" height="15" /></td>
                      <td width="78" class="contenidohome">Nombre:</td>
                      <td width="73"><input  type="text" class="campos" id="txtnombre" size="40" tabindex="10" maxlength="60" disabled="disabled" /></td>
                      <td width="73"></td>
                    </tr>
                    <tr>
                      <td><img src="../../images/flecha_roja.gif" width="9" height="15" /></td>
                      <td><span class="contenidohome">Sexo:</span></td>
                      <td><input id="txtsexo" value="" size="20" tabindex="10" maxlength="20" disabled="disabled"  /></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><img src="../../images/flecha_roja.gif" width="9" height="15" /></td>
                      <td>E-mail:</td>
                      <td><input  type="text" id="txtemail" class="input" value="" size="20" tabindex="30" maxlength="45" /></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><img src="../../images/flecha_roja.gif" width="9" height="15" /></td>
                      <td>Contrase&ntilde;a:</td>
                      <td><input  type="password" class="input"  id="txtnewpassword" tabindex="40" value="" size="20" maxlength="45" /></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><img src="../../images/flecha_roja.gif" width="9" height="15" /></td>
                      <td>Reescriba Contrase&ntilde;a:</td>
                      <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','../../images/b_enviar_on.gif',1)">
                        <input  type="password" class="input"  id="txtrenewpassword" tabindex="50" value="" size="20"  maxlength="50" />
                      </a></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('guardar','','../../images/b_guardar_on.gif',1)" onClick="<?PHP echo $saja->run("guardar_password_inicio(txtnewpassword:value,txtrenewpassword:value, txtemail:value, txtcedula:value)->div2:innerHTML"); ?>;return false;"  ><img src="../../images/b_guardar_off.gif"  width="58" height="22" border="0" id="guardar" /></a></td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
				  </div>
			    </td>
                <td background="../../images/der_.gif"><img src="../../images/der_.gif" width="21" height="14" /></td>
              </tr>
              <tr>
                <td><img src="../../images/down_izq.gif" width="24" height="16" /></td>
                <td background="../../images/down_hori.gif"><img src="../../images/down_hori.gif" width="11" height="16" /></td>
                <td><img src="../../images/down_der_esq.gif" width="21" height="16" /></td>
              </tr>
            </table></td>
          </tr>
        </table>		</td>
        <td width="84" style="vertical-align: top"><div id="div2" style="display:none" ></div> </td>
      </tr>
</table>
</form>
