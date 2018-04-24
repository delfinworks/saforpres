<?php 
include_once('../../includes/capa_datos.php');

function convertir_tipo($CAMPO,$TIPO='',$TIPO_HTML='TD')
{
	if (strstr(strtoupper($TIPO),'CHAR') || strstr(strtoupper($TIPO),'TEXT')) return "<$TIPO_HTML align='left' > ".htmlentities(trim($CAMPO))." </$TIPO_HTML>\n";
	elseif (strstr(strtoupper($TIPO),'TIMESTAMP')) return "<$TIPO_HTML align='right' > ".$CAMPO." </$TIPO_HTML>\n";
	elseif (strstr(strtoupper($TIPO),'INT')) return "<$TIPO_HTML align='left' > ".$CAMPO." </$TIPO_HTML>\n";
	elseif (strstr(strtoupper($TIPO),'NUM')){
		if($TIPO_HTML=='TD')
		$CAMPO = number_format($CAMPO,2,',','.');
		return "<$TIPO_HTML align='right'  > ".$CAMPO." </$TIPO_HTML>\n";
	}
	elseif (strstr(strtoupper($TIPO),'BOOL')){
		if($TIPO_HTML=='TD')$CAMPO=htmlentities((($CAMPO=='t')?'Sí':'No'));
		return "<$TIPO_HTML align='center' > ".$CAMPO." </$TIPO_HTML>\n";
	}
	else return "<$TIPO_HTML> ".htmlentities(trim($CAMPO))." </$TIPO_HTML>\n";
}

class GridOj
{
	var $nombre_grid ;// nombre del grid
	
	var $link_estilo_grid;// ubicacion del estilo ccs
	var $ccs_class_grid;// clase del ccs a utilizar en el div que contine al grid
	var $alias_columnas;// titulo que contentran las columnas del grid
	var $checkbox;
	var $query;
	var $maxrows;// maximo numero de rows permitidos
	var $rows; //mumero total de registros
	var $paginador = 10;// numero de rows por pagina
	var $exportar_excel;
	
	//---Colocar javascript url como primer valor del arreglo,otro arreglo con las variables y el campo a asociar con adodb ó valor,el src de la imagen y en que lado del grid se debe colocar('I' para isquierda, 'D' para derecha) Ej: $link= array(home.php,array('id','nombre'),'I')
	var $link;
	var $link_parametro;
	var $link_funcion;
	var $link_modifica;
	var $link_elimina;
	var $link_ventana_emergente;
	//---------------------------------------------------------------------------------------------------------//
	var $ajax_function;// array para enviar multiples funciones a aejecutar con botones en el grid
					   // EJEMPLO: $array[0]["funcion"]="funcion_eliminar"
					   //		   $array[0]["parametro"]="0" //field num
					   //		   $array[0]["div"]="grid_rs" //div donde se muestra la informacion
					   //          $array[0]["img_src"]="../../imagenes/iconos/delete.gif" //imagen a mostrar
					   //		   $array[0]["tittle"]="Borrar";
					   //		   $array[0]["otro_parametro"]='','1';
					   //		   $array[0]["js_confirm"]='if (confirm(¿Desea borrar el registro?))';
	//-------------------------------------------------------------------------------------------------------------------------------------//				   
	var $ajax_function_varios_parametros;// array para enviar multiples funciones de multiples parametros a ejecutar con botones en el grid
										 //	(Solo funciones de 2 parametros)
										 // EJEMPLO: $array[0]["funcion"]="funcion_eliminar"
										 //		   $array[0]["parametro_0"]="0" //field num
										 //		   $array[0]["parametro_1"]='' //field_name ó $array[0]["parametro_nobd"]='' //field_value que no esta en el query
										 //		   $array[0]["div"]="grid_rs" //div donde se muestra la informacion
										 //        $array[0]["img_src"]="../../imagenes/iconos/delete.gif" //imagen a mostrar
										 //		   $array[0]["tittle"]="Borrar";
										 //		   $array[0]["js_confirm"]='if (confirm(¿Desea borrar el registro?))';								 	
	//-------------------------------------------------------------------------------------------------------------------------------------//									 			   
	var $ajax_file_root;// coloca la ruta del archivo a ser usado por ajax (por defecto Myfunctions)
	var $ajax_class_name;// coloca el nombre de la clase a ser usada por ajax (por defecto Myfunctions)
	var $ajax_funcion_paginador;// funcion que se utilizará para pagina
	var $ajax_funcion_eliminar;// funcion que se utilizará para borrar el registro del grid
	var $ajax_funcion_editar;// funcion que se utilizará para llenar los campos del registro a editar
	var $ajax_parametro_paginador;
	var $ajax_parametro_eliminar;// parametro para la funcion borrar
	var $ajax_parametro_editar;// parametro para la funcion editar
	var $ajax_div;
	var $saja;
	var $tipo_scroll;// Tipo de clase scroll css 

	function getnombre()
	{
		return $this->nombre;
	}
	function setnombre($nombre)
	{
		$this->nombre=$nombre;
	}

	function getpaginador()
	{
		return $this->paginador;
	}
	function setpaginador($paginador)
	{
		$this->paginador=$paginador;
	}

	function getpagina()
	{
		return $this->pagina;
	}
	function setpagina($pagina)
	{
		$_SESSION['pagina_'. $this->nombre_grid ]=$pagina;
		$this->pagina=$_SESSION['pagina_'. $this->nombre_grid ];
	}
	function getlink()
	{
		return $this->link;
	}
	function setlink($link)
	{
		$this->link=$link;
	}

	function getlink_parametro()
	{
		return $this->link_parametro;
	}
	function setlink_parametro($link_parametro)
	{
		$this->link_parametro=$link_parametro;
	}

	function getlink_funcion()
	{
		return $this->link_funcion;
	}
	function setlink_funcion($link_funcion)
	{
		$this->link_funcion=$link_funcion;
	}

	function getlink_estilo_grid()
	{
		return $this->link_estilo_grid;
	}
	function setlink_estilo_grid($link_estilo_grid)
	{
		$this->link_estilo_grid=$link_estilo_grid;
	}


	function getcheckbox()
	{
		return $this->checkbox;
	}
	function setcheckbox($checkbox)
	{
		$this->checkbox=$checkbox;
	}

	function getlink_elimina()
	{
		return $this->link_elimina;
	}
	function setlink_elimina($link_elimina)
	{
		$this->link_elimina=$link_elimina;
	}

	function getlink_modifica()
	{
		return $this->link_modifica;
	}
	function setlink_modifica($link_modifica)
	{
		$this->link_modifica=$link_modifica;
	}

	function getccs_class_grid()
	{
		return $this->ccs_class_grid;
	}
	function setccs_class_grid($ccs_class_grid)
	{
		$this->ccs_class_grid=$ccs_class_grid;
	}

	function getquery()
	{
		return $this->query;
	}
	function setquery($query)
	{
		$this->query=$query;
	}

	function getalias_columnas()
	{
		return $this->alias_columnas;
	}
	function setalias_columnas($alias_columnas)
	{
		$this->alias_columnas=$alias_columnas;
	}

	function getmaxrows()
	{
		return $this->maxrows;
	}
	function setmaxrows($maxrows)
	{
		$this->maxrows=$maxrows;
	}

	function getajax_class_name()
	{
		return $this->ajax_class_name;
	}
	function setajax_class_name($ajax_class_name)
	{
		$this->ajax_class_name=$ajax_class_name;
	}

	function getajax_function()
	{
		return $this->ajax_function;
	}
	function setajax_function($ajax_function)
	{
		$this->ajax_function=$ajax_function;
	}
	
	function getajax_function_varios_parametros()
	{
		return $this->ajax_function_varios_parametros;
	}
	function setajax_function_varios_parametros($ajax_function_varios_parametros)
	{
		$this->ajax_function_varios_parametros=$ajax_function_varios_parametros;
	}
	
	function getajax_funcion_eliminar()
	{
		return $this->ajax_funcion_eliminar;
	}
	function setajax_funcion_eliminar($ajax_funcion_eliminar)
	{
		$this->ajax_funcion_eliminar=$ajax_funcion_eliminar;
	}

	function getajax_funcion_editar()
	{
		return $this->ajax_funcion_editar;
	}
	function setajax_funcion_editar($ajax_funcion_editar)
	{
		$this->ajax_funcion_editar=$ajax_funcion_editar;
	}

	function getajax_parametro_eliminar()
	{
		return $this->ajax_parametro_eliminar;
	}
	function setajax_parametro_eliminar($ajax_parametro_eliminar)
	{
		$this->ajax_parametro_eliminar=$ajax_parametro_eliminar;
	}
	
	function setajax_funcion_paginador($ajax_funcion_paginador)
	{
		$this->ajax_funcion_paginador=$ajax_funcion_paginador;
	}
		function setajax_parametro_paginador($ajax_parametro_paginador)
	{
		$this->ajax_parametro_paginador=$ajax_parametro_paginador;
	}
	function getajax_file_root()
	{
		return $this->ajax_file_root;
	}
	function setajax_file_root($ajax_file_root)
	{
		$this->ajax_file_root=$ajax_file_root;
	}

	function getajax_parametro_editar()
	{
		return $this->ajax_parametro_editar;
	}
	function setajax_parametro_editar($ajax_parametro_editar)
	{
		$this->ajax_parametro_editar=$ajax_parametro_editar;
	}

	function getajax_div()
	{
		return $this->ajax_div;
	}
	function setajax_div($ajax_div)
	{
		$this->ajax_div=$ajax_div;
	}

	function gettipo_scroll()
	{
		return $this->tipo_scroll;
	}
	function settipo_scroll($tipo_scroll)
	{
		$this->tipo_scroll=$tipo_scroll;
	}
	function getexportar_excel()
	{
		return $this->exportar_excel;
	}
	function setexportar_excel($exportar_excel)
	{
		$this->exportar_excel=$exportar_excel;
	}
	function GENERA_GRID($MUESTRA_HDR=TRUE,$HTML_CARACTERES_ESPECIALES=TRUE,$USE_SAJA=TRUE,$PAGINA=1)
	{

			if ($USE_SAJA){
				//global $saja;
				$this->saja = new saja();
				$this->saja->set_path('../../clases/saja/');
				$this->saja->set_process_class($this->ajax_class_name);
				$this->saja->set_process_file($this->ajax_file_root);
				echo $this->saja->saja_js();
				
			}
			//--DECLARACIONES INICIALES-----------------------//
			$S ='';$ROWS=0;
			//-----------------------------------------------//
			$DB=DB_CONECCION();
			if($this->query!= @$_SESSION['query'.$this->nombre]) $this->PAGINA=1;
			if ($this->query != '' )
			{
				$_SESSION['query'.$this->nombre]= $this->query;
			}
			 else
			{	
				$this->query= $_SESSION['query'.$this->nombre];			
			}
		
				$RS=$DB->PageExecute($this->query,$this->paginador,$PAGINA,false);
	
			//--VERIFICA QUE EXISTAN REGISTROS Y NO HAYA ERROR--//
			if (!$RS) 
			{   //echo $DB->ErrorMsg();
				echo '<span style="color:red">Error al intentar generar la consulta. Revise si hay caracteres extraños en las palabras</span>';
				return false;
			}
			//------------------------------------------------//
			$this->rows = $RS->MaxRecordCount();
			//--VERIFICA QUE SI SE DEFINIÓ UN ESTILO PARA LA TABLA--//
			if ($this->link_estilo_grid){
				echo $this->link_estilo_grid;
				$ESTILO_TABLA= '';
			}else
				$ESTILO_TABLA = "BORDER='0' WIDTH='98%'";
			//------------------------------------------------------//
			$TIPO_DE_ARREGLO = array();
	
			//--NUMERO DE COLUMNAS QUE CONTIENE $RS-----------------//
			$NCOLS = $RS->FieldCount();
			//------------------------------------------------------//
	
			//--DEFINICION DE DIV Y TABLA--------------------------//
			/*	$HDR = "<div id=grid class='$this->ccs_class_grid' align='center' with='500' ><TABLE cellpadding='0' cellspacing='0' border='3' ><TR><TD> <TABLE  align='center' COLS='$NCOLS' cellpadding='0' cellspacing='0' $ESTILO_TABLA><tr>\n\n";  */
			($this->tipo_scroll=='')?$this->tipo_scroll='scroll':'';/* Tipo de class css para scroll ("scroll","scroll_pequeno")*/
			
			$HDR = "<table width='300' border='0'cellspacing='0' cellpadding='0'><tr><td ><div  class='$this->tipo_scroll'  ><TABLE id=grid cellpadding='0' cellspacing='0' border='0' ><TR><TD> <TABLE  align='center' COLS='$NCOLS' cellpadding='0' cellspacing='0' $ESTILO_TABLA><tr>\n\n";
			//-------------------------------------------------------//
	
			//--BUCLE PARA IMPRIMIR LOS NOMBRES DE CADA COLUMNA DE LA TABLA--//
			if ($USE_SAJA){
				if (is_array($this->ajax_function)){
					foreach($this->ajax_function as $key => $val){
						$HDR .= "<TH>&nbsp;</TH>";
					}
				}
				elseif (is_array($this->ajax_function_varios_parametros)){
					foreach($this->ajax_function_varios_parametros as $key => $val){
						$HDR .= "<TH>&nbsp;</TH>";
					}
				}
				else{
					if (trim($this->link_funcion)!='')$HDR .= "<TH>&nbsp;</TH>";
					if (trim($this->ajax_funcion_eliminar )!='')$HDR .= "<TH>&nbsp;</TH>";
					if (trim($this->ajax_funcion_editar)!='')$HDR .= "<TH>&nbsp;</TH>";
				}
			}else{
				if (trim($this->link)!='')$HDR .= "<TH>&nbsp;</TH>";
				if (trim($this->link_elimina)!='')$HDR .= "<TH>&nbsp;</TH>";
				if (trim($this->link_modifica )!='')$HDR .= "<TH>&nbsp;</TH>";
			}
			for ($I=0; $I < $NCOLS; $I++) {
				$FIELD= $RS->FetchField($I);
				if ($FIELD) {
					if ($this->alias_columnas) $NOMBRE_COL = $this->alias_columnas[$I];
					else $NOMBRE_COL = htmlspecialchars($FIELD->name);
					$TIPO_DE_ARREGLO[$I] = $FIELD->type;
				} else {
					$NOMBRE_COL = 'Field '.($I+1);
					$TIPO_DE_ARREGLO[$i] = 'C';
				}
				if (strlen($NOMBRE_COL)==0) $NOMBRE_COL = '&nbsp;';
				$HDR .= convertir_tipo($NOMBRE_COL,$TIPO_DE_ARREGLO[$I],'TH');
			}
			//--------------------------------------------------------------//
			$HDR .= "\n</tr>";
			if ($MUESTRA_HDR) print $HDR."\n\n";
			else $HTML = $HDR;
	
			$NUMOFFSET = isset($RS->fields[0]) ||isset($RS->fields[1]) || isset($RS->fields[2]);
	
			//--BUCLE PARA MOSTRAR LOS REGISTROS-------------------------//
			while (!$RS->EOF) {
				//$S .= "<TR valign=top onMouseOver='this.className='TR:hover';' onMouseOut='this.className='TR:visited';>\n";
				$S .= "<TR valign=center class='".$this->row_color($ROWS,'','impar')."' >\n";
	
				//---BUCLE PARA IMPRIMIR CADA CAMPO DEL REGISTRO EN LA COLUMNA DE LA TABLA--//
				if ($USE_SAJA)
				{
					if (is_array($this->ajax_function)){
	       				foreach($this->ajax_function as $key => $val) {
	       					$S .= "<TD width='0'  ><div align='center'><a href='#' title='".$this->ajax_function[$key]['tittle']."' onclick=\"". $this->ajax_function[$key]['js_confirm'].$this->saja->run("".$this->ajax_function[$key]['funcion']."('". $RS->fields[$this->ajax_function[$key]['parametro']] . $this->ajax_function[$key]['otro_parametro'] ."')->".$this->ajax_function[$key]['div'].":innerHTML").";return false;  \">  <img src='".$this->ajax_function[$key]['img_src']."' alt='".$this->ajax_function[$key]['tittle']."' border =0></a></div> </TD>";
	      				 }	
					}
					elseif(is_array($this->ajax_function_varios_parametros)){
	       				foreach($this->ajax_function_varios_parametros as $key => $val) {
	       					$param = ($this->ajax_function_varios_parametros[$key]["parametro_nobd"]!='')?$this->ajax_function_varios_parametros[$key]["parametro_nobd"]:$RS->fields[$this->ajax_function_varios_parametros[$key]['parametro_1']];
	       					$S .= "<TD width='0'  ><div align='center'><a href='#' title='".$this->ajax_function_varios_parametros[$key]['tittle']."' onclick=\"". $this->ajax_function_varios_parametros[$key]['js_confirm'].$this->saja->run("".$this->ajax_function_varios_parametros[$key]['funcion']."('". $RS->fields[$this->ajax_function_varios_parametros[$key]['parametro_0']] ."', '". $param ."')->".$this->ajax_function_varios_parametros[$key]['div'].":innerHTML").";return false;  \">  <img src='".$this->ajax_function_varios_parametros[$key]['img_src']."' alt='".$this->ajax_function_varios_parametros[$key]['tittle']."' border =0></a></div> </TD>";
	      				 }	
					}
					else 
					{	
						if (trim($this->link_funcion)!='')$S .= "<TD width='0' ><div align='center'><a href='#' title='Seleccionar' onclick=\"". $this->saja->run("$this->link_funcion('". $RS->fields[$this->link_parametro] ."')->".$this->ajax_div.":innerHTML").";return false;  \">  <img src='../../imagenes/iconos/select.gif' border =0 alt='Seleccionar'></a></div> </TD>";
						if (trim($this->ajax_funcion_eliminar)!='')$S .= "<TD width='0' ><div align='center'><a href='#' title='Eliminar'  onclick=\"if (confirm('Desea Borrar el Registro ?')){". $this->saja->run("$this->ajax_funcion_eliminar('". $RS->fields[$this->ajax_parametro_eliminar] ."')->".$this->ajax_div.":innerHTML").";}return false;  \">  <img src='../../imagenes/iconos/delete.gif' alt='Eliminar' border =0></a></div> </TD>";
						if (trim($this->ajax_funcion_editar)!='')$S .= "<TD width='0' ><div id='editar' align='center'><a href='#'  title='Modificar' onclick=\"". $this->saja->run("$this->ajax_funcion_editar('". $RS->fields[$this->ajax_parametro_editar] ."')").";return false;\">  <img src='../../imagenes/iconos/edit.gif' alt='Modificar' border =0></a></div> </TD>";
						htmlspecialchars($S);
					}
				}
				else
				{
					if (trim($this->link)!='')$S .= "<TD width='0' ><div align='center'><a href= ".$this->link. $RS->fields[0]." title='Seleccionar' >  <img src='../../imagenes/iconos/select.gif' alt='Seleccionar' border =0></a></div> </TD>";
					if (trim($this->link_elimina)!='')$S .= "<TD width='0' ><div align='center'><a onclick=\"if (confirm('Desea Borrar el Registro ?'))\">  <img src='../../imagenes/iconos/delete.gif' alt='Eliminar' border =0></a></div> </TD>";
					if (trim($this->link_modifica)!='')$S .= "<TD width='0' ><div align='center'><a onclick=\"return false;)\">  <img src='../../imagenes/iconos/edit.gif' border=0 alt='Modificar'></a></div> </TD>";
	
				}
				for ($I=0; $I < $NCOLS; $I++)
				{
					if ($I===0) $V=($NUMOFFSET) ? $RS->fields[0] : reset($RS->fields);
					else $V = ($NUMOFFSET) ? $RS->fields[$I] : next($RS->fields);
	
					if (empty($V)) $S .= "<TD > &nbsp; </TD>\n";
					else $S .=  convertir_tipo($V,$TIPO_DE_ARREGLO[$I]);
				}
				//--------------------------------------------------------------------------//
	
				$S .= "</TR>\n\n";
				$ROWS += 1;
				//carlos maxrows error
				if ($ROWS >= $this->maxrows && is_numeric($this->maxrows)) {
					$ROWS = "<p>LLEGO AL MAXIMO DE REGISTROS PERMITIDO</p>";
					break;
				}
	
				$RS->MoveNext();
	
				//--CHEQUEO EOF ADICIONAL PARA PREVENIR WINDOW HEADER---------//
				if (!$RS->EOF && $ROWS % $this->paginador == 0) {
					if ($MUESTRA_HDR) print $S . "</TABLE>\n\n";
					else $HTML .= $S ."</TABLE>\n\n";
					$S = $HDR;
				}
				//------------------------------------------------------------//
			}
	
			//--FIN WHILE----------------------------------------------------//
			if ($MUESTRA_HDR) print $S."</TABLE>\n\n";
			else $HTML .= $S."</TABLE>\n\n";
	
			echo "</TD></TR></TABLE></div></td></tr></table>";
			
			echo "<table width='600' border=0 cellpadding='2' cellspacing='2' ".$ESTILO_TABLA." >";
			echo '<tr class=paginador  ><td align="left" width="220" >&nbsp;';
			$this->muestra_paginador($this->rows ,$this->paginador, $PAGINA);
			echo "</td>";
			echo '<td align="center" >';
			echo 'Registros:'.$ROWS.' Total:' .$this->rows;
			echo "</td>";
			echo '<td align="right" width="120" >';
			echo "</td></tr>";
			echo "</table>";	
	}

	function row_color($cnt,$even,$odd)
	{
		return ($cnt%2) ? $odd  : $even ;
	}
	/**
	* Metodo para paginar las tablas de consulta
	*
	* @param int $numerosfilas
	* @param int $numrows
	* @param int $pagina_selecionada
	* @return componente
	*/
	function muestra_paginador($numerosfilas, $rowXpagina, $pagina_selecionada = 1)
	{
		$_SESSION[$this->nombre] = serialize($this);
		if  ($numerosfilas > $rowXpagina) // paginador si hay mas de una pagina
		{
		//echo '<form id="formPg" name="formPg" action="" method="POST" ;>';
			foreach ($_POST as $clave => $val) //mantenemos las variables POST
			{
				if ($clave != "menuPg")	echo"<input name=".$clave." type=\"hidden\" value='".$val."' />";
				//echo "<br>" . $clave.":".$val; // para debug
			}
			global $USE_SAJA;
			$saja = new saja();
			$saja->set_path('../../clases/saja/');
			$saja->set_process_file('../../gui/FuncionesObjetoGrid.php');
			$saja->set_process_class('GridFunctions');
			echo $saja->saja_js();
			echo '<label>Pagina:</label><select   id="menupg'.$this->nombre.'"';
			echo 'onchange="'. $saja->run("funcion_pagina('$this->nombre',menupg".$this->nombre.":value)->".$this->ajax_div.":innerHTML")  .';return false;"';
			echo ' >';
				
			$paginado='';
			$totalRows = $numerosfilas;
		
			for($i=1;$i<= ceil($numerosfilas/$rowXpagina);$i++)
			{
				$paginado .= '<option value="' . $i . '" ';
				$paginado .= ($i == $pagina_selecionada)? 'selected="selected">' : '>';
				$paginado .= " ".$i." de ". ceil($numerosfilas/$rowXpagina) ."</option>\n";
			}
			echo $paginado;
			echo '</select>';
		}
		else 
		{
			echo '<input type="hidden" value="1"  id="menupg'.$this->nombre.'" >';			
		}
		
	}
}

//$gr=new GridOj();
//$gr->setquery("select id,rif,nombre from companias");
//$gr->setalias_columnas(array('ID','RIF','Compania'));
//$gr->setnombre('Compañias');
//$gr->setlink_estilo_grid('<link rel="stylesheet" type="text/css" media="all" href="../../imagenes/css/grid.css"/>');
//$gr->setccs_class_grid('grid');
//$gr->setpaginador(10);
//$gr->GENERA_GRID(true,true);
?> 