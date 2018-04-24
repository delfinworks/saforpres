<?php
include_once("../../includes/configuracion.php");
include_once(PATH."/gui/ObjetoGrid.class.php");
class GridFunctions extends saja
{
	function funcion_pagina($obj,$pagina)
	{
		$grid = unserialize($_SESSION[$obj]);
		$grid->GENERA_GRID(true,true,true,$pagina);	
 	}
}
?>