<?php
require_once("../../includes/funciones/funciones_iniciales.php");
$saja->set_process_file(PATH."/modulos/principal/index.funciones.php");
$saja->set_process_class("index_funciones");

echo $saja->saja_js();
//$gui->pathway_recorrido("Acerca de..",true);  
?>
<style type="text/css">
.centrado{
	text-align: center;
}
</style>
<link href="msj/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="msj/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="msj/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="msj/sprinkle.js"></script>
<script language="JavaScript">
	<?php echo $saja->run("Grid_Eje()->eje");?>
</script>

<body>
<?php $gui->marco_abrir("Bienvenido ".$_SESSION['seniat_users_nombre_safor']); ?>
		<div id="tabvanilla" class="widget">
            <ul class="tabnav">
                <li><a href="#general">INFORMACI&oacute;N GENERAL</a></li>
           <li><a href="#msj">MENSAJERO</a></li>
                <li><a href="#ppto">STATUS DE LA FORMULACI&oacute;N DEL PRESUPUESTO</a></li>
              <li><a href="#soporte">SOPORTE</a></li>
            </ul>

            <div id="general" class="tabdiv">
                <ul>
                	<p align="center"><img src="../../images/2012.jpg" width="324" height="50"></p>
                	<p>&nbsp;</p>
                   <li>Usuario actual: <strong class="rojo"><?php echo $_SESSION['seniat_users_id_safor']." - ".$_SESSION['seniat_users_nombre_safor']; ?></strong><img src="../../images/online.png" width="16" height="16"></li>
                   <li>Pertenece a la Unidad: <strong class="rojo"><?php echo $_SESSION['seniat_users_eje_safor']." - ".$_SESSION['seniat_users_eje_des_safor']; ?></strong></li>
                   <li><strong class="rojo">Oficialmente el Sistema se encuentra en MODO SOLO CONSULTA</strong></li>
                   <p>&nbsp;</p>
                   <p align="justify">Recuerde que todas las operaciones (Ingreso, Registro, Modificaci&oacute;n y Eliminaci&oacute;n) realizadas por su usuario generan traza de auditor&iacute;a, por lo cual recuerde que su clave de usuario es intransferible y de car&aacute;cter confidencial.<img src="../../images/info_on.JPG" width="16" height="16"></p>               
                   <p align="center">&copy; Copyright Oficina de Planificaci&oacute;n y Presupuesto / 2011 - Red Interna del <a href="http://www.seniat.gob.ve/" title="SENIAT" target="_blank">SENIAT</a> / Portal <a href="http://opp/opp/opp.php" title="OPP" target="_parent">OPP</a></p>
              </ul>
</div>

		<div id="msj" class="tabdiv">
        	<ul>
            	<p><strong>Mensajes Genreales:</strong></p>                
                <li align="justify">Debe calcular manualmente la espec&iacute;fica <strong>403180100 - Impuesto al valor agregado</strong> para cada una de las acciones espec&iacute;ficas.</li>
   		  </ul>
</div>
             <div id="ppto" class="tabdiv">
                <ul>
                    <li><strong>Status de la Formulaci&oacute;n por Ejecutor:</strong></li>
                  <p><div id="eje"></div></p>
              </ul>
            </div>
            <div id="soporte" class="tabdiv">
                <ul>
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                	  <tr>
                	    <td colspan="2"><p><strong>Soporte Metodol&oacute;gico:</strong></p></td>
               	      </tr>
                	  <tr>
                	    <td>
                        <li><strong>Livia Ram&iacute;rez Bastidas</strong></li>
                    <p><strong>Correo: </strong> lramireb@seniat.gob.ve</p>  
                  	<p><strong>Tel&eacute;fono: </strong> 0212-2744271</p>
                    	</td>
                	    <td>
                        <li><strong>Xiomara Margarita Rodr&iacute;guez Bolivar</strong></li>
                    <p><strong>Correo: </strong> xrodrigu@seniat.gob.ve</p>  
                  	<p><strong>Tel&eacute;fono: </strong> 0212-2744094</p>
                        </td>
              	    </tr>
                	  <tr>
                	    <td colspan="2">&nbsp;</td>
               	      </tr>
                	  <tr>
                	    <td colspan="2"><p><strong>Soporte T&eacute;cnico:</strong></p></td>
              	    </tr>
                	  <tr>
                	    <td>
                        <li><strong>Carlos Miguel Delf&iacute;n Andrade</strong></li>
                    <p><strong>Correo: </strong> cdelfin@seniat.gob.ve</p>  
                  	<p><strong>Tel&eacute;fono: </strong> 0212-2744612</p>
                    	</td>
                	    <td>
                        <li><strong>Jos&eacute; Roberto Garc&iacute;a Ventura</strong></li>
                    <p><strong>Correo: </strong> jgarciav@seniat.gob.ve</p>  
                  	<p><strong>Tel&eacute;fono: </strong> 0212-2744074</p>
                        </td>
              	    </tr>
              	  </table>
              </ul>
            </div>
        </div>

<?php $gui->marco_cerrar(); ?>
</body>
</html>