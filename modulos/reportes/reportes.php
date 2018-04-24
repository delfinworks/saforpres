<?php
require_once("../../includes/funciones/funciones_iniciales.php");
$saja->set_process_file(PATH."/modulos/reportes/reportes.funciones.php");
$saja->set_process_class("reportes_funciones");

echo $saja->saja_js();
//$gui->pathway_recorrido("Reportes",true);  
?>
<body>
<?php $gui->marco_abrir("Reportes");?>
<script language="JavaScript">
	<?php
		echo $saja->run("ListEje()->eje");
	?>


function Verifica_Plan(){
	if (document.getElementById("txteje_id").value==0){
		alert("Indique la unidad ejecutora que desea consultar");
		document.getElementById("txteje_id").focus()
	}else{
		<?PHP echo $saja->run("Ver_Plan(txteje_id:value)"); ?>
	}
}			
	
function Verifica_Ppto(){
	if (document.getElementById("txteje_id").value==0){
		alert("Indique la unidad ejecutora que desea consultar");
		document.getElementById("txteje_id").focus()
	}else{
		window.open("r_eje_ae_partida.php?eje="+document.getElementById("txteje_id").value); 
		
	}
}
</script>
<fieldset id="p1">
<legend>Reportes Consolidados:</legend>
  <table border="0" width="100%">
  	  <tr>
      	<td><label><div id="des_eje" >Unidad Ejecutora:</div></label></td>
      </tr>
      <tr>
        <td><label><div id="eje"></div></label></td>
      </tr> 
  	  <tr>
      <td><label><a href="#" onClick="Verifica_Plan();"/>Reporte por Ejecutor / Acci&oacute;n Espec&iacute;fica / Unidad de Medida / Acci&oacute;n Interna</a></label></td>
      </tr>
      <tr>
      <td><label><a href="#" onClick="Verifica_Ppto();"/>Reporte por Ejecutor / Acci&oacute;n Espec&iacute;fica / Partida</a></label></td>
      </tr>
   </table>
</fieldset>
<?php $gui->marco_cerrar(); ?>
</body>
</html>