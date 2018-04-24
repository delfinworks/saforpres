<?php 
include_once(PATH.'/includes/configuracion.php');
include_once(PATH.'/includes/capa_datos.php');
class ListBoxObj
{
	var $nombre_listbox;// nombre del listbox
	var $link_estilo_listbox;// ubicacion del estilo ccs
	var $ccs_class_listbox;// clase del ccs a utilizar en el div que contine al listbox
	var $query;
	var $valor_inicial= array();//array ejemplo array('0','-TODOS-');
	var $javascript; 
	//---------------------------------------------------------------------------------------------------------//
	var $ajax_event;
	var $ajax_file_root;// coloca la ruta del archivo a ser usado por ajax (por defecto Myfunctions)
	var $ajax_class_name;// coloca el nombre de la clase a ser usada por ajax (por defecto Myfunctions)
	var $ajax_parametro_function ;
	var $ajax_function_on_event;// funcion que se utilizará al generar el evento
    var $ajax_div;
	var $S;

	function getnombre_listbox()
	{
		return $this->nombre_listbox;
	}
	function setnombre_listbox($nombre_listbox)
	{
		$this->nombre_listbox=$nombre_listbox;
	}
    
	function getlink_estilo_listbox()
	{
		return $this->link_estilo_listbox;
	}
	function setlink_estilo_listbox($link_estilo_listbox)
	{
		$this->link_estilo_listbox=$link_estilo_listbox;
	}

	function getccs_class_listbox()
	{
		return $this->ccs_class_listbox;
	}
	function setccs_class_list($ccs_class_listbox)
	{
		$this->ccs_class_list=$ccs_class_listbox;
	}

	function getjavascript()
	{
		return $this->javascript;
	}
	function setjavascript($javascript)
	{
		$this->javascript=$javascript;
	}

	function getvalor_inicial()
	{
		return $this->valor_inicial;
	}
	function setvalor_inicial($valor_inicial)
	{
		$this->valor_inicial=$valor_inicial;
	}
	
	function getquery()
	{
		return $this->query;
	}
	function setquery($query)
	{
		$this->query=$query;
	}

	function getajax_file_root()
	{
		return $this->ajax_file_root;
	}
	function setajax_file_root($ajax_file_root)
	{
		$this->ajax_file_root=$ajax_file_root;
	}

	function getajax_class_name()
	{
		return $this->ajax_class_name;
	}
	function setajax_class_name($ajax_class_name)
	{
		$this->ajax_class_name=$ajax_class_name;
	}

	function getajax_event()
	{
		return $this->ajax_event;
	}
	function setajax_event($ajax_event)
	{
		$this->ajax_event=$ajax_event;
	}

	function getajax_parametro_function()
	{
		return $this->ajax_parametro_function;
	}
	function setajax_parametro_function($ajax_parametro_function)
	{
		$this->ajax_parametro_function=$ajax_parametro_function;
	}
	
	function getajax_function_on_event()
	{
		return $this->ajax_function_on_eventr;
	}
	function setajax_function_on_event($ajax_function_on_event)
	{
		$this->ajax_function_on_event=$ajax_function_on_event;
	}

	function getajax_div()
	{
		return $this->ajax_div;
	}
	function setajax_div($ajax_div)
	{
		$this->ajax_div=$ajax_div;
	}
	
	function GENERA_LISTBOX($SELECCIONAR,$DISABLED,$USE_SAJA=FALSE)
	{
		if ($USE_SAJA){
			$saja = new saja();
			$saja->set_path(PATH.'/clases/saja/');
			$saja->set_process_class($this->ajax_class_name);
			$saja->set_process_file($this->ajax_file_root);
			echo $saja->saja_js();
		}
		$DB=DB_CONECCION();
		$RS= $DB->Execute($this->query);
		//--VERIFICA QUE EXISTAN REGISTROS Y NO HAYA ERROR--//
		if (!$RS) {
			printf(ADODB_BAD_RS,'No hay registros');
			return false;
		}
		//------------------------------------------------//

		//--NUMERO DE COLUMNAS QUE CONTIENE $RS-----------------// 
		$NCOLS = $RS->FieldCount();
		//------------------------------------------------------//

		//--DEFINICION DE LISTBOX--------------------------// 
		if ($USE_SAJA && $this->ajax_event != ''){
			($this->ajax_parametro_function=='')?$parametros=$this->nombre_listbox.':value':$parametros=$this->ajax_parametro_function;
			$EVENTO="".$this->ajax_event."=\"". $saja->run("$this->ajax_function_on_event($parametros)->".$this->ajax_div."")."return false;\"";
		}
		$S = "<SELECT NAME=$this->nombre_listbox ID=$this->nombre_listbox $DISABLED $EVENTO>";
		//-------------------------------------------------------//

		//--PARA COLOCAR MOSTRAR UN REGISTRO POR DEFECTO EN EL LISTBOX--//
		if (is_array($this->valor_inicial)){
			if (count($this->valor_inicial[0])<2)
			{
				if (!$SELECCIONAR){ //obliga a que no muestre si se selecciona uno prestablecido (modificado por carlos delfin para que no aparezca el blanco en la lista
					$S .="\t<OPTION VALUE='".htmlentities($this->valor_inicial[0])."'" ;
					if ( $this->valor_inicial[0] == $SELECCIONAR )$S .=" SELECTED='SELECTED'";
					$S .=">".htmlentities($this->valor_inicial[1]);
					$S .="</OPTION>\n";
				}
			}
			else 
			{
				for ($i=0; $i < count($this->valor_inicial);$i++){
					$S .="\t<OPTION VALUE='".htmlentities($this->valor_inicial[$i]['id'])."'" ;
					if ( $this->valor_inicial[$i]['id'] == $SELECCIONAR )$S .=" SELECTED='SELECTED'";
					$S .=">".htmlentities($this->valor_inicial[$i]['valor']);
					$S .="</OPTION>\n"	;					
				}
			}
		}
		//-------------------------------------------------------------//
		
		//--BUCLE PARA MOSTRAR LOS REGISTROS-------------------------//
		while (!$RS->EOF) {
			$S .="\t<OPTION VALUE='".htmlentities($RS->fields[0])."'" ;
			if ( $RS->fields[0] == $SELECCIONAR )$S .=" SELECTED='SELECTED'";
			$S .="> " . ucfirst(htmlentities($RS->fields[1]))  ;
			$S .="</OPTION>\n";
			$RS->MoveNext();
		}
		$S .="</SELECT>";
		print $S;	 
	}
} 
//$gr = new ListBoxObj();
//$gr->setquery("select id,nombre from terapias");
//$gr->setnombre_listbox('compania');
//$gr->setvalor_inicial(array(0,'--TODOS--'));
//$gr->setajax_event('onchange');
//$gr->setajax_file_root($_SERVER['DOCUMENT_ROOT'].'/buddha_spa/modulos/terapias/FuncionesTerapias.php');
//$gr->setajax_class_name('TerapiasFunctions');
//$gr->setajax_parametro_function(0);
//$gr->setajax_function_on_event('llena_terapias');
//$gr->setajax_div('terapias');
//$gr->GENERA_LISTBOX('','',TRUE);
?>