<?php
include_once('../../includes/capa_datos.php');

//---Funciones que generan listboxmatch--//

function ListEncuestaTipoCampo($name, $select)
{
	$sql = 'select nombre, id from encuesta_tipo_campo order by nombre';
	$db=DB_CONECCION();
	$rs = $db->Execute($sql);
	echo $rs->GetMenu2($name,$select);
}

function ListEncuestaTipoRegistro($name, $select)
{
	$sql = 'select nombre, id from encuesta_tipo_registro order by nombre';
	$db=DB_CONECCION();
	$rs = $db->Execute($sql);
	echo $rs->GetMenu2($name,$select);
}


function ListValor($name, $select)
{
	$sql = 'select nombre, id from valor order by nombre';
	$db=DB_CONECCION();
	$rs = $db->Execute($sql);
	echo $rs->GetMenu2($name,$select);
}
//---Fin funciones Listboxmatch---//

//---Otras funciones--//
function fecha_formatear_timestamp($raw_date, $formato = "Y-m-d"  )
{
	if ( ($raw_date == '00-00-0000 00:00:00') || empty($raw_date) ) return false;
	$day = (int)substr($raw_date, 0, 2);
	$month = (int)substr($raw_date, 3, 2);
	$year = (int)substr($raw_date, 6, 4);
	$hour = 00;
	$minute = 00;
	$second = 00;
	return date( $formato , mktime($hour,$minute,$second,$month,$day,$year));
}

//--Convierte una fecha que viene en formato timestamp en string en español con el dia de la semana, dia del mes, mes y año
function fecha_formatear($fecha_timestamp) {

	$ano = substr($fecha_timestamp,0,4);
	$mes = substr($fecha_timestamp,5,2);
	$dia = substr($fecha_timestamp,8,2);
	
	#Imprimimos la fecha completa
	$fecha = $dia. '-'. $mes. '-'.$ano;
	return $fecha;
}

function comprobar_email($email){ 
    $mail_correcto = 0; 
    //compruebo unas cosas primeras 
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
          //miro si tiene caracter . 
          if (substr_count($email,".")>= 1){ 
             //obtengo la terminacion del dominio 
             $term_dom = substr(strrchr ($email, '.'),1); 
             //compruebo que la terminación del dominio sea correcta 
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
                //compruebo que lo de antes del dominio sea correcto 
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
                if ($caracter_ult != "@" && $caracter_ult != "."){ 
                   $mail_correcto = 1; 
                } 
             } 
          } 
       } 
    } 
    if ($mail_correcto) 
       return 1; 
    else 
       return 0; 
}
 
/**
 *funcion que retorna $length numeros de caracteres por la izquierda del $string
 *
 * @param string $string
 * @param integer $length
 * @return string
 */
function left($string, $length) {
	return substr($string, 0, $length);
}



/**
 *funcion que retorna $length numeros de caracteres por la izquierda del $string
 *
 * @param string $string
 * @param integer $length
 * @return string
 */
function right($string, $length) {
	return substr($string, -$length, $length);
} 

function password_aleatorio()
{ 
$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz234567890";
$cad = str_shuffle($str);
$cad= substr($cad,0,8);
return  $cad;
}

function excluir_caracteres($campo)
{
	$string_excluir = "' \" / . \\ , # @ ; : & % ! $ ? ¨ | ( ) + = * { } _ [ ] ~ ";
	$array_excluir = split(' ' , $string_excluir);

	////elimina los caracteres no necesarios del codigo ASCII
	for($i=0; $i < 32 ; $i++  )
	{

		$array_caracter[$i] = chr($i);
	}
	for($i=123; $i < 190 ; $i++  )
	{
		$array_caracter[$i - 91] = chr($i);
	}
	///fin/////////////////////////////////////////////////////

	$campo = str_replace( $array_caracter ," ",$campo);
	$campo = str_replace( $array_excluir ," ",$campo);

	return $campo;
}

function generador_login($login)
{
	define(NUMERO_CARACTERES_LOGIN,12);
	$login = excluir_caracteres($login);
	$login = strtoupper($login);
    $login_array = split(' ',$login);
	$loginG  =  substr($login_array[0] , 0, NUMERO_CARACTERES_LOGIN);
		
	
	$campo = "max(substr(upper(login),".strlen($loginG)."+1,1000))::int+1" ;
	
	$sql = "select $campo as secuencia from usuarios where substr(upper(login),1,".strlen($loginG).") = '" . $loginG  . "'";
	
	$db=DB_CONECCION();
	$rs = $db->Execute($sql);
	$secuencia =  $rs->fields['secuencia'];
	$res = ($secuencia > 0)?$loginG . $secuencia : $loginG;
	return  $res;
}

function generador_login_relleno($login)
{
	define(NUMERO_CARACTERES_LOGIN,12);
	$login = excluir_caracteres($login);
	$login = strtoupper($login);
    $login_array = split(' ',$login);
	$loginG  =  substr($login_array[0] , 0, NUMERO_CARACTERES_LOGIN);
	$loginG  =  str_pad($loginG,NUMERO_CARACTERES_LOGIN,'0',STR_PAD_RIGHT);
		
	$sql = "select count(login) as secuencia from usuarios where substr(upper(login),1,".NUMERO_CARACTERES_LOGIN.") = '" . $loginG  . "'";
	
	$db=DB_CONECCION();
	$rs = $db->Execute($sql);
	return  $loginG . $rs->fields['secuencia'];
}


//----------------------------//

?>