// JavaScript Document
function ChangeCSSsmon(celda)
{
	celda.className = "submenuon";
}

function ChangeCSSsmoff(celda)
{
	celda.className = "submenu";
}
function ChangeCSSsmonM(celda)
{
	celda.className = "mainmenuon";
}

function ChangeCSSsmoffM(celda)
{
	celda.className = "mainmenu";
}

function gridCSSsmonM(celda,color)
{
	celda.bgColor = color;
}

function gridCSSsmoffM(celda,color)
{
	celda.bgColor = color;
}

function abre_ventana_tamano(ventana,width,height)
{
	controlwindow=window.open(ventana,"popup_tamano","toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width="+ width + ",height=" + height );
}


function calcDays(){
  var date1 = '01-01-2006'/*document.getElementById('d1').lastChild.data;*/
  var date2 = '01-01-2007'/*document.getElementById('d2').lastChild.data;*/
  date1 = date1.split("-");
  date2 = date2.split("-");
  var sDate = new Date(date1[0]+"/"+date1[1]+"/"+date1[2]);
  var eDate = new Date(date2[0]+"/"+date2[1]+"/"+date2[2]);
  var daysApart = Math.abs(Math.round((sDate-eDate)/86400000));
  return daysApart;
}

function Calcular_edad_completa(dateString,dateType) 
{
/*
   function Calcular_edad_completa
   parameters: dateString dateType
   returns: boolean

   dateString is a date passed as a string in the following
   formats:

   type 1 : 19970529
   type 2 : 970529
   type 3 : 29/05/1997
   type 4 : 29/05/97

   dateType is a numeric integer from 1 to 4, representing
   the type of dateString passed, as defined above.

   Returns string containing the age in years, months and days
   in the format yyy years mm months dd days.
   Returns empty string if dateType is not one of the expected
   values.
*/

    var now = new Date();
    var today = new Date(now.getYear(),now.getMonth(),now.getDate());

    var yearNow = now.getFullYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

    if (dateType == 1)
        var dob = new Date(dateString.substring(0,4),
                            dateString.substring(4,6)-1,
                            dateString.substring(6,8));
    else if (dateType == 2)
        var dob = new Date(dateString.substring(0,2),
                            dateString.substring(2,4)-1,
                            dateString.substring(4,6));
    else if (dateType == 3)
        var dob = new Date(dateString.substring(6,10),
                            dateString.substring(3,5)-1,
                            dateString.substring(0,2));
    else if (dateType == 4)
        var dob = new Date(dateString.substring(6,8),
                            dateString.substring(3,5)-1,
                            dateString.substring(0,2));
    else
        return '';

    var yearDob = dob.getFullYear();
    var monthDob = dob.getMonth();
    var dateDob = dob.getDate();

    if (yearDob<=99) 
    	yearDob +=1900 
	
	if (yearNow<=99)
		yearNow +=1900
			
	yearAge = yearNow - yearDob;

    if (monthNow >= monthDob)
        var monthAge = monthNow - monthDob;
    else {
        yearAge--;
        var monthAge = 12 + monthNow -monthDob;
    }

    if (dateNow >= dateDob)
        var dateAge = dateNow - dateDob;
    else {
        monthAge--;
        var dateAge = 31 + dateNow - dateDob;

        if (monthAge < 0) {
            monthAge = 11;
            yearAge--; 
        }
    }

    edad = new Array();
	edad[0] = yearAge;//anos
	edad[1] = monthAge;//meses
	edad[2] = dateAge;//dias
	return edad;
	//yearAge + ' years ' + monthAge + ' months ' + dateAge + ' days';
}

function readonly() 
{
	inputs=document.getElementsByTagName("INPUT");
	
   	for (i=0;i<inputs.length;i++) 
	{
	
	if ((inputs[i].name != 'btnsalir') && (inputs[i].name != 'postback')) inputs[i].disabled='disabled' ;
   	}
	selects=document.getElementsByTagName("SELECT");
	
   	for (i=0;i<selects.length;i++) 
	{
	 	
     		selects[i].disabled='disabled' ;
   	}

	textareas=document.getElementsByTagName("TEXTAREA");
	
   	for (i=0;i<textareas.length;i++) 
	{
	 	textareas[i].readonly='readonly';
	}
	
	    textareas=document.getElementsByTagName("TEXTAREA");
		var counter = document.createElement('div');
		counter.className = 'counter';
   	for (i=0;i<textareas.length;i++) 
	{
			var counterClone = counter.cloneNode(true);
			counterClone.relatedElement = textareas[i];
			counterClone.innerHTML = '<table  border="1" cellpadding="5" cellspacing="0" bordercolor="#A6A6A6" width="60%" ><tr><td bgcolor="#FFFFFF" >' + textareas[i].value + '&nbsp;</td></tr></table>';
			textareas[i].parentNode.insertBefore(counterClone,textareas[i].nextSibling);
	 	textareas[i].style.display="none";
     	//textareas[i].onkeydown=false;
   	}
}

//////////////////////////////////inicio taber cookies////////////////////////
/* Optional: Temporarily hide the "tabber" class so it does not "flash"
   on the page as plain HTML. After tabber runs, the class is changed
   to "tabberlive" and it will appear. */

document.write('<style type="text/css">.tabber{display:none;}<\/style>');

/*==================================================
  Cookie functions
  ==================================================*/
function setCookie(name, value, expires, path, domain, secure)
{
    document.cookie= name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires.toGMTString() : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

function getCookie(name)
{
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    } else {
        begin += 2;
    }
    var end = document.cookie.indexOf(";", begin);
    if (end == -1) {
        end = dc.length;
    }
    return unescape(dc.substring(begin + prefix.length, end));
}

function deleteCookie(name, path, domain)
{
    if (getCookie(name)) {
        document.cookie = name + "=" +
            ((path) ? "; path=" + path : "") +
            ((domain) ? "; domain=" + domain : "") +
            "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    }
}

//////////////////////////////////fin taber cookies////////////////////////

function setMaxLength() {
	var x = document.getElementsByTagName('textarea');
	var counter = document.createElement('div');
	counter.className = 'counter';
	for (var i=0;i<x.length;i++) {
		if (x[i].getAttribute('maxlength')) {
			var counterClone = counter.cloneNode(true);
			counterClone.relatedElement = x[i];
			counterClone.innerHTML = '<span>0</span>/'+x[i].getAttribute('maxlength');
			x[i].parentNode.insertBefore(counterClone,x[i].nextSibling);
			x[i].relatedElement = counterClone.getElementsByTagName('span')[0];

			x[i].onkeyup = x[i].onchange = checkMaxLength;
			x[i].onkeyup();
		}
	}
}

function checkMaxLength() {
	var maxLength = this.getAttribute('maxlength');
	var currentLength = this.value.length;
	if (currentLength > maxLength)
		this.relatedElement.className = 'toomuch';
	else
		this.relatedElement.className = '';
	this.relatedElement.firstChild.nodeValue = currentLength;
	// not innerHTML
}

function validar_fecha2(vDateName) 
{
		var strSeperator = '/';
		var noerror=true;
		vDat=vDateName.value;
		tam=vDat.length;
		dia=parseInt(vDat.substr(0,2));
		mes=parseInt(vDat.substr(3,2));
		ano=parseInt(vDat.substr(6,4));
		slash1=vDat.substr(2,1);
		slash2=vDat.substr(5,1);
		sibisiesto=bisiesto(ano);
		if ( tam > 10 || (tam > 0 && tam < 11 && ( mes > 12 || ((mes==4 || mes==6 || mes==9 || mes==11) && dia>30 ) ||
			( mes==2 && dia > 28 && ! sibisiesto ) || ( mes==2 && dia > 29 && sibisiesto ) || strSeperator != slash1 || strSeperator != slash2)))
			noerror=false;
		if (noerror)
		{
			mensaje='';
			document.getElementById('error').innerHTML= mensaje;
			return true;
		}
		else
		{
			mensaje='Debe colocar una fecha válida.<br>Formato válido: "día/mes/año" Ejemplo: 15/09/2007.<br>Verifique que sea un día válido para el mes.<br>';
			document.getElementById('error').innerHTML= mensaje;
		}
		vDateName.value='';
		return false;
}

//---- Validación de formato de fecha con retorno especifico de div de error ---//
function validar_fecha_ubi_error(vDateName, id) 
{
		var strSeperator = '/';
		var noerror=true;
		vDat=vDateName.value;
		tam=vDat.length;
		dia=parseInt(vDat.substr(0,2));
		mes=parseInt(vDat.substr(3,2));
		ano=parseInt(vDat.substr(6,4));
		slash1=vDat.substr(2,1);
		slash2=vDat.substr(5,1);
		sibisiesto=bisiesto(ano);
		if ( tam > 10 || (tam > 0 && tam < 11 && ( mes > 12 || ((mes==4 || mes==6 || mes==9 || mes==11) && dia>30 ) ||
			( mes==2 && dia > 28 && ! sibisiesto ) || ( mes==2 && dia > 29 && sibisiesto ) || strSeperator != slash1 || strSeperator != slash2)))
			noerror=false;
		if (noerror)
		{
			mensaje='';
			document.getElementById(id).innerHTML= mensaje;
			return true;
		}
		else
		{
			mensaje='Debe colocar una fecha válida.<br>Formato válido: "día/mes/año" Ejemplo: 15/09/2007.<br>Verifique que sea un día válido para el mes.<br>';
			document.getElementById(id).innerHTML= mensaje;
		}
		vDateName.value='';
		return false;
}
//--------------------------------//

function disableRightClick(e)
{
	var message = "Esta opción no se encuentra disponible";

	if(!document.rightClickDisabled) // initialize
	{
		if(document.layers)
		{
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = disableRightClick;
		}
		else document.oncontextmenu = disableRightClick;
		return document.rightClickDisabled = true;
	}
	if(document.layers || (document.getElementById && !document.all))
	{
		if (e.which==2||e.which==3)
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}
//--------------------------------//
//--------------------------------//
function DeshabilitaCtrl(e)
{
    var unicode=e.charCode? e.charCode : e.keyCode
    if (unicode==17) 
    {
		alert('No está permitida esta opción.')
		return false;
	}
	else
	{
		return true;	
	}
}
//-------------------------------//