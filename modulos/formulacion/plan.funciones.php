<?php 
/*
======================================
FUNCTIONS Plan
======================================
*/
include_once("../../includes/configuracion.php");
include_once("../../includes/capa_datos.php");

class plan_funciones extends saja 
{	
	public $eje;
	
	function LimpiaEje()
	{	
		$this->hide("des_st");
		$this->hide("st");
		$this->hide("p1");
		$this->LimpiaPry();
	}
	
	function Eje_Filtra()
	{	
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
		$lb->setajax_file_root(PATH."/modulos/formulacion/plan.funciones.php");
		$lb->setajax_class_name("plan_funciones");
		$lb->setajax_parametro_function(0);
		$lb->setajax_function_on_event('Eje_Filtra');
		$lb->GENERA_LISTBOX($_SESSION['seniat_users_eje_safor'],'',TRUE);		
		
		$this->Eje_Filtra(); //para mostrar al prestablecido 
	}
	
	function MuestraStatus($eje)
	{	
		 $_SESSION['seniat_users_eje_temp_safor'] = $eje; //Asigna el ejecutor temporal
		 
		$SQL = "SELECT seniat_users_cerrado_plan FROM seniat_users_eje WHERE seniat_users_eje='".$eje."' AND seniat_users_id='".$_SESSION['seniat_users_id_safor']."'"; 
       $db=DB_CONECCION();
       $rs = $db->Execute($SQL ); // resultado sql
       if (!$rs->EOF)
       {
		 $_SESSION['seniat_users_cerrado_plan_safor'] = $rs->fields['seniat_users_cerrado_plan'];
		  
		 if ($_SESSION['seniat_users_cerrado_plan_safor']) 
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
		$this->hide("b_new_ae");
		$this->hide("b_ver_ae");
		$this->hide("b_no_ver_ae");
		$this->hide("des_new_ae");
		$this->hide("new_ae");
		$this->hide("b_grabar_ae");
		$this->hide("b_modificar_ae");
		$this->hide("b_cancelar_ae");
		$this->hide("p1.1");
		$this->hide("p2");
		$this->hide("p3");
		$this->hide("p4");
	}
	
	function Pry_Filtra()
	{	
		$this->hide("b_new_ae");
		$this->hide("b_ver_ae");
		$this->hide("b_no_ver_ae");
		$this->hide("des_new_ae");
		$this->hide("new_ae");
		$this->hide("b_grabar_ae");
		$this->hide("b_modificar_ae");
		$this->hide("b_cancelar_ae");
		$this->hide("p1.1");
		$this->hide("p2");
		$this->hide("p3");
		$this->hide("p4");
		
		$this->js('pry_acc()');
		$this->show("des_ae");
		$this->show("ae");
	}

    function ListProyecto($eje)
	{				
		include_once(PATH.'/gui/ObjetoListBox.class.php');
		$lb = new ListBoxObj();
		$lb->setquery(	"SELECT 
					  		safor_pry.id_pry, 
							safor_pry.descripcion
						FROM safor_pry 
						WHERE ((safor_pry.id_eje=".$eje.") AND 
							   (safor_pry.poa=TRUE))
						ORDER BY safor_pry.id_pry");
		$lb->setnombre_listbox('txtpry_id');
		$lb->setvalor_inicial(array('0',''));
		$lb->setajax_event('onchange');
		$lb->setajax_div('prys');
		$lb->setajax_file_root(PATH."/modulos/formulacion/plan.funciones.php");
		$lb->setajax_class_name("plan_funciones");
		$lb->setajax_parametro_function(0);
		$lb->setajax_function_on_event('Pry_Filtra');
		$lb->GENERA_LISTBOX(0,'',TRUE);				
	}
	
	function LimpiaAe()
	{	
		//$this->show("b_ver_ae");
		$this->hide("b_no_ver_ae");
		$this->hide("p1.1");
		$this->hide("p2");
		$this->hide("p3");
		$this->hide("p4");
		$this->hide("p5");
		$this->hide("p6");
		$this->hide("p7");
	}
	
	function Ae_Filtra()
	{
		$this->js('lisae_acc()');
		
		//$this->show("b_ver_ae");
		$this->hide("b_no_ver_ae");
		$this->hide("p1.1");
		$this->show("p2");
		$this->show("p4");
		$this->hide("p5");		
		if (!$_SESSION['seniat_users_cerrado_plan_safor']){
			$this->show("b_new_ai");
			$this->show("b_nuevo_um_ai");
			$this->show("b_guardar_um_ai");
		}else{
			$this->hide("b_new_ai");
			$this->hide("b_nuevo_um_ai");
			$this->hide("b_guardar_um_ai");
		}
		$this->show("b_ver_ai");
		$this->hide("b_no_ver_ai");
		$this->hide("des_new_ai");
		$this->hide("new_ai");
		$this->hide("b_grabar_ai");
		$this->hide("b_modificar_ai");
		$this->hide("b_cancelar_ai");		
		$this->hide("p6");
		$this->hide("p7");
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
							   (safor_ae.poa=TRUE))
						ORDER BY safor_ae.id_ae");
		$lb->setnombre_listbox('txtae_id');
		$lb->setvalor_inicial(array('0',''));
		$lb->setajax_event('onchange');
		$lb->setajax_div('aes');
		$lb->setajax_file_root(PATH."/modulos/formulacion/plan.funciones.php");
		$lb->setajax_class_name("plan_funciones");
		$lb->setajax_parametro_function(0);
		$lb->setajax_function_on_event('Ae_Filtra');
		$lb->GENERA_LISTBOX(0,'',TRUE);	
		
		$SQL = "SELECT crea_ae FROM safor_pry WHERE id_pry=".$pry." AND id_eje=".$eje.""; 
    	$db=DB_CONECCION();
    	$rs = $db->Execute($SQL ); // resultado sql
    	if ($rs->fields['crea_ae'])
		{
			if (!$_SESSION['seniat_users_cerrado_plan_safor']) 
			{
				$this->show("b_new_ae");
				$this->show("b_nuevo_um");
				$this->show("b_guardar_um");
			}else{
				$this->hide("b_new_ae");
				$this->hide("b_nuevo_um");
				$this->hide("b_guardar_um");		
			}
			$this->show("b_ver_ae");
		}else{
			if (!$_SESSION['seniat_users_cerrado_plan_safor']) 
			{
				$this->show("b_guardar_um");
			}else{
				$this->hide("b_guardar_um");		
			}
			
			$this->hide("b_new_ae");
			$this->hide("b_ver_ae");
			$this->hide("b_nuevo_um");
		}
	}
	
	function NuevoAe() 
    {
		$this->hide("b_new_ae");
		$this->hide("b_ver_ae");
		$this->hide("b_no_ver_ae");
		$this->show("des_new_ae");
		$this->show("new_ae");
		$this->show("b_grabar_ae");
		$this->show("b_cancelar_ae");
	}
	
	function GridAe($pry, $eje) 
    {
		$this->show("p1.1");
		$this->hide("b_ver_ae");
		$this->show("b_no_ver_ae");
        include_once(PATH.'/gui/ObjetoGrid.class.php');
        $gr = new GridOj();
        $sql="SELECT 
					safor_ae.id_ae, 
					LEFT(safor_ae.descripcion,75)
				FROM safor_ae
				WHERE ((safor_ae.id_pry=".$pry.") AND 
				   	  (safor_ae.id_eje=".$eje.") AND
					  (safor_ae.eje=TRUE) AND
					  (safor_ae.poa=TRUE))	
				ORDER BY safor_ae.id_ae";
        $gr->setquery($sql);
        $gr->settipo_scroll("scroll_grande");
        $gr->setalias_columnas(array('Id', 'Descripcion'));
        $gr->setnombre("GridAe");
        $gr->setajax_file_root(PATH."/modulos/formulacion/plan.funciones.php");
		$gr->setajax_class_name("plan_funciones");
		if (!$_SESSION['seniat_users_cerrado_plan_safor']){
			$gr->setajax_parametro_eliminar(0);
			$gr->setajax_funcion_eliminar("BorrarAe");
        	$gr->setajax_parametro_editar(0);
        	$gr->setajax_funcion_editar("BuscarAe");	
		}	
        $gr->setajax_div("ae_unidad");
        $gr->setccs_class_grid("grid");
        $gr->setpaginador(10);
        return $gr->GENERA_GRID(true,true,true);
    }
	
	function GrabarAe($pry, $ae, $des_ae, $eje) 
    {	
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setpry($pry);
		$Obj->setae($ae);
		$Obj->setdes_ae($des_ae);
		$Obj->seteje($eje);
		$mensaje=$Obj->Clase_GuardarAe();
		$this->js("alert('". $mensaje[1] ."')");
		if ($mensaje[2]){
			$this->CancelarAe();
			$this->LimpiaAe();
        	return $this->js('pry_acc()');
		}
	}
	
	function CancelarAe() 
    {		
		if (!$_SESSION['seniat_users_cerrado_plan_safor']) $this->show("b_new_ae");
		$this->show("b_ver_ae");
		$this->hide("b_no_ver_ae");
		$this->hide("des_new_ae");
		$this->hide("new_ae");
		$this->text("","txt_new_ae:value");
		$this->hide("b_grabar_ae");
		$this->hide("b_modificar_ae");
		$this->hide("b_cancelar_ae");
		$this->hide("p1.1");
	}
	
	function BorrarAe($ae) 
    {	
		$this->eje .=$_SESSION['seniat_users_eje_temp_safor'];
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setae($ae);
		$Obj->seteje($this->eje);
		$mensaje=$Obj->Clase_BorrarAe();
        $this->js("alert('". $mensaje[1] ."')");
		if ($mensaje[2]){
			$this->LimpiaAe();
			$this->js('pry_acc()');
		}else{
			$this->show("b_ver_ae");
			$this->hide("b_no_ver_ae");
			$this->hide("p1.1");
		}
	}
	
	function BuscarAe($ae) 
    {	
		$this->eje .=$_SESSION['seniat_users_eje_temp_safor'];
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setae($ae);
		$Obj->seteje($this->eje);
		$Obj->Clase_BuscaAe();
		$this->text("$Obj->ae","txtae_id_tem:value");
        $this->text("$Obj->des_ae","txt_new_ae:value");
		$this->hide("b_new_ae");
		$this->hide("b_ver_ae");
		$this->hide("b_no_ver_ae");
		$this->hide("b_grabar_ae");
		$this->show("des_new_ae");
		$this->show("new_ae");
		$this->show("b_modificar_ae");
		$this->show("b_cancelar_ae");
	}
	
	//**********************************************************
	//FUNCIONES PARA EL TRABAJO CON LO DE LAS UNIDADES DE MEDIDA
	//**********************************************************
	function GridUM($pry, $ae, $eje) 
    {
		$this->hide('p3'); //para ocultar cada vez que de doy a la unidad de medida
		
        include_once(PATH.'/gui/ObjetoGrid.class.php');
        $gr = new GridOj();
        $sql="SELECT 
					safor_pry_ae_eje_um.id_um, 
					Left(safor_pry_ae_eje_um.descripcion,50),
					FORMAT((ene+feb+mar),0) AS trim1, 
					FORMAT((abr+may+jun),0) AS trim2, 
					FORMAT((jul+ago+sep),0) AS trim3, 
					FORMAT((oct+nov+dic),0) AS trim4,
					FORMAT(safor_pry_ae_eje_um.total,0) 
				FROM safor_pry_ae_eje_um
				WHERE ((safor_pry_ae_eje_um.id_ae=".$ae.") AND 
				   	  (safor_pry_ae_eje_um.id_eje=".$eje."))
				ORDER BY safor_pry_ae_eje_um.id_um";
        $gr->setquery($sql);
        $gr->settipo_scroll('scroll_grande');
        $gr->setalias_columnas(array('Id', 'Descripcion', 'Trim 1', 'Trim 2' , 'Trim 3', 'Trim 4', 'Total'));
        $gr->setnombre("GridUM");
        $gr->setajax_file_root(PATH."/modulos/formulacion/plan.funciones.php");
		$gr->setajax_class_name("plan_funciones");
		
		$SQL = "SELECT crea_ae FROM safor_pry WHERE id_pry=".$pry." AND id_eje=".$eje.""; 
    	$db=DB_CONECCION();
    	$rs = $db->Execute($SQL ); // resultado sql
		if ($rs->fields['crea_ae'])
		{
			if (!$_SESSION['seniat_users_cerrado_plan_safor']) 
			{
				$gr->setajax_parametro_eliminar(0);
				$gr->setajax_funcion_eliminar("BorrarUm");
			}
		}		
		$gr->setajax_parametro_editar(0);
		$gr->setajax_funcion_editar("Llenar_UM");	
        $gr->setajax_div("um");
        $gr->setccs_class_grid("grid");
        $gr->setpaginador(10);
        return $gr->GENERA_GRID(true,true,true);
    }
	
	function NuevoUm($ae, $eje) 
    {
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setae($ae);
		$Obj->seteje($eje);
		$Obj->Clase_BuscaMax();
		$this->show("p3");
        $this->text("$Obj->um_id","txt_id_um:value");
        $this->text("","txt_des_um:value");
		$this->text("0","um_txt_ene:value");
        $this->text("0","um_txt_feb:value");
		$this->text("0","um_txt_mar:value");
        $this->text("0","um_txt_abr:value");
		$this->text("0","um_txt_may:value");
        $this->text("0","um_txt_jun:value");
		$this->text("0","um_txt_jul:value");
        $this->text("0","um_txt_ago:value");
		$this->text("0","um_txt_sep:value");
        $this->text("0","um_txt_oct:value");
		$this->text("0","um_txt_nov:value");
        $this->text("0","um_txt_dic:value");
	    $this->text("0","um_txt_total:value");
	}
	
	function Info_UM($des) 
    {
		$this->js("alert('".$des."')");
	}
	
	function Llenar_UM($um) 
    {
		$this->eje .=$_SESSION['seniat_users_eje_temp_safor'];
		include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->Clase_BuscaUm($um, $this->eje);
        $this->text("$Obj->um_id","txt_id_um:value");
        $this->text("$Obj->um_nombre","txt_des_um:value");
		$this->text("$Obj->um_nota","txt_info:value");
		$this->text("$Obj->um_ene","um_txt_ene:value");
        $this->text("$Obj->um_feb","um_txt_feb:value");
		$this->text("$Obj->um_mar","um_txt_mar:value");
        $this->text("$Obj->um_abr","um_txt_abr:value");
		$this->text("$Obj->um_may","um_txt_may:value");
        $this->text("$Obj->um_jun","um_txt_jun:value");
		$this->text("$Obj->um_jul","um_txt_jul:value");
        $this->text("$Obj->um_ago","um_txt_ago:value");
		$this->text("$Obj->um_sep","um_txt_sep:value");
        $this->text("$Obj->um_oct","um_txt_oct:value");
		$this->text("$Obj->um_nov","um_txt_nov:value");
        $this->text("$Obj->um_dic","um_txt_dic:value");
	    $this->text("$Obj->um_total","um_txt_total:value");
		
		if ($Obj->um_nota!="") $this->show("info_um"); else $this->hide("info_um");
		
		$this->show("p3");
    }
	
	function BorrarUm($um) 
    {	
		$this->eje .=$_SESSION['seniat_users_eje_temp_safor'];
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setum_id($um);
		$Obj->seteje($this->eje);
		$mensaje=$Obj->Clase_BorrarUm();
        $this->js("alert('". $mensaje[1] ."')");
        if ($mensaje[2]) return $this->js('lisum_acc()');
	}
	
	function GuardarUM($pry, $ae, $eje, $um, $um_nombre, $um_ene, $um_feb, $um_mar, $um_abr, $um_may, $um_jun, $um_jul, $um_ago, $um_sep, $um_oct, $um_nov, $um_dic) 
    {	
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setpry($pry);
		$Obj->setae($ae);
		$Obj->seteje($eje);
		$Obj->setum_id($um);
		$Obj->setum_nombre($um_nombre);
        $Obj->setmeses($um_ene, $um_feb, $um_mar, $um_abr, $um_may, $um_jun, $um_jul, $um_ago, $um_sep, $um_oct, $um_nov, $um_dic);
		$mensaje=$Obj->Clase_GuardarUm();
        $this->js("alert('". $mensaje[1] ."')");
		if ($mensaje[2]){ 
			$this->CancelarUm();
        	return $this->GridUM($pry, $ae, $eje);
		}
    }
	
	function CancelarUm() 
    {		
		$this->hide('p3');
	}
	
	
	
	//*********************************************************
	//FUNCIONES PARA EL TRABAJO CON LO DE LAS ACCIONES INTERNAS
	//*********************************************************
	function LimpiaAi()
	{	
		$this->hide("p6");
		$this->hide("p7");
	}
	
	function Ai_Filtra()
	{
		$this->js('lisai_um_acc()');
		if (!$_SESSION['seniat_users_cerrado_plan_safor']){
			$this->show("b_new_ai");
			$this->show("b_nuevo_um_ai");
			$this->show("b_guardar_um_ai");
		}else{
			$this->hide("b_new_ai");
			$this->hide("b_nuevo_um_ai");
			$this->hide("b_guardar_um_ai");
		}
		$this->show("b_ver_ai");
		$this->hide("b_no_ver_ai");
		$this->hide("des_new_ai");
		$this->hide("new_ai");
		$this->text("","txt_new_ai:value");
		$this->hide("b_grabar_ai");
		$this->hide("b_modificar_ai");
		$this->hide("b_cancelar_ai");
		$this->hide("p5");
		$this->show("p6");
		$this->hide("p7");
	}
	
	function ListAi($pry, $ae, $eje)
	{
		include_once(PATH.'/gui/ObjetoListBox.class.php');
		$lb = new ListBoxObj();
		$lb->setquery(	"SELECT
							safor_ai.id_ai, 
							LEFT(safor_ai.descripcion,50)
						FROM safor_ai
						WHERE ((safor_ai.id_pry=".$pry.") AND
							   (safor_ai.id_ae=".$ae.") AND
							   (safor_ai.id_eje=".$eje."))
						ORDER BY safor_ai.id_ai");
		$lb->setnombre_listbox('txtai_id');
		$lb->setvalor_inicial(array('0',''));
		$lb->setajax_event('onchange');
		$lb->setajax_div('ais');
		$lb->setajax_file_root(PATH."/modulos/formulacion/plan.funciones.php");
		$lb->setajax_class_name("plan_funciones");
		$lb->setajax_parametro_function(0);
		$lb->setajax_function_on_event('Ai_Filtra');
		$lb->GENERA_LISTBOX(0,'',TRUE);			
	}
	
	function NuevoAi() 
    {
		$this->hide("b_new_ai");
		$this->hide("b_ver_ai");
		$this->hide("b_no_ver_ai");
		$this->show("des_new_ai");
		$this->show("new_ai");
		$this->text("","txt_new_ai:value");
		$this->show("b_grabar_ai");
		$this->show("b_cancelar_ai");
	}
	
	
	function GridAi($pry, $ae, $eje) 
    {
		$this->show("p5");
		$this->hide("b_ver_ai");
		$this->show("b_no_ver_ai");
        include_once(PATH.'/gui/ObjetoGrid.class.php');
        $gr = new GridOj();
        $sql="SELECT 
					safor_ai.id_ai, 
					LEFT(safor_ai.descripcion,75)
				FROM safor_ai
				WHERE ((safor_ai.id_pry=".$pry.") AND 
					  (safor_ai.id_ae=".$ae.") AND 
				   	  (safor_ai.id_eje=".$eje."))	
				ORDER BY safor_ai.id_ai";
        $gr->setquery($sql);
        $gr->settipo_scroll("scroll_grande");
        $gr->setalias_columnas(array('Id', 'Descripcion'));
        $gr->setnombre("GridAi");
        $gr->setajax_file_root(PATH."/modulos/formulacion/plan.funciones.php");
		$gr->setajax_class_name("plan_funciones");
		if (!$_SESSION['seniat_users_cerrado_plan_safor']){
			$gr->setajax_parametro_eliminar(0);
			$gr->setajax_funcion_eliminar("BorrarAi");
        	$gr->setajax_parametro_editar(0);
        	$gr->setajax_funcion_editar("BuscarAi");	
		}	
        $gr->setajax_div("ai_unidad");
        $gr->setccs_class_grid("grid");
        $gr->setpaginador(10);
        return $gr->GENERA_GRID(true,true,true);
    }
	
	function GrabarAi($pry, $ae, $eje, $ai, $des_ai) 
    {	
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setpry($pry);
		$Obj->setae($ae);
		$Obj->setai($ai);
		$Obj->setdes_ai($des_ai);
		$Obj->seteje($eje);
		$mensaje=$Obj->Clase_GuardarAi();
        $this->js("alert('". $mensaje[1] ."')");
		if ($mensaje[2]){
			$this->CancelarAi();
			$this->LimpiaAi();
        	$this->js('lisai2_acc()');
		}
	}
	
	function CancelarAi() 
    {	
		$this->hide("p5");
		if (!$_SESSION['seniat_users_cerrado_plan_safor']) $this->show("b_new_ai");
		$this->show("b_ver_ai");
		$this->hide("b_no_ver_ai");
		$this->hide("des_new_ai");
		$this->hide("new_ai");
		$this->hide("b_grabar_ai");
		$this->hide("b_modificar_ai");
		$this->hide("b_cancelar_ai");
	}
	
	function BorrarAi($ai) 
    {	
		$this->eje .=$_SESSION['seniat_users_eje_temp_safor'];
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setai($ai);
		$Obj->seteje($this->eje);
		$mensaje=$Obj->Clase_BorrarAi();
        $this->js("alert('". $mensaje[1] ."')");
		if ($mensaje[2]){
			$this->CancelarAi();
			$this->LimpiaAi();
			$this->js('lisai2_acc()');
		}else{
			$this->hide("p5");
			if (!$_SESSION['seniat_users_cerrado_plan_safor']) $this->show("b_new_ai");
			$this->show("b_ver_ai");
			$this->hide("b_no_ver_ai");
			$this->hide("des_new_ai");
			$this->hide("new_ai");
			$this->hide("b_grabar_ai");
			$this->hide("b_modificar_ai");
			$this->hide("b_cancelar_ai");
		}
	}
	
	function BuscarAi($ai) 
    {	
		$this->eje .=$_SESSION['seniat_users_eje_temp_safor'];
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setai($ai);
		$Obj->seteje($this->eje);
		$Obj->Clase_BuscaAi();
		$this->text("$Obj->ai","txtai_id_tem:value");
        $this->text("$Obj->des_ai","txt_new_ai:value");
		$this->hide("b_new_ai");
		$this->hide("b_ver_ai");
		$this->hide("b_no_ver_ai");
		$this->hide("b_grabar_ai");
		$this->show("des_new_ai");
		$this->show("new_ai");
		$this->show("b_modificar_ai");
		$this->show("b_cancelar_ai");
	}
	
	//*******************************************************************
	//FUNCIONES PARA EL TRABAJO CON LO DE LAS UNIDADES DE MEDIDA DE LA AI
	//*******************************************************************
	function GridUM_Ai($ai, $eje) 
    {
		$this->hide('p5'); //para ocultar cada vez que de doy a la unidad de medida
		
        include_once(PATH.'/gui/ObjetoGrid.class.php');
        $gr = new GridOj();
        $sql="SELECT 
					safor_pry_ae_ai_eje_um.id_um, 
					Left(safor_pry_ae_ai_eje_um.descripcion,50),
					FORMAT((ene+feb+mar),0) AS trim1, 
					FORMAT((abr+may+jun),0) AS trim2, 
					FORMAT((jul+ago+sep),0) AS trim3, 
					FORMAT((oct+nov+dic),0) AS trim4,
					FORMAT(safor_pry_ae_ai_eje_um.total,0) 
				FROM safor_pry_ae_ai_eje_um
				WHERE ((safor_pry_ae_ai_eje_um.id_ai=".$ai.") AND 
				   	  (safor_pry_ae_ai_eje_um.id_eje=".$eje."))
				ORDER BY safor_pry_ae_ai_eje_um.id_um";
        $gr->setquery($sql);
        $gr->settipo_scroll('scroll_grande');
        $gr->setalias_columnas(array('Id', 'Descripcion', 'Trim 1', 'Trim 2' , 'Trim 3', 'Trim 4', 'Total'));
        $gr->setnombre("GridUM_Ai");
        $gr->setajax_file_root(PATH."/modulos/formulacion/plan.funciones.php");
		$gr->setajax_class_name("plan_funciones");
		if (!$_SESSION['seniat_users_cerrado_plan_safor']) 
		{
			$gr->setajax_parametro_eliminar(0);
			$gr->setajax_funcion_eliminar("BorrarUm_Ai");
		}				
		$gr->setajax_parametro_editar(0);
		$gr->setajax_funcion_editar("Llenar_UM_Ai");
        $gr->setajax_div("um_ai");
        $gr->setccs_class_grid("grid");
        $gr->setpaginador(10);
        return $gr->GENERA_GRID(true,true,true);
    }
	
	function NuevoUm_Ai($ae, $eje, $ai) 
    {
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setae($ae);
		$Obj->setai($ai);
		$Obj->seteje($eje);
		$Obj->Clase_BuscaMax_Ai();
		$this->show("p7");
        $this->text("$Obj->um_id","txt_id_um_ai:value");
        $this->text("","txt_des_um_ai:value");
		$this->text("0","um_ai_txt_ene:value");
        $this->text("0","um_ai_txt_feb:value");
		$this->text("0","um_ai_txt_mar:value");
        $this->text("0","um_ai_txt_abr:value");
		$this->text("0","um_ai_txt_may:value");
        $this->text("0","um_ai_txt_jun:value");
		$this->text("0","um_ai_txt_jul:value");
        $this->text("0","um_ai_txt_ago:value");
		$this->text("0","um_ai_txt_sep:value");
        $this->text("0","um_ai_txt_oct:value");
		$this->text("0","um_ai_txt_nov:value");
        $this->text("0","um_ai_txt_dic:value");
	    $this->text("0","um_ai_txt_total:value");
	}
	
	function Llenar_UM_Ai($um) 
    {
		$this->eje .=$_SESSION['seniat_users_eje_temp_safor'];
		include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->Clase_BuscaUm_Ai($um, $this->eje);
        $this->text("$Obj->um_id","txt_id_um_ai:value");
        $this->text("$Obj->um_nombre","txt_des_um_ai:value");
		$this->text("$Obj->um_ene","um_ai_txt_ene:value");
        $this->text("$Obj->um_feb","um_ai_txt_feb:value");
		$this->text("$Obj->um_mar","um_ai_txt_mar:value");
        $this->text("$Obj->um_abr","um_ai_txt_abr:value");
		$this->text("$Obj->um_may","um_ai_txt_may:value");
        $this->text("$Obj->um_jun","um_ai_txt_jun:value");
		$this->text("$Obj->um_jul","um_ai_txt_jul:value");
        $this->text("$Obj->um_ago","um_ai_txt_ago:value");
		$this->text("$Obj->um_sep","um_ai_txt_sep:value");
        $this->text("$Obj->um_oct","um_ai_txt_oct:value");
		$this->text("$Obj->um_nov","um_ai_txt_nov:value");
        $this->text("$Obj->um_dic","um_ai_txt_dic:value");
	    $this->text("$Obj->um_total","um_ai_txt_total:value");
		
		$this->show("p7");
    }

function BorrarUm_Ai($um) 
    {	
		$this->eje .=$_SESSION['seniat_users_eje_temp_safor'];
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setum_id($um);
		$Obj->seteje($this->eje);
		$mensaje=$Obj->Clase_BorrarUm_Ai();
        $this->js("alert('". $mensaje[1] ."')");
		if ($mensaje[2]) return $this->js('lisai_um_acc()');
	}
	
	function GuardarUM_Ai($pry, $ae, $eje, $ai, $um, $um_nombre, $um_ene, $um_feb, $um_mar, $um_abr, $um_may, $um_jun, $um_jul, $um_ago, $um_sep, $um_oct, $um_nov, $um_dic) 
    {	
        include('plan.objeto.class.php');
        $Obj= new clase_plan(); 
		$Obj->setpry($pry);
		$Obj->setae($ae);
		$Obj->setai($ai);
		$Obj->seteje($eje);
		$Obj->setum_id($um);
		$Obj->setum_nombre($um_nombre);
        $Obj->setmeses($um_ene, $um_feb, $um_mar, $um_abr, $um_may, $um_jun, $um_jul, $um_ago, $um_sep, $um_oct, $um_nov, $um_dic);
		$mensaje=$Obj->Clase_GuardarUm_Ai();
        $this->js("alert('". $mensaje[1] ."')");
		if ($mensaje[2]) $this->CancelarUm_Ai();
        return $this->GridUM_Ai($ai, $eje);
    }
	
	function CancelarUm_Ai() 
    {		
		$this->hide("p7");
	}
}
?>