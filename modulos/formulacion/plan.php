<?php
require_once("../../includes/funciones/funciones_iniciales.php");
$saja->set_process_file(PATH."/modulos/formulacion/plan.funciones.php");
$saja->set_process_class("plan_funciones");

echo $saja->saja_js();
$gui->pathway_recorrido("Plan",true);  
?>

<body>
<?php $gui->marco_abrir("Formulación del Plan");?>
<script language="JavaScript">
	<?php echo $saja->run("MuestraEje()->eje");?>

function eje_acc(){
	if (document.getElementById("txteje_id").value!=0){
		<?php 
			echo $saja->run("MuestraStatus(txteje_id:value)->st");
			echo $saja->run("ListProyecto(txteje_id:value)->pry");
		?>
	}else{
		<?php echo $saja->run("LimpiaEje()");?>
	}
}

function pry_acc(){
	if (document.getElementById("txtpry_id").value!=0){
		<?php echo $saja->run("ListAE(txtpry_id:value, txteje_id:value)->ae");?>
	}else{
		<?php echo $saja->run("LimpiaPry()");?>
	}
}

function lisae_acc(){
	if (document.getElementById("txtae_id").value!=0){
		<?php 
			echo $saja->run("GridUM(txtpry_id:value, txtae_id:value, txteje_id:value)->um:innerHTML");
			echo $saja->run("ListAi(txtpry_id:value, txtae_id:value, txteje_id:value)->ai");
		?>
	}else{
		<?php echo $saja->run("LimpiaAe()");?>
	}
}

function lisum_acc(){
	<?php echo $saja->run("GridUM(txtpry_id:value, txtae_id:value, txteje_id:value)->um:innerHTML");	?>
}

function lisai_acc(){
	if (document.getElementById("txtai_id").value!=0){
		<?php echo $saja->run("ListAi(txtpry_id:value, txtae_id:value, txteje_id:value)->ai");?>
	}else{
		<?php echo $saja->run("LimpiaAi()");?>
	}
}

function lisai2_acc(){
	<?php echo $saja->run("ListAi(txtpry_id:value, txtae_id:value, txteje_id:value)->ai");?>
}

function lisai_um_acc(){
	if (document.getElementById("txtai_id").value!=0){
		<?php echo $saja->run("GridUM_Ai(txtai_id:value, txteje_id:value)->um_ai:innerHTML"); ?>
	}else{
		<?php echo $saja->run("LimpiaAi()");?>
	}
}
</script>

<script language="JavaScript">
function script_um(input){ 
var valor = parseInt(input.value);
if (isNaN(valor) ||  valor<0) { 
	document.getElementById(input.name).focus();
	alert('Campo vacío, no numérico o menor que cero'); 
	return input.value=0;
}else{
	document.getElementById(input.name).value = valor;
	var j_total = (parseInt(document.getElementById("um_txt_ene").value) + parseInt(document.getElementById("um_txt_feb").value) + parseInt(document.getElementById("um_txt_mar").value) + parseInt(document.getElementById("um_txt_abr").value) + parseInt(document.getElementById("um_txt_may").value) + parseInt(document.getElementById("um_txt_jun").value) + parseInt(document.getElementById("um_txt_jul").value) + parseInt(document.getElementById("um_txt_ago").value) + parseInt(document.getElementById("um_txt_sep").value) + parseInt(document.getElementById("um_txt_oct").value) + parseInt(document.getElementById("um_txt_nov").value) + parseInt(document.getElementById("um_txt_dic").value));

	document.getElementById("um_txt_total").value = j_total;
}
}

function script_um_ai(input){ 
var valor = parseInt(input.value);
if (isNaN(valor) ||  valor<0) { 
	document.getElementById(input.name).focus();
	alert('Campo vacío, no numérico o menor que cero'); 
	return input.value=0;
}else{
	document.getElementById(input.name).value = valor;
	var j_total = (parseInt(document.getElementById("um_ai_txt_ene").value) + parseInt(document.getElementById("um_ai_txt_feb").value) + parseInt(document.getElementById("um_ai_txt_mar").value) + parseInt(document.getElementById("um_ai_txt_abr").value) + parseInt(document.getElementById("um_ai_txt_may").value) + parseInt(document.getElementById("um_ai_txt_jun").value) + parseInt(document.getElementById("um_ai_txt_jul").value) + parseInt(document.getElementById("um_ai_txt_ago").value) + parseInt(document.getElementById("um_ai_txt_sep").value) + parseInt(document.getElementById("um_ai_txt_oct").value) + parseInt(document.getElementById("um_ai_txt_nov").value) + parseInt(document.getElementById("um_ai_txt_dic").value));

	document.getElementById("um_ai_txt_total").value = j_total;
}
}
</script>

<fieldset id="p0">
<legend>Datos B&aacute;sicos</legend>
  	  	<table border="0">
  	  <tr>
  	    <td><label><div id="des_eje" class="BoldTextGray">Unidad Ejecutora:</div></label></td>
        <td><label><div id="eje"></div></label></td>
        <td width="10">&nbsp;</td>
  	    <td><label><div id="des_rea" class="BoldTextGray">Realizado por:</div></label></td>
        <td><label><div id="txt_rea"><?php echo $_SESSION['seniat_users_nombre_safor']; ?></div></label></td>     
        <td width="10">&nbsp;</td>
  	    <td><label><div id="des_st" class="BoldTextGray" style="display:none">Status:</div></label></td>
        <td><label><div id="st" style="display:none"></div></label></td>
	   </tr>
	  </table>
</fieldset>

<fieldset id="p1" style="display:none">
<legend>Parametros de Formulaci&oacute;n</legend>
  	<table border="0">
  	  <tr>
  	    <td width="192"><label><div id="des_pry" >Acci&oacute;n Centralizada / Proyecto:</div></label></td>
        <td width="23">&nbsp;</td>
  	    <td width="158"><label><div id="des_ae" style="display:none">Acci&oacute;n Especifica:</div></label></td>
        <td width="23">&nbsp;</td>
        <td><label><div id="ae_id_tem" style="display:none"><input name="txtae_id_tem" type="text" id="txtae_id_tem" value="" size="5" maxlength="250"/></div></label></td>
        <td width="158"><label><div id="des_new_ae" style="display:none">Nombre Acci&oacute;n Especifica:</div></label></td>
        <td width="23">&nbsp;</td>
        <td width="23">&nbsp;</td>
      </tr>
       <tr>
  	    <td><label><div id="pry"></div></label></td>
        <td width="23">&nbsp;</td>
  	    <td><label><div id="ae"></div></label></td>
        <td width="23"><label><div id="b_new_ae" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_new_ae','','../../images/b_nuevo_on.gif',1)" onClick="<?php echo $saja->run("NuevoAe()");?>;return false;"  ><img src="../../images/b_nuevo_off.gif" name="i_new_ae" width="58" height="22" border="0" id="i_new_ae" /></a></div></label></td>
        <td width="23"><label><div id="b_ver_ae" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_ver_ae','','../../images/b_mostrar_on.gif',1)" onClick="<?php echo $saja->run("GridAe(txtpry_id:value, txteje_id:value)->ae_unidad:innerHTML");?>;return false;"  ><img src="../../images/b_mostrar_off.gif" name="i_ver_ae" width="58" height="22" border="0" id="i_ver_ae" /></a></div>
<div id="b_no_ver_ae" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_no_ver_ae','','../../images/b_ocultar_on.gif',1)" onClick="<?php echo $saja->run("CancelarAe()");?>;return false;"  ><img src="../../images/b_ocultar_off.gif" name="i_no_ver_ae" width="58" height="22" border="0" id="i_no_ver_ae" /></a></div></label></td>
        <td><label><div id="new_ae" style="display:none"><input name="txt_new_ae" type="text" id="txt_new_ae" value="" size="50" maxlength="250" onChange="javascript:this.value=this.value.toUpperCase();"/></div></label></td>
        <td width="23"><label><div id="b_grabar_ae" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_grabar_ae','','../../images/b_grabar_on.gif',1)" onClick="<?php echo $saja->run("GrabarAe(txtpry_id:value, '0', txt_new_ae:value, txteje_id:value)");?>;return false;"  ><img src="../../images/b_grabar_off.gif" name="i_grabar_ae" width="58" height="22" border="0" id="i_grabar_ae" /></a></div><div id="b_modificar_ae" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_modificar_ae','','../../images/b_modificar_on.gif',1)" onClick="<?php echo $saja->run("GrabarAe(txtpry_id:value, txtae_id_tem:value, txt_new_ae:value, txteje_id:value)");?>;return false;"  ><img src="../../images/b_modificar_off.gif" name="i_modificar_ae" width="58" height="22" border="0" id="i_modificar_ae" /></a></div></label></td>
        <td width="23"><label><div id="b_cancelar_ae" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_cancelar_ae','','../../images/b_cancelar_on.gif',1)" onClick="<?php echo $saja->run("CancelarAe()");?>;return false;"  ><img src="../../images/b_cancelar_off.gif" name="i_cancelar_ae" width="58" height="22" border="0" id="i_cancelar_ae" /></a></div></label></td>
	   </tr>
  </table>
<fieldset id="p1.1" style="display:none">
    <legend>Resumen  de Acciones Espec&iacute;fica de la unidad:</legend>
    <div id='ae_unidad'>
    </div>
</fieldset>
</fieldset>

<fieldset id="p2" style="display:none">
    <legend>Unidades de Medida de la Acci&oacute;n Espec&iacute;fica:</legend>
    <fieldset id="p3"  style="display:none">
        <legend>Detalle de Unidad de Medida:</legend>
        <table border="0">
          <tr>
            <td><label><div id="des_id" >Id:</div></label></td>
            <td><label><input name="txt_id_um" type="text" id="txt_id_um" style="text-align:center" value="" size="8" readonly="readonly" maxlength=""/></label></td>
            <td><label><input name="txt_des_um" type="text" id="txt_des_um" style="text-align:left" value="" size="124" maxlength="250" onChange="javascript:this.value=this.value.toUpperCase();"/></label></td>
             <td width="100"><label><input name="txt_info" type="text" id="txt_info" style="display:none" size="5"/><div id="info_um" style="display:none"><a href="#" onClick="<?PHP echo $saja->run("Info_UM(txt_info:value)"); ?>;return false;"/>Ver Descripci&oacute;n</a></div></label></td>
          </tr>
        </table>
        <table border="0" cellspacing="5">
        <tr>
            <td align="center"><label><div id="um_des_ene" >Ene</div></label></td>
            <td align="center"><label><div id="um_des_feb" >Feb</div></label></td>
            <td align="center"><label><div id="um_des_mar" >Mar</div></label></td>
            <td align="center"><label><div id="um_des_abr" >Abr</div></label></td>
            <td align="center"><label><div id="um_des_may" >May</div></label></td>
            <td align="center"><label><div id="um_des_jun" >Jun</div></label></td>
            <td align="center"><label><div id="um_des_jul" >Jul</div></label></td>
            <td align="center"><label><div id="um_des_ago" >Ago</div></label></td>
            <td align="center"><label><div id="um_des_sep" >Sep</div></label></td>
            <td align="center"><label><div id="um_des_oct" >Oct</div></label></td>
            <td align="center"><label><div id="um_des_nov" >Nov</div></label></td>
            <td align="center"><label><div id="um_des_dic" >Dic</div></label></td>
            <td align="center"><label><div id="um_des_total" >Total</div></label></td>
          </tr>
          <tr>
            <td><label><input name="um_txt_ene" type="text" id="um_txt_ene" style="text-align:right"  value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_feb" type="text" id="um_txt_feb" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_mar" type="text" id="um_txt_mar" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_abr" type="text" id="um_txt_abr" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_may" type="text" id="um_txt_may" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_jun" type="text" id="um_txt_jun" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_jul" type="text" id="um_txt_jul" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_ago" type="text" id="um_txt_ago" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_sep" type="text" id="um_txt_sep" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_oct" type="text" id="um_txt_oct" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_nov" type="text" id="um_txt_nov" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_dic" type="text" id="um_txt_dic" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um(this);"/></label></td>
            <td><label><input name="um_txt_total" type="text" id="um_txt_total" style="text-align:right" value="" size="10" readonly="readonly"/></label></td>
            <td width="23"><label><div id="b_guardar_um"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_grabar_um','','../../images/b_grabar_on.gif',1)" onClick="<?php echo $saja->run("GuardarUM(txtpry_id:value, txtae_id:value, txteje_id:value, txt_id_um:value, txt_des_um:value, um_txt_ene:value, um_txt_feb:value, um_txt_mar:value, um_txt_abr:value, um_txt_may:value, um_txt_jun:value, um_txt_jul:value, um_txt_ago:value, um_txt_sep:value, um_txt_oct:value, um_txt_nov:value, um_txt_dic:value)->um:innerHTML");?>;return false;"  ><img src="../../images/b_grabar_off.gif" name="i_grabar_um" width="58" height="22" border="0" id="i_grabar_um" /></a></div></label></td>
          <td width="23"><label><div id="b_cancelar_um"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_cancelar_um','','../../images/b_cancelar_on.gif',1)" onClick="<?php echo $saja->run("CancelarUm()");?>;return false;"  ><img src="../../images/b_cancelar_off.gif" name="i_cancelar_um" width="58" height="22" border="0" id="i_cancelar_um" /></a></div></label></td>
	</tr>
        </table>
	</fieldset>
    <table border="0">
  	  <tr>
  	    <td><label><div id='um'></div></label></td>
        <td valign="top"><label><div id="b_nuevo_um" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_nuevo_um','','../../images/b_nuevo_on.gif',1)" onClick="<?php echo $saja->run("NuevoUm(txtae_id:value, txteje_id:value)");?>;return false;"  ><img src="../../images/b_nuevo_off.gif" name="i_nuevo_um" width="58" height="22" border="0" id="i_nuevo_um" /></a></div></label></td>
      </tr>
    </table>    
</fieldset>

<fieldset id="p4" style="display:none">
	<legend>Acciones Intermedias:</legend>
    <table border="0">
    	<tr>
         	<td width="139">Acci&oacute;n Intermedia:</td>
            <td>&nbsp;</td>
          <td><label><div id="des_new_ai" style="display:none">Nombre Acci&oacute;n Intermedia:</div></label></td>
          <td><label><div id="ai_id_tem" style="display:none"><input name="txtai_id_tem" type="text" id="txtai_id_tem" value="" size="5" maxlength="250"/></div></label></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
         	<td width="139"><div id="ai"></div></td>
             <td width="59"><label><div id="b_new_ai" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_new_ai','','../../images/b_nuevo_on.gif',1)" onClick="<?php echo $saja->run("NuevoAi()");?>;return false;"  ><img src="../../images/b_nuevo_off.gif" name="i_new_ai" width="58" height="22" border="0" id="i_new_ai" /></a></div></label></td>
        <td width="59"><label><div id="b_ver_ai"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_ver_ai','','../../images/b_mostrar_on.gif',1)" onClick="<?php echo $saja->run("GridAi(txtpry_id:value, txtae_id:value, txteje_id:value)->ai_unidad:innerHTML");?>;return false;"  ><img src="../../images/b_mostrar_off.gif" name="i_ver_ai" width="58" height="22" border="0" id="i_ver_ai" /></a></div>
<div id="b_no_ver_ai" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_no_ver_ai','','../../images/b_ocultar_on.gif',1)" onClick="<?php echo $saja->run("CancelarAi()");?>;return false;"  ><img src="../../images/b_ocultar_off.gif" name="i_no_ver_ai" width="58" height="22" border="0" id="i_no_ver_ai" /></a></div><div id="new_ai" style="display:none"><input name="txt_new_ai" type="text" id="txt_new_ai" value="" size="50" maxlength="250" onChange="javascript:this.value=this.value.toUpperCase();"/></div></label></td>
        <td width="19"><label><div id="b_grabar_ai" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_grabar_ai','','../../images/b_grabar_on.gif',1)" onClick="<?php echo $saja->run("GrabarAi(txtpry_id:value, txtae_id:value, txteje_id:value,'0', txt_new_ai:value)");?>;return false;"  ><img src="../../images/b_grabar_off.gif" name="i_grabar_ai" width="58" height="22" border="0" id="i_grabar_ai" /></a></div><div id="b_modificar_ai" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_modificar_ai','','../../images/b_modificar_on.gif',1)" onClick="<?php echo $saja->run("GrabarAi(txtpry_id:value, txtae_id:value, txteje_id:value, txtai_id_tem:value, txt_new_ai:value)");?>;return false;"  ><img src="../../images/b_modificar_off.gif" name="i_modificar_ai" width="58" height="22" border="0" id="i_modificar_ai" /></a></div></label></td>
        <td width="70"><label><div id="b_cancelar_ai" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_cancelar_ai','','../../images/b_cancelar_on.gif',1)" onClick="<?php echo $saja->run("CancelarAi()");?>;return false;"  ><img src="../../images/b_cancelar_off.gif" name="i_cancelar_ai" width="58" height="22" border="0" id="i_cancelar_ai" /></a></div></label></td>
		</tr>
    </table>
<fieldset id="p5" style="display:none">
    <legend>Resumen de acciones intermedias de la unidad:</legend>
    	<div id='ai_unidad'></div>
</fieldset>

<fieldset id="p6" style="display:none">
    <legend>Unidades de Medida de la Acci&oacute;n Intermedia:</legend>
    <fieldset id="p7"  style="display:none">
        <legend>Detalle de Unidad de Medida de la Acci&oacute;n Intermedia:</legend>
        <table border="0">
          <tr>
            <td><label><div id="des_id_ai" >Id:</div></label></td>
            <td><label><input name="txt_id_um_ai" type="text" id="txt_id_um_ai" style="text-align:center" value="" size="10" readonly="readonly" maxlength=""/></label></td>
            <td><label><input name="txt_des_um_ai" type="text" id="txt_des_um_ai" style="text-align:left" value="" size="124" maxlength="250" onChange="javascript:this.value=this.value.toUpperCase();"/></label></td>
          </tr>
        </table>
        <table border="0" cellspacing="5">
        <tr>
            <td align="center"><label><div id="um_ai_des_ene" >Ene</div></label></td>
            <td align="center"><label><div id="um_ai_des_feb" >Feb</div></label></td>
            <td align="center"><label><div id="um_ai_des_mar" >Mar</div></label></td>
            <td align="center"><label><div id="um_ai_des_abr" >Abr</div></label></td>
            <td align="center"><label><div id="um_ai_des_may" >May</div></label></td>
            <td align="center"><label><div id="um_ai_des_jun" >Jun</div></label></td>
            <td align="center"><label><div id="um_ai_des_jul" >Jul</div></label></td>
            <td align="center"><label><div id="um_ai_des_ago" >Ago</div></label></td>
            <td align="center"><label><div id="um_ai_des_sep" >Sep</div></label></td>
            <td align="center"><label><div id="um_ai_des_oct" >Oct</div></label></td>
            <td align="center"><label><div id="um_ai_des_nov" >Nov</div></label></td>
            <td align="center"><label><div id="um_ai_des_dic" >Dic</div></label></td>
            <td align="center"><label><div id="um_ai_des_total" >Total</div></label></td>
          </tr>
          <tr>
            <td><label><input name="um_ai_txt_ene" type="text" id="um_ai_txt_ene" style="text-align:right"  value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_feb" type="text" id="um_ai_txt_feb" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_mar" type="text" id="um_ai_txt_mar" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_abr" type="text" id="um_ai_txt_abr" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_may" type="text" id="um_ai_txt_may" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_jun" type="text" id="um_ai_txt_jun" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_jul" type="text" id="um_ai_txt_jul" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_ago" type="text" id="um_ai_txt_ago" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_sep" type="text" id="um_ai_txt_sep" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_oct" type="text" id="um_ai_txt_oct" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_nov" type="text" id="um_ai_txt_nov" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_dic" type="text" id="um_ai_txt_dic" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_um_ai(this);"/></label></td>
            <td><label><input name="um_ai_txt_total" type="text" id="um_ai_txt_total" style="text-align:right" value="" size="10" readonly="readonly"/></label></td>
            <td width="23"><label><div id="b_guardar_um_ai"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_grabar_um_ai','','../../images/b_grabar_on.gif',1)" onClick="<?php echo $saja->run("GuardarUM_Ai(txtpry_id:value, txtae_id:value, txteje_id:value, txtai_id:value, txt_id_um_ai:value, txt_des_um_ai:value, um_ai_txt_ene:value, um_ai_txt_feb:value, um_ai_txt_mar:value, um_ai_txt_abr:value, um_ai_txt_may:value, um_ai_txt_jun:value, um_ai_txt_jul:value, um_ai_txt_ago:value, um_ai_txt_sep:value, um_ai_txt_oct:value, um_ai_txt_nov:value, um_ai_txt_dic:value)->um_ai:innerHTML");?>;return false;"  ><img src="../../images/b_grabar_off.gif" name="i_grabar_um_ai" width="58" height="22" border="0" id="i_grabar_um_ai" /></a></div></label></td>
          <td width="23"><label><div id="b_cancelar_um_ai"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_cancelar_um_ai','','../../images/b_cancelar_on.gif',1)" onClick="<?php echo $saja->run("CancelarUm_Ai()");?>;return false;"  ><img src="../../images/b_cancelar_off.gif" name="i_cancelar_um_ai" width="58" height="22" border="0" id="i_cancelar_um_ai" /></a></div></label></td>
	  </tr>
    </table>
	</fieldset>
    <table border="0">
  	  <tr>
  	    <td><label><div id='um_ai'></div></label></td>
        <td valign="top"><label><div id="b_nuevo_um_ai" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_nuevo_um_ai','','../../images/b_nuevo_on.gif',1)" onClick="<?php echo $saja->run("NuevoUm_Ai(txtae_id:value, txteje_id:value, txtai_id:value)");?>;return false;"  ><img src="../../images/b_nuevo_off.gif" name="i_nuevo_um_ai" width="58" height="22" border="0" id="i_nuevo_um_ai" /></a></div></label></td>
      </tr>
    </table>    
</fieldset>
</fieldset>
<?php $gui->marco_cerrar(); ?>
</body>
</html>
