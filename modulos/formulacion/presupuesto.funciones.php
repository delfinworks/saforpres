<?php 
/*
======================================
FUNCTIONS Presupuesto
======================================
*/
include_once("../../includes/configuracion.php");
include_once("../../includes/capa_datos.php");

class presupuesto_funciones extends saja 
{	
	public $eje;
	
	function LimpiaEje()
	{	
		$this->hide("des_te");
		$this->hide("txt_te");
		$this->hide("des_st");
		$this->hide("st");
		$this->hide("p1");
		$this->LimpiaPry();
	}
	
	function Eje_Filtra()
	{	
		$this->show("des_te");
		$this->show("txt_te");
		$this->show("des_st");
		$this->show("st");
		$this->LimpiaPry();
		
		$this->js('eje_acc()');
		$this->show("p1");	
	}
	
	function MuestraEje()
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
		$lb->setajax_file_root(PATH."/modulos/formulacion/presupuesto.funciones.php");
		$lb->setajax_class_name("presupuesto_funciones");
		$lb->setajax_parametro_function(0);
		$lb->setajax_function_on_event('Eje_Filtra');
		$lb->GENERA_LISTBOX($_SESSION['seniat_users_eje_safor'],'',TRUE);			
		
		$this->Eje_Filtra(); //para mostrar al prestablecido 
	}
	
	function MuestraStatus($eje)
	{	
		$SQL = "SELECT seniat_users_cerrado_ppto FROM seniat_users_eje WHERE seniat_users_eje='".$eje."' AND seniat_users_id='".$_SESSION['seniat_users_id_safor']."'"; 
       $db=DB_CONECCION();
       $rs = $db->Execute($SQL ); // resultado sql
       if (!$rs->EOF)
       {
		 $_SESSION['seniat_users_cerrado_ppto_safor'] = $rs->fields['seniat_users_cerrado_ppto'];
		  
		 if ($_SESSION['seniat_users_cerrado_ppto_safor']) 
		 {
         	return "Proceso Cerrado (Consulta)";
		 }else{
			 return "Proceso Abierto";
		 }
       }
	}
	
	function LimpiaPry()
	{	
        $this->hide("des_ae");	
		$this->hide("ae");
		$this->hide('p4');
		$this->hide('p6');
		$this->hide('p7');
	}
	
	function Pry_Filtra()
	{	
	    $this->js('pry_acc()');
	    $this->show("des_ae");
		$this->show("ae");
		$this->hide('p4');
		$this->show('p6');
		$this->hide('p7');
	}

    function ListProyecto($eje)
	{
		include_once(PATH.'/gui/ObjetoListBox.class.php');
		$lb = new ListBoxObj();
		$lb->setquery(	"SELECT 
					  		safor_pry.id_pry, 
							LEFT(safor_pry.descripcion,50)
						FROM safor_pry 
						WHERE ((safor_pry.id_eje=".$eje.") AND 
							   (safor_pry.ppto=TRUE))
						ORDER BY safor_pry.id_pry");
		$lb->setnombre_listbox('txtpry_id');
		$lb->setvalor_inicial(array('0',''));
		$lb->setajax_event('onchange');
		$lb->setajax_div('um');
		$lb->setajax_file_root(PATH."/modulos/formulacion/presupuesto.funciones.php");
		$lb->setajax_class_name("presupuesto_funciones");
		$lb->setajax_parametro_function(0);
		$lb->setajax_function_on_event('Pry_Filtra');
		$lb->GENERA_LISTBOX(0,'',TRUE);			
	}
	
	function LimpiaAe()
	{	
		$this->hide('p4');
		$this->hide('p7');
	}
	
	function Ae_Filtra()
	{
		$this->js('lisae_acc()');
		$this->show("p4");
		$this->hide('p5');
		$this->show('p7');
	}
	
	function ListAE($pry, $eje)
	{
		include_once(PATH.'/gui/ObjetoListBox.class.php');
		$lb = new ListBoxObj();
		$lb->setquery(	"SELECT
							safor_ae.id_ae, 
							LEFT(safor_ae.descripcion,50)
						FROM safor_ae
						WHERE ((safor_ae.id_pry=".$pry.") AND 
							   (safor_ae.id_eje=".$eje.") AND 
							   (safor_ae.ppto=TRUE))
						ORDER BY safor_ae.id_ae");
		$lb->setnombre_listbox('txtae_id');
		$lb->setvalor_inicial(array('0',''));
		$lb->setajax_event('onchange');
		$lb->setajax_div('um');
		$lb->setajax_file_root(PATH."/modulos/formulacion/presupuesto.funciones.php");
		$lb->setajax_class_name("presupuesto_funciones");
		$lb->setajax_parametro_function(0);
		$lb->setajax_function_on_event('Ae_Filtra');
		$lb->GENERA_LISTBOX(0,'',TRUE);	
	}	
	
	function GridPart($ae, $eje) 
    {
        include_once(PATH.'/gui/ObjetoGrid.class.php');
        $gr = new GridOj();
        $sql="SELECT 
					safor_pry_ae_eje_part.id_partida,
					Left(safor_puc.descripcion,50) AS des,
					CONCAT('Bs. ',FORMAT(Sum(ene+feb+mar),0)) AS trim1, 
					CONCAT('Bs. ',FORMAT(Sum(abr+may+jun),0)) AS trim2, 
					CONCAT('Bs. ',FORMAT(Sum(jul+ago+sep),0)) AS trim3, 
					CONCAT('Bs. ',FORMAT(Sum(oct+nov+dic),0)) AS trim4,
					CONCAT('Bs. ',FORMAT(Sum(total),0))
				FROM safor_pry_ae_eje_part INNER JOIN safor_puc ON safor_pry_ae_eje_part.id_partida = safor_puc.id_partida
				WHERE ((safor_pry_ae_eje_part.id_ae=".$ae.") AND 
				   	  (safor_pry_ae_eje_part.id_eje=".$eje.") AND 
				   	  (safor_puc.id_eje=".$eje."))
				GROUP BY safor_pry_ae_eje_part.id_partida, safor_puc.descripcion
				ORDER BY safor_pry_ae_eje_part.id_partida";
        $gr->setquery($sql);
        $gr->settipo_scroll('scroll_grande');
        $gr->setalias_columnas(array('Id', 'Descripcion', 'Trim 1', 'Trim 2' , 'Trim 3', 'Trim 4', 'Total'));
        $gr->setnombre("GridPart");
        $gr->setajax_file_root(PATH."/modulos/formulacion/presupuesto.funciones.php");
		$gr->setajax_class_name("presupuesto_funciones");
		if (!$_SESSION['seniat_users_cerrado_ppto_safor']){
		    $this->show('b_nuevo_part');
			$gr->setajax_parametro_eliminar(0);
			$gr->setajax_funcion_eliminar("PasarBorrarPart");
        	$gr->setajax_parametro_editar(0);
        	$gr->setajax_funcion_editar("PasarLlenarPart");	
		}else{
			$this->hide('b_nuevo_part');
		}	
        $gr->setajax_div("partidas");
        $gr->setccs_class_grid("grid");
        $gr->setpaginador(10);
        return $gr->GENERA_GRID(true,true,true);
    }
	
	function NuevoPart() 
    {
        $this->js('lispart_acc()');
		$this->text("0","part_txt_ene:value");
        $this->text("0","part_txt_feb:value");
		$this->text("0","part_txt_mar:value");
        $this->text("0","part_txt_abr:value");
		$this->text("0","part_txt_may:value");
        $this->text("0","part_txt_jun:value");
		$this->text("0","part_txt_jul:value");
        $this->text("0","part_txt_ago:value");
		$this->text("0","part_txt_sep:value");
        $this->text("0","part_txt_oct:value");
		$this->text("0","part_txt_nov:value");
        $this->text("0","part_txt_dic:value");
	    $this->text("0","part_txt_total:value");
		
		$this->show("p5");
	}
	
	function ListPartida($eje)
	{
		include_once(PATH.'/gui/ObjetoListBox.class.php');
		$lb = new ListBoxObj();
		$lb->setquery(	"SELECT 
					  		safor_puc.id_partida,
					  		CONCAT(safor_puc.id_partida, ' - ', safor_puc.descripcion) AS des
						FROM safor_puc 
						WHERE (safor_puc.id_eje=".$eje.")
						ORDER BY safor_puc.id_partida");
		$lb->setnombre_listbox('txtpart_id');
		$lb->setvalor_inicial(array('0',''));
		$lb->setajax_event('onchange');
		$lb->setajax_div('part');
		$lb->setajax_file_root(PATH."/modulos/formulacion/presupuesto.funciones.php");
		$lb->setajax_class_name("presupuesto_funciones");
		$lb->setajax_parametro_function(0);
		$lb->GENERA_LISTBOX(0,'',TRUE);			
	}
	
	function PasarLlenarPart($part) 
    {	
        $this->js("llenarpart_acc('".$part."')");
	}
	
	function LlenarPart($ae, $part, $eje) 
    {
		include('presupuesto.objeto.class.php');
        $Obj= new clase_presupuesto(); 
		$Obj->setae($ae);
		$Obj->seteje($eje);
		$Obj->setpart($part);
		$Obj->Clase_BuscaPart();
        $this->text("$Obj->part","txtpart_id:value");
		$this->text("$Obj->part_ene","part_txt_ene:value");
        $this->text("$Obj->part_feb","part_txt_feb:value");
		$this->text("$Obj->part_mar","part_txt_mar:value");
        $this->text("$Obj->part_abr","part_txt_abr:value");
		$this->text("$Obj->part_may","part_txt_may:value");
        $this->text("$Obj->part_jun","part_txt_jun:value");
		$this->text("$Obj->part_jul","part_txt_jul:value");
        $this->text("$Obj->part_ago","part_txt_ago:value");
		$this->text("$Obj->part_sep","part_txt_sep:value");
        $this->text("$Obj->part_oct","part_txt_oct:value");
		$this->text("$Obj->part_nov","part_txt_nov:value");
        $this->text("$Obj->part_dic","part_txt_dic:value");
	    $this->text("$Obj->part_total","part_txt_total:value");
		
		$this->show("p5");
    }
	
	function PasarBorrarPart($part) 
    {	
        $this->js("borrarpart_acc('".$part."')");
	}
	
	function BorrarPart($ae, $part, $eje) 
    {	
        include('presupuesto.objeto.class.php');
        $Obj= new clase_presupuesto(); 
		$Obj->setae($ae);
		$Obj->seteje($eje);
		$Obj->setpart($part);
		$mensaje=$Obj->Clase_BorrarPart();
        $this->js("alert('". $mensaje[1] ."')");
			$this->CancelarPart();
        return $this->js('lispart2_acc()');
	}
	
	function GuardarPart($pry, $ae, $part, $eje, $part_ene, $part_feb, $part_mar, $part_abr, $part_may, $part_jun, $part_jul, $part_ago, $part_sep, $part_oct, $part_nov, $part_dic) 
    {	
        include('presupuesto.objeto.class.php');
        $Obj= new clase_presupuesto(); 
		$Obj->setpry($pry);
		$Obj->setae($ae);
		$Obj->seteje($eje);
		$Obj->setpart($part);
        $Obj->setpart_meses($part_ene, $part_feb, $part_mar, $part_abr, $part_may, $part_jun, $part_jul, $part_ago, $part_sep, $part_oct, $part_nov, $part_dic);
		$mensaje=$Obj->Clase_GuardarPart();
        $this->js("alert('". $mensaje[1] ."')");
			$this->CancelarPart();
        return $this->js('lispart2_acc()');
    }
	
	function CancelarPart() 
    {		
		$this->hide('p5');
	}
	


/**
* FUNCIONES PARA EL TRABAJO CON LOS RESUMENES
*/
	function Total($eje) 
    {
        include('presupuesto.objeto.class.php');
		$SQL = ("SELECT FORMAT(Sum(safor_pry_ae_eje_part.total),0) AS SumaDetotal
				 FROM safor_pry_ae_eje_part
				 WHERE (safor_pry_ae_eje_part.id_eje=".$eje.")");
		$db=DB_CONECCION();
		$rs = $db->Execute($SQL) or die("Error consultando");
		if (!$rs->EOF)
		{	
			if ($rs->fields['SumaDetotal']==""){
				return 0;
			}else{
				return $rs->fields['SumaDetotal'];
			}
		}
    }
	
	function GridResumen_Pry($pry, $eje) 
    {
        include_once(PATH.'/gui/ObjetoGridCorto.class.php');
        $gr = new GridOj();
        $sql="  SELECT 	safor_puc_part.id_part,
						safor_puc_part.descripcion,
						CONCAT('Bs. ', FORMAT(Sum(safor_pry_ae_eje_part.total),0)) AS SumaDetotal
				FROM safor_pry_ae_eje_part INNER JOIN safor_puc_part ON  	LEFT(safor_pry_ae_eje_part.id_partida,3) = safor_puc_part.id_part
				WHERE ( (safor_pry_ae_eje_part.id_pry=".$pry.") AND  
						(safor_pry_ae_eje_part.id_eje=".$eje."))
				GROUP BY safor_puc_part.id_part, safor_puc_part.descripcion
				ORDER BY safor_pry_ae_eje_part.id_partida";
        $gr->setquery($sql);
        $gr->settipo_scroll('scroll_grande');
        $gr->setalias_columnas(array('Id', 'Descripcion', 'Total'));
        $gr->setnombre("GridResumen_Pry");
        $gr->setajax_file_root(PATH."/modulos/formulacion/presupuesto.funciones.php");
		$gr->setajax_class_name("presupuesto_funciones");
        $gr->setajax_div("resumen_pry");
        $gr->setccs_class_grid("grid");
        return $gr->GENERA_GRID(true,true,true);
    }
	
    function GridTotal_Pry($pry, $eje) 
    {
        include_once(PATH.'/gui/ObjetoGridCorto.class.php');
        $gr = new GridOj();
        $sql="  SELECT 	CONCAT('Bs. ', FORMAT(Sum(safor_pry_ae_eje_part.total),0)) AS SumaDetotal
				FROM safor_pry_ae_eje_part
				WHERE ( (safor_pry_ae_eje_part.id_pry=".$pry.") AND  
						(safor_pry_ae_eje_part.id_eje=".$eje."))";
        $gr->setquery($sql);
        $gr->settipo_scroll('scroll_grande');
        $gr->setalias_columnas(array('Total Proyecto'));
        $gr->setnombre("GridTotal_Pry");
        $gr->setajax_file_root(PATH."/modulos/formulacion/presupuesto.funciones.php");
		$gr->setajax_class_name("presupuesto_funciones");
        $gr->setajax_div("total_pry");
        $gr->setccs_class_grid("grid");
        return $gr->GENERA_GRID(true,true,true);
    }

	function GridResumen_Ae($ae, $eje) 
    {
        include_once(PATH.'/gui/ObjetoGridCorto.class.php');
        $gr = new GridOj();
        $sql="  SELECT 	safor_puc_part.id_part,
						safor_puc_part.descripcion,
						CONCAT('Bs. ',FORMAT(Sum(safor_pry_ae_eje_part.total),0)) AS SumaDetotal
				FROM safor_pry_ae_eje_part INNER JOIN safor_puc_part ON  	LEFT(safor_pry_ae_eje_part.id_partida,3) = safor_puc_part.id_part
				WHERE ( (safor_pry_ae_eje_part.id_ae=".$ae.") AND  
						(safor_pry_ae_eje_part.id_eje=".$eje."))
				GROUP BY safor_puc_part.id_part, safor_puc_part.descripcion
				ORDER BY safor_pry_ae_eje_part.id_partida";
        $gr->setquery($sql);
        $gr->settipo_scroll('scroll');
        $gr->setalias_columnas(array('Id', 'Descripcion', 'Total'));
        $gr->setnombre("GridResumen_Ae");
        $gr->setajax_file_root(PATH."/modulos/formulacion/presupuesto.funciones.php");
		$gr->setajax_class_name("presupuesto_funciones");
        $gr->setajax_div("resumen_ae");
        $gr->setccs_class_grid("grid");
        $gr->setpaginador(10);
        return $gr->GENERA_GRID(true,true,true);
    }
	
	function GridTotal_Ae($ae, $eje) 
    {
        include_once(PATH.'/gui/ObjetoGridCorto.class.php');
        $gr = new GridOj();
        $sql="  SELECT CONCAT('Bs. ',FORMAT(Sum(safor_pry_ae_eje_part.total),0)) AS SumaDetotal
				FROM safor_pry_ae_eje_part 
				WHERE ( (safor_pry_ae_eje_part.id_ae=".$ae.") AND  
						(safor_pry_ae_eje_part.id_eje=".$eje."))";
        $gr->setquery($sql);
        $gr->settipo_scroll('scroll_grande');
        $gr->setalias_columnas(array('Total Acción Específica'));
        $gr->setnombre("GridTotal_Ae");
        $gr->setajax_file_root(PATH."/modulos/formulacion/presupuesto.funciones.php");
		$gr->setajax_class_name("presupuesto_funciones");
        $gr->setajax_div("resumen_ae");
        $gr->setccs_class_grid("grid");
        $gr->setpaginador(10);
        return $gr->GENERA_GRID(true,true,true);
    }
}
?>