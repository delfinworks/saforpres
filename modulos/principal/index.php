<?php
require_once("../../includes/funciones/funciones_iniciales.php");
include_once("../../includes/configuracion.php");
include_once("../../includes/capa_datos.php");
ob_start();
session_start();
?>
<link href="../../gui/temas/seniat/estilo2.css" rel="stylesheet" type="text/css"/>
<link href="../../gui/temas/seniat/estiloMenu.css" rel="stylesheet" type="text/css"/>
<link href="../../gui/temas/seniat/popupAyuda.css" rel="stylesheet" type="text/css"/>

<SCRIPT language=JavaScript type=text/javascript 
      src="../../gui/temas/seniat/menu.js">
</SCRIPT>

<SCRIPT language=JavaScript type=text/javascript 
      src="../../gui/temas/seniat/popupAyuda.js">
</SCRIPT>

<SCRIPT language=javascript>  
	
	function getDocHeight(doc) {
			var docHt = 0, sh, oh;
			if (doc.body) {
			if (doc.body.scrollHeight) docHt = sh = doc.body.scrollHeight;
			if (doc.body.offsetHeight) docHt = oh = doc.body.offsetHeight;
			if (sh && oh) docHt = Math.max(sh, oh);
			}
			return docHt;
	}

	function setIframeHeight(iframeName) {
			//alert("iframeName=" + iframeName);
			var iframeWin = window.frames[iframeName];
			//alert("iframeWin = " + iframeWin);
			var iframeEl = document.getElementById? document.getElementById(iframeName): document.all? document.all[iframeName]: null;
			//alert("iframeEl = " + iframeEl);
			
			if ( iframeEl && iframeWin ) {
			iframeEl.style.height = "auto";
			var docHt = getDocHeight(iframeWin.document);
				if (docHt) iframeEl.style.height = docHt + 20 + "px";
			}
	} 	
</SCRIPT>
<BODY>
<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
  <TBODY>
  <TR>
    <TD rowSpan=2 width=265 align=left><IMG border=0 
      src="../../images/logocr.gif" 
      width=207 height=73> </TD>
    <TD bgColor=#ffffff vAlign=center width=322 colSpan=2 align=left>
    <SPAN class=letrasFecha>Venezuela,
      <SCRIPT language=javascript>dows = new Array("domingo","lunes","martes","mi&eacute;rcoles","jueves","viernes","sabado");months = new    Array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");now = new Date();dow = now.getDay();d = now.getDate();m = now.getMonth();h = now.getTime();y = now.getFullYear();document.write("<font size=1 face=Arial Narrow>" + dows[dow]+" "+d+" de "+months[m]+" de "+y + "</font>");</SCRIPT>
       </SPAN></TD>
  </TR>
  <TR height=68>
    <TD 
    style="BACKGROUND-IMAGE:url(../../images/fondo_celda.jpg)" 
    height=68>&nbsp; </TD>
    <TD class=fondoPrincipal height=68 vAlign=baseline width=640 
      align=right><IMG border=0 alt="Aqui estan tus Tributos" 
      src="../../images/bannersai.png" 
      width=640 height=68></TD>
   </TR>
  <TR>
    <TD colspan="3">
    <table id=tblBarra2 class=barraPpal border=0 cellspacing=0 cellpadding=0 width="100%" align=center>
        <tbody>
          <tr>
            <td class=nombreBarra width="80%" align=left><img align=top src="../../images/online.png" />
              <?php 
	  echo $_SESSION['seniat_users_id_safor']." - ".$_SESSION['seniat_users_nombre_safor']; ?></td>
            <td width="20%" align=right><a href="#" onClick="window.location='../login/logout.php'; "><img border=0 
      src="../../images/salir.png" /></a>&nbsp;&nbsp;&nbsp;</td>
          </tr>
        </tbody>
      </table>
      </TD>
      </TR>
     <TR>
       <TD colspan="3">
       <TABLE border=0 cellSpacing=0 cellPadding=1 width="100%" valign="top">
  <TBODY>
  <TR>
    <TD class=tablaTitulo width=210>Men&uacute; Funcionario</TD>
    <TD class=tablaTitulo><?php echo NOMBRE_SITE; ?></TD>
  </TR>
  <TR>
    <TD vAlign=top width=210>
      <UL id=qm0 class=qmmc>
       	<LI><A class=qmparent 
				href="index.php" 
				target=_self>Principal</A> 
		</LI>
        <LI><A class=qmparent 
				href="../formulacion/plan.php" 
				target=_self>Formular Plan</A> 
		</LI>
        <LI><A class=qmparent 
				href="../formulacion/presupuesto.php" 
				target=_self>Formular Presupuesto</A> 
		</LI>
        <LI><A class=qmparent 
        	href="../reportes/reportes.php" 
        	target=frmDetalle>Reportes</A> 
        </LI>
        <LI><A class=qmparent 
        	href="../../../../../index.php?option=com_phocadownload&view=section&id=2:sec-for&Itemid=54" 
        	target=frmDetalle>Descargas</A> 
        </LI>
        <LI><A class=qmparent 
        	href="acercade.php" 
        	target=frmDetalle>Acerca de..</A> 
        </LI>
      </UL>
     
      <SCRIPT type=text/javascript>qm_create(0,true,250,250,false,false,false,false,false);</SCRIPT>

      <SCRIPT> setPopup();</SCRIPT>
    </TD>
    <TD height=0 vAlign=top width="100%">
    		<IFRAME id=frmDetalle onload="setIframeHeight('frmDetalle')" src="msj.php" scrolling="no" frameBorder=0 width="100%" name=frmDetalle valign="top"></IFRAME>
    </TD>
    </TR>
    </TBODY>
    </TABLE>
       </TD>
     </TR>
    </TD>
    </TR>
    </TBODY>
</TABLE>
</BODY>
</HTML>





