<?php
require_once("../../includes/funciones/funciones_iniciales.php");
$saja->set_process_file(PATH."/modulos/formulacion/presupuesto.funciones.php");
$saja->set_process_class("presupuesto_funciones");

echo $saja->saja_js();
$gui->pathway_recorrido("Presupuesto",true);  
?>
<body>
<?php $gui->marco_abrir("Formulación del Presupuesto");?>
<script language="JavaScript">
	<?php echo $saja->run("MuestraEje()->eje");?>

function eje_acc(){
	if (document.getElementById("txteje_id").value!=0){
		<?php 
			echo $saja->run("Total(txteje_id:value)->txt_te");
			echo $saja->run("MuestraStatus(txteje_id:value)->st");
			echo $saja->run("ListProyecto(txteje_id:value)->pry");
		?>
	}else{
		<?php echo $saja->run("LimpiaEje()");?>
	}
}

function pry_acc(){
	if (document.getElementById("txtpry_id").value!=0){
		<?php 
			echo $saja->run("ListAE(txtpry_id:value, txteje_id:value)->ae");
			echo $saja->run("GridResumen_Pry(txtpry_id:value, txteje_id:value)->resumen_pry");
			echo $saja->run("GridTotal_Pry(txtpry_id:value, txteje_id:value)->total_pry");
		?>
	}else{
		<?php echo $saja->run("LimpiaPry()");?>
	}
}

function lisae_acc(){
	if (document.getElementById("txtae_id").value!=0){
		<?php 
			echo $saja->run("ListPartida(txteje_id:value)->part");
			echo $saja->run("GridPart(txtae_id:value, txteje_id:value)->partidas:innerHTML");
			echo $saja->run("GridResumen_Ae(txtae_id:value, txteje_id:value)->resumen_ae");
			echo $saja->run("GridTotal_Ae(txtae_id:value, txteje_id:value)->total_ae");
		?>
	}else{
		<?php echo $saja->run("LimpiaAe()");?>
	}
}

function lispart_acc(){
	<?php echo $saja->run("ListPartida(txteje_id:value)->part");?>
}

function lispart2_acc(){
	<?php 
		echo $saja->run("ListPartida(txteje_id:value)->part");
		echo $saja->run("GridPart(txtae_id:value, txteje_id:value)->partidas:innerHTML");
		
		echo $saja->run("Total(txteje_id:value)->txt_te");
		echo $saja->run("GridResumen_Pry(txtpry_id:value, txteje_id:value)->resumen_pry");
		echo $saja->run("GridTotal_Pry(txtpry_id:value, txteje_id:value)->total_pry");
		echo $saja->run("GridResumen_Ae(txtae_id:value, txteje_id:value)->resumen_ae");
		echo $saja->run("GridTotal_Ae(txtae_id:value, txteje_id:value)->total_ae");
	?>
}

function borrarpart_acc(part){
	<?php 
		echo $saja->run("BorrarPart(txtae_id:value,part, txteje_id:value)");
	?>
}

function llenarpart_acc(part){
	<?php 
		echo $saja->run("LlenarPart(txtae_id:value,part, txteje_id:value)");
	?>
}
</script>

<script language="JavaScript">
function script_part(input){ 
var valor = parseInt(input.value);
if (isNaN(valor) ||  valor<0) { 
	document.getElementById(input.name).focus();
	alert('Campo vacío, no numérico o menor que cero'); 
	return input.value=0;
}else{
	document.getElementById(input.name).value = valor;
	var j_total = (parseInt(document.getElementById("part_txt_ene").value) + parseInt(document.getElementById("part_txt_feb").value) + parseInt(document.getElementById("part_txt_mar").value) + parseInt(document.getElementById("part_txt_abr").value) + parseInt(document.getElementById("part_txt_may").value) + parseInt(document.getElementById("part_txt_jun").value) + parseInt(document.getElementById("part_txt_jul").value) + parseInt(document.getElementById("part_txt_ago").value) + parseInt(document.getElementById("part_txt_sep").value) + parseInt(document.getElementById("part_txt_oct").value) + parseInt(document.getElementById("part_txt_nov").value) + parseInt(document.getElementById("part_txt_dic").value));

	document.getElementById("part_txt_total").value = j_total;
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
  	    <td><label><div id="des_te" class="BoldTextGray" style="display:none">Total: Bs. </div></label></td>
        <td><label><div id="txt_te"></div></label></td>     
        <td width="10">&nbsp;</td>
  	    <td><label><div id="des_st" class="BoldTextGray" style="display:none">Status:</div></label></td>
        <td><label><div id="st" style="display:none"></div></label></td>
	   </tr>
	  </table>
</fieldset>

<fieldset id="p1" style="display:none">
<legend>Parametros de Presupuesto</legend>
  	<table border="0">
  	  <tr>
  	    <td width="192"><label><div id="des_pry" >Acci&oacute;n Centralizada / Proyecto:</div></label></td>
        <td width="23">&nbsp;</td>
  	    <td width="158"><label><div id="des_ae" style="display:none">Acci&oacute;n Especifica:</div></label></td>
      </tr>
       <tr>
  	    <td><label><div id="pry"></div></label></td>
        <td width="23">&nbsp;</td>
  	    <td><label><div id="ae"></div></label></td>
       </tr> 
	  </table>
</fieldset>

<fieldset id="p4" style="display:none">
    <legend>Partidas Presupuestarias:</legend>
    <fieldset id="p5" style="display:none">
        <legend>Detalle de Partida Presupuestaria:</legend>
        <table border="0">
          <tr>
            <td><label><div id="des_id" >Partida:</div></label></td>
            <td><label><div id="part"></div></label></td>
          </tr>
        </table>
        <table border="0" cellspacing="5">
          <tr>
            <td align="center"><label><div id="part_des_ene" >Ene</div></label></td>
            <td align="center"><label><div id="part_des_feb" >Feb</div></label></td>
            <td align="center"><label><div id="part_des_mar" >Mar</div></label></td>
            <td align="center"><label><div id="part_des_abr" >Abr</div></label></td>
            <td align="center"><label><div id="part_des_may" >May</div></label></td>
            <td align="center"><label><div id="part_des_jun" >Jun</div></label></td>
            <td align="center"><label><div id="part_des_jul" >Jul</div></label></td>
            <td align="center"><label><div id="part_des_ago" >Ago</div></label></td>
            <td align="center"><label><div id="part_des_sep" >Sep</div></label></td>
            <td align="center"><label><div id="part_des_oct" >Oct</div></label></td>
            <td align="center"><label><div id="part_des_nov" >Nov</div></label></td>
            <td align="center"><label><div id="part_des_dic" >Dic</div></label></td>
            <td align="center"><label><div id="part_des_total" >Total</div></label></td>
          </tr>
          <tr>
            <td><label><input name="part_txt_ene" type="text" id="part_txt_ene" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_feb" type="text" id="part_txt_feb" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_mar" type="text" id="part_txt_mar" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_abr" type="text" id="part_txt_abr" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_may" type="text" id="part_txt_may" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_jun" type="text" id="part_txt_jun" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_jul" type="text" id="part_txt_jul" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_ago" type="text" id="part_txt_ago" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_sep" type="text" id="part_txt_sep" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_oct" type="text" id="part_txt_oct" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_nov" type="text" id="part_txt_nov" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_dic" type="text" id="part_txt_dic" style="text-align:right" value="" size="5" maxlength="11" onBlur="script_part(this);"/></label></td>
            <td><label><input name="part_txt_total" type="text" id="part_txt_total" style="text-align:right" value="" size="10" readonly="readonly"/></label></td>
            <td width="23"><label><div id="b_guardar_part"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_grabar_part','','../../images/b_grabar_on.gif',1)" onClick="<?php echo $saja->run("GuardarPart(txtpry_id:value, txtae_id:value, txtpart_id:value, txteje_id:value, part_txt_ene:value, part_txt_feb:value, part_txt_mar:value, part_txt_abr:value, part_txt_may:value, part_txt_jun:value, part_txt_jul:value, part_txt_ago:value, part_txt_sep:value, part_txt_oct:value, part_txt_nov:value, part_txt_dic:value)->partidas:innerHTML");?>;return false;"  ><img src="../../images/b_grabar_off.gif" name="i_grabar_part" width="58" height="22" border="0" id="i_grabar_part" /></a></div></label></td>
          <td width="23"><label><div id="b_cancelar_part"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_cancelar_part','','../../images/b_cancelar_on.gif',1)" onClick="<?php echo $saja->run("CancelarPart()");?>;return false;"  ><img src="../../images/b_cancelar_off.gif" name="i_cancelar_part" width="58" height="22" border="0" id="i_cancelar_part" /></a></div></label></td>
	 </tr>
    </table>
	</fieldset>
    <table border="0">
  	  <tr>
  	    <td><label><div id='partidas'></div></label></td>
        <td valign="top"><label><div id="b_nuevo_part" style="display:none"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('i_nuevo_part','','../../images/b_nuevo_on.gif',1)" onClick="<?php echo $saja->run("NuevoPart()");?>;return false;"  ><img src="../../images/b_nuevo_off.gif" name="i_nuevo_part" width="58" height="22" border="0" id="i_nuevo_part" /></a></div></label></td>
     </tr>
    </table>    
</fieldset>

<table width="100%" border="0">
 <tr>
    <td valign="top">
    <fieldset id="p6" style="display:none">
         <legend>Resumen por Proyecto:</legend>
            <table border="0">
              <tr>
   				<td><label><div id='resumen_pry'></div></label></td>
              </tr>
              <tr>
                <td><label><div id='total_pry'></div></label></td>
              </tr>
            </table>
    </fieldset>
    </td>
   	<td valign="top">
    <fieldset id="p7" style="display:none">
         <legend>Resumen por Acci&oacute;n Espec&iacute;fica:</legend>
         	<table border="0">
              <tr>
   				<td><label><div id='resumen_ae'></div></label></td>
              </tr>
              <tr>
                <td><label><div id='total_ae'></div></label></td>
              </tr>
            </table>
    </fieldset>
    </td>
 </tr>
</table>    
<?php $gui->marco_cerrar(); ?>
</body>
</html>
