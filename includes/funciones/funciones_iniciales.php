<?php 
if (get_magic_quotes_gpc())
{
   die('Error: Configuración del Servidor, magic_quotes_gpc en el PHP.ini tiene que estar en OFF!! <br>');
}
ini_set("session.gc_maxlifetime" , 50000);
ob_start();
session_start();

			// modificacion para el tiempo de sesion
			if($_SESSION['autentificado_safor']!="SI"){
			echo '<script>location.href="../../modulos/login/index.php"</script>';
			}	
		// fin modificacion para el tiempo de sesion
	

include_once('funciones_generales.php');
include_once(PATH."/includes/capa_datos.php");
ini_set( "default_charset", JUEGO_CARACTERES );
ini_set("display_errors", MOSTRAR_ERRORES_PHP);
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>'. NOMBRE_SITE .  '</title>
<script type="text/javascript" src="../../js/tabber.js"></script>
<SCRIPT src="../../js/funciones.js"></SCRIPT><!--Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="../../js/jscalendar-1.0/calendar-blue2.css"    title="calendar-blue2" />
<!-- librería principal del calendario -->
 <script type="text/javascript" src="../../js/jscalendar-1.0/calendar.js"></script>
<!-- librería para cargar el lenguaje deseado -->
  <script type="text/javascript" src="../../js/jscalendar-1.0/lang/calendar-es.js"></script>
<SCRIPT TYPE="text/javascript"  src="../../js/verifynotify.js"></SCRIPT>
<script type="text/javascript">
disableRightClick();
function abre_reporte(ventana)
{	
controlreporte=window.open(ventana,"reporte","toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=640,height=480");
}
function ismaxlength(obj)//para textarea
{
	var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
	if (obj.getAttribute && obj.value.length>mlength)
	obj.value=obj.value.substring(0,mlength)
}
</script>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
<script type="text/javascript" src="../../js/jscalendar-1.0/calendar-setup.js"></script>
<script>
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>';
require_once(PATH."/gui/ObjetoGui.class.php");
include_once('../../clases/saja/saja.php');
$saja = new saja();
$saja->set_path('../../clases/saja/');
echo '</head>';
?>
