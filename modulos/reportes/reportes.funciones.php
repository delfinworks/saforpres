<?php 
/*
======================================
FUNCTIONS Plan
======================================
*/
include_once("../../includes/configuracion.php");
include_once("../../includes/capa_datos.php");

class reportes_funciones extends saja 
{	
	function ListEje()
	{	
		include_once(PATH.'/gui/ObjetoListBox.class.php');
		$lb = new ListBoxObj();
		$lb->setquery(	"SELECT 
					  		seniat_users_eje.seniat_users_eje, 
							safor_eje.descripcion, 
							seniat_users_eje.seniat_users_cerrado_plan,
							seniat_users_eje.seniat_users_cerrado_ppto
						FROM seniat_users_eje INNER JOIN safor_eje ON
							 seniat_users_eje.seniat_users_eje = safor_eje.id_eje
						WHERE seniat_users_eje.seniat_users_id='".$_SESSION['seniat_users_id_safor']."'
						ORDER BY seniat_users_eje.seniat_users_eje");
		$lb->setnombre_listbox('txteje_id');
		$lb->setvalor_inicial(array('0',''));
		$lb->setajax_event('onchange');
		$lb->setajax_div('ejes');
		$lb->setajax_file_root(PATH."/modulos/reportes/reportes.funciones.php");
		$lb->setajax_class_name("reportes_funciones");
		$lb->setajax_parametro_function(0);
		$lb->setajax_function_on_event('Eje_Filtra');
		$lb->GENERA_LISTBOX($_SESSION['seniat_users_eje_safor'],'',TRUE);			
	}
	
	function Ver_Plan($eje)
	{	
		$SQL = "SELECT tipo FROM safor_eje WHERE id_eje=".$eje."";
		$db=DB_CONECCION();
    	$rs = $db->Execute($SQL ); // resultado sql
   		if (!$rs->EOF){
			if ($rs->fields['tipo']=="NOR"){
				$this->js("window.top.location ='r_eje_ae_ai_nor.php?eje=".$eje."'");	
			}else if ($rs->fields['tipo']=="ADU"){
				$this->js("window.top.location ='r_eje_ae_ai_adu.php?eje=".$eje."'");	
			}else if ($rs->fields['tipo']=="REG"){
				$this->js("window.top.location ='r_eje_ae_ai_trib.php?eje=".$eje."'");	
			}
		}
	}
}
?>