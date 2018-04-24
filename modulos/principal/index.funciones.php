<?php
/*
======================================
FUNCTIONS Index
======================================
*/
include_once("../../includes/configuracion.php");
include_once(PATH."/includes/capa_datos.php");

class index_funciones extends saja
{	
	function Grid_Eje() 
    {
		include_once(PATH.'/gui/ObjetoGrid.class.php');
        $gr = new GridOj();				
		$sql="	SELECT 
					safor_eje.id_eje, safor_eje.descripcion, 
					CONCAT('Bs. ',FORMAT(Sum(safor_pry_ae_eje_part.total),0)) AS carga
				FROM (safor_eje LEFT JOIN safor_pry_ae_eje_part ON safor_eje.id_eje = safor_pry_ae_eje_part.id_eje) INNER JOIN seniat_users_eje ON safor_eje.id_eje = seniat_users_eje.seniat_users_eje
				WHERE (((seniat_users_eje.seniat_users_id)='".$_SESSION['seniat_users_id_safor']."'))
				GROUP BY safor_eje.id_eje, safor_eje.descripcion
				ORDER BY safor_eje.id_eje";		
        $gr->setquery($sql);
        $gr->settipo_scroll('scroll_grande');
        $gr->setalias_columnas(array('Id', 'Descripcion', 'Cargado Bs.'));
        $gr->setnombre("ejes");
        $gr->setajax_file_root(PATH."/modulos/formulacion/index.funciones.php");
		$gr->setajax_class_name("index_funciones");
        $gr->setajax_div("eje");
        $gr->setccs_class_grid("status");
        $gr->setpaginador(5);
        return $gr->GENERA_GRID(true,true,true);
    }
}
?>