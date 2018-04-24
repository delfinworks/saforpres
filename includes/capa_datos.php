<?php
include_once('configuracion.php');
include_once('funciones/funciones_generales.php');
include_once(PATH.'/clases/adodb/adodb.inc.php');
include_once(PATH.'/clases/adodb/tohtml.inc.php'); //clase para el modulo de exportar a excel 

function DB_CONECCION()
{
	$DB = &ADONewConnection(DB_TYPE);
	$DB->Connect(DB_SERVIDOR,DB_SERVIDOR_USERNAME,DB_SERVIDOR_PASSWORD,DB_DATABASE);
	$DB->debug=DEBUG_ADODB;
	return $DB;
}
?>
