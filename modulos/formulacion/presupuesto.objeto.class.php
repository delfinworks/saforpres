<?php 
/*
======================================
CLASE formulacion
======================================
*/
include_once("../../includes/capa_datos.php");

class clase_presupuesto
{

 public  $pry;
 public  $ae;
 public  $eje;
 
 public  $part; 
 public  $part_ene; 
 public  $part_feb; 
 public  $part_mar; 
 public  $part_abr; 
 public  $part_may; 
 public  $part_jun; 
 public  $part_jul; 
 public  $part_ago; 
 public  $part_sep; 
 public  $part_oct; 
 public  $part_nov; 
 public  $part_dic; 
 public  $part_total; 

 public  $error;
 
 public function setpry($pry)
 {
    $this->pry= $pry;
 }
 
 public function setae($ae)
 {
    $this->ae= $ae;
 }
 
 public function seteje($eje)
 {
    $this->eje= $eje;
 }
 
 public function setpart($part)
 {
	if ($part==0)$this->seterror('Partida: El nombre no puede estar vacío');  
    $this->part= $part;
 }
 
 public function setpart_meses($part_ene, $part_feb, $part_mar, $part_abr, $part_may, $part_jun, $part_jul, $part_ago, $part_sep, $part_oct, $part_nov, $part_dic)
 {
    $this->part_ene = $part_ene;
	$this->part_feb = $part_feb;
	$this->part_mar = $part_mar;
	$this->part_abr = $part_abr;
	$this->part_may = $part_may;
	$this->part_jun = $part_jun;
	$this->part_jul = $part_jul;
	$this->part_ago = $part_ago;
	$this->part_sep = $part_sep;
	$this->part_oct = $part_oct;
	$this->part_nov = $part_nov;
	$this->part_dic = $part_dic;
 }
 
 public function geterror()
 {
    return $this->error;
 }

 public function seterror($error)
 {
    if ($this->error=='' && $error!='')$this->error='Verifique los siguentes errores: \n\n';
    $this->error .= $error.'\n';
 }

 public function Clase_Buscapart()
 {
 	$SQL = "SELECT 
				safor_pry_ae_eje_part.id_partida, 
				safor_pry_ae_eje_part.ene, 
				safor_pry_ae_eje_part.feb, 
				safor_pry_ae_eje_part.mar, 
				safor_pry_ae_eje_part.abr, 
				safor_pry_ae_eje_part.may, 
				safor_pry_ae_eje_part.jun, 
				safor_pry_ae_eje_part.jul, 
				safor_pry_ae_eje_part.ago, 
				safor_pry_ae_eje_part.sep, 
				safor_pry_ae_eje_part.oct, 
				safor_pry_ae_eje_part.nov, 
				safor_pry_ae_eje_part.dic, 
				safor_pry_ae_eje_part.total
			FROM safor_pry_ae_eje_part 
			WHERE (safor_pry_ae_eje_part.id_partida = ".$this->part.") AND 
			      (safor_pry_ae_eje_part.id_ae = ".$this->ae.") AND 
				  (safor_pry_ae_eje_part.id_eje = ".$this->eje.")";
    $db=DB_CONECCION();
    $rs = $db->Execute($SQL ); // resultado sql
    if (!$rs->EOF)
    {
		$this->part_ene= $rs->fields['ene'];
		$this->part_feb= $rs->fields['feb'];
		$this->part_mar= $rs->fields['mar'];
		$this->part_abr= $rs->fields['abr'];
		$this->part_may= $rs->fields['may'];
		$this->part_jun= $rs->fields['jun'];
		$this->part_jul= $rs->fields['jul'];
		$this->part_ago= $rs->fields['ago'];
		$this->part_sep= $rs->fields['sep'];
		$this->part_oct= $rs->fields['oct'];
		$this->part_nov= $rs->fields['nov'];
		$this->part_dic= $rs->fields['dic'];
		$this->part_total= $rs->fields['total'];
     }
 }
 
 public function Clase_GuardarPart() 
 {
    if ($this->error!="")return $array=array(false,$this->error,0);
    $SQL = "call grabar_part ('$this->pry', '$this->ae', '$this->eje', '$this->part', '$this->part_ene', '$this->part_feb', '$this->part_mar', '$this->part_abr', '$this->part_may', '$this->part_jun', '$this->part_jul', '$this->part_ago', '$this->part_sep', '$this->part_oct', '$this->part_nov', '$this->part_dic', '".$_SESSION['seniat_users_id_safor']."', '".$_SERVER['REMOTE_ADDR']."')";
    $db=DB_CONECCION();
    $rs = $db->Execute($SQL) or die("Error guardando");
    $db->close();
    return $array=array($rs->fields[0],utf8_decode($rs->fields[1]),$rs->fields[2]);
 }
 
 public function Clase_BorrarPart() 
 {
    if ($this->error!="")return $array=array(false,$this->error,0);
    $SQL = "call borrar_part ('$this->ae', '$this->eje', '$this->part', '".$_SESSION['seniat_users_id_safor']."', '".$_SERVER['REMOTE_ADDR']."')";
	$db=DB_CONECCION();
    $rs = $db->Execute($SQL) or die("Error Eliminando");
    $db->close();
    return $array=array($rs->fields[0],utf8_decode($rs->fields[1]),$rs->fields[2]);
 }
}?>
