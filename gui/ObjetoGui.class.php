<?php 
include_once(PATH.'/includes/configuracion.php');
include_once(PATH.'/includes/capa_datos.php');

define('TEMA_SKIN','seniat');

include_once(PATH.'/gui/temas/'.TEMA_SKIN. '/tablas.html');
//include_once('../../gui/temas/'.TEMA_SKIN. '/menu_estilo.html');

/**
* Clase grafica
*
*/
class gui
{
	function gui()
	{
		//echo TEMA_SKIN;

		//include_once('../../../gui/temas/'.TEMA_SKIN. '/tablas.html');

	}
	/**
	 * Metodo que genera HTML del Principio de la tabla
	 *
	 * @param Opcional $titulo
	 * @param Opcional $link
	 */
	function marco_abrir($titulo = '', $link = '')
	{

		//echo "<br><br>";

		global $top_tabla1;
		global $top_tabla2;
		global $top_tabla_simple;
		if ($titulo != '')
		{
			if ($link != '') $link =  "href='" . $link . "'";
			$top =  $top_tabla1 ;
			$top .= $titulo ;
			$top .= $top_tabla2 ;

		}
		else
		{
			$top =  $top_tabla1 ;
			$top .=  $titulo;
			$top .= $top_tabla2 ;
			$top = $top_tabla_simple;
		}
		echo $top;
	}

	function marco_abrir_corto()
	{

		global $top_tabla_corta;
		$top = $top_tabla_corta;
		echo $top;
	}

	/**
	 * Metodo que genera HTML del fin de la tabla
	 *
	 */
	function marco_cerrar()
	{
		global $fin_tabla;
		echo  $fin_tabla;
	}

	/*	function marco_error(string $titulo = null , array $errores = null)
	{
	$this->marco_abrir();

	$this->marco_cerrar();
	}
	*/
	function mensaje_sistema($mensaje)
	{
		return "<div id=\"mensaje\" class=\"mensaje_sistema\"> <img src=\"../../imagenes/iconos/error.png\" >&nbsp;&nbsp;".$mensaje ."</div>
				<script>setTimeout(\"document.getElementById('mensaje').style.display = 'none';\", 2000);  </script>";
	}

	function pathway_recorrido($titulo = "" , $resetear = false, $url = null)
	{
		
		if ($url == null)$url =  $_SERVER['REQUEST_URI'];
		$array_url = $_SESSION['path_recorrido'];

		if  ($resetear == true)
		{
			unset($array_url);
			unset($_SESSION['path_recorrido']);
		}
		if  ($titulo != "")
		{
			$array_url[$titulo] =  $url;
		}
		$_SESSION['path_recorrido'] = $array_url;
		//$this->marco_abrir_corto();
		echo '<table  border="0" cellpadding="0" cellspacing="0"  class="navText" ><tr><td align="right"><div align="left">&nbsp;&raquo; ';
		echo "<a href=\"../../index.php\" target='_parent' ><b>Principal</b></a>\n";
		if (isset($array_url))
		{
			$sw = 0;
			$Keys = array_keys( $array_url );
			foreach( $Keys as $OneKey )
			{
				if ($titulo == $OneKey && $sw == 0 )
				{
					echo " &raquo; <a href='" . $array_url[$OneKey] . "'><b>".$OneKey."</b></a> \n";
					$sw = 1;
				}
				else
				{
					if ($sw == 0)
					{
						echo " &raquo; <a href='" . $array_url[$OneKey] . "'><b>".$OneKey."</b></a> \n";
					}
					else
					{
						unset($array_url[$OneKey]  );
						//echo  " borrar";
					}
				}
			}
		}
		$_SESSION['path_recorrido'] = $array_url;
		echo '</div></td><td width="10" align="right" >&nbsp;</td></tr></table>';
		//$this->marco_cerrar();
	}

	function  genera_main_menu()
	{
		if($_SESSION['rol'] == "")return "sesion caduco"; 
		
		$titulo_menu_tabla = "Menu Principal";
		$top_menu_tabla ='<table border="0" cellspacing="0" cellpadding="0" width="92%" id="navigation" >';
		$fin_menu_tabla='<tr>
		<td>		
		<a href="../../index.php?cerrar=cerrar" target="_top" onClick="return confirm(\'¿ Desea salir del sistema ?\');" ><strong>Cerrar Sesión</strong></a>		
		</td>
		</tr>
		</table>';


		$DB=DB_CONECCION();
		$SQL = "select distinct m.nombre,m.url,m.title,id_padre,sort_item from seniat_menu m 
		where (id_padre != 0) and visible = true and rol like '%".$_SESSION['rol']."%'
		union all select distinct m.nombre,m.url,m.title,id_padre,sort_item from seniat_menu m 
		where (id_padre = 0) and visible = true order by sort_item";
		$RS=$DB->Execute($SQL);
		//echo $SQL;
		//$this->rows = $RS->MaxRecordCount();

		//--VERIFICA QUE EXISTAN REGISTROS Y NO HAYA ERROR--//
		if (!$RS)
		{
			printf(ADODB_BAD_RS,'Error generando el menu');
			return false;
		}

		$return_out .= $top_menu_tabla;

		while (!$RS->EOF)
		{
			$return_out .= $this->item_menu_tabla($RS->fields['nombre'],'principal',$RS->fields['url'],$RS->fields['title'],$RS->fields['id_padre']);

			$RS->MoveNext();
		}
		$return_out .= $fin_menu_tabla;
		return $return_out;
	}


	function item_menu_tabla($item_menu_tabla,$target_menu_tabla,$url_menu_tabla,$title_menu_tabla, $id_padre=0)
	{
		if ($id_padre == 0)
		{
		$res = '<tr><td class="tablatitle"><br>  
				<ul >
                  <li   title="'.$title_menu_tabla.'">'.$item_menu_tabla.'</li>
                </ul></td></tr>';
		}
		else 
		{
		$res =  '<tr><td width="100%" ><a href="'.$url_menu_tabla.'" target="'.$target_menu_tabla.'" title="'.$title_menu_tabla.'"  >
   		   <strong>'.$item_menu_tabla.'</strong></a></td>
           </tr>
           ';
		}
		return $res;
	}


}
$gui = new gui;
?>