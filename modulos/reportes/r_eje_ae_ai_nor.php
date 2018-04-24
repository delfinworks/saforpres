<?php
ob_start();
session_start();
include_once("../../includes/configuracion.php");
include_once("../../includes/capa_datos.php");
include_once("../../clases/pdf/fpdf.php");

class PDF extends FPDF
{
	
	function Header()
	{
  		//COLOCAMOS LA FECHA EN ESPAÑOL
		// Obtenemos y traducimos el nombre del día
		$dia=date("l");
		if ($dia=="Monday") $dia="Lunes";
		if ($dia=="Tuesday") $dia="Martes";
		if ($dia=="Wednesday") $dia="Miércoles";
		if ($dia=="Thursday") $dia="Jueves";
		if ($dia=="Friday") $dia="Viernes";
		if ($dia=="Saturday") $dia="Sabado";
		if ($dia=="Sunday") $dia="Domingo";
 
		// Obtenemos el número del día
		$dia2=date("d");
 
		// Obtenemos y traducimos el nombre del mes
		$mes=date("F");
		if ($mes=="January") $mes="Enero";
		if ($mes=="February") $mes="Febrero";
		if ($mes=="March") $mes="Marzo";
		if ($mes=="April") $mes="Abril";
		if ($mes=="May") $mes="Mayo";
		if ($mes=="June") $mes="Junio";
		if ($mes=="July") $mes="Julio";
		if ($mes=="August") $mes="Agosto";
		if ($mes=="September") $mes="Setiembre";
		if ($mes=="October") $mes="Octubre";
		if ($mes=="November") $mes="Noviembre";
		if ($mes=="December") $mes="Diciembre";
		$ano=date("Y");
		$fecha= "$dia, $dia2 de $mes de $ano";
	

		$this->SetTextColor(0,0,0);

		$this->Image('../../images/logocr.gif',0,0,25);
    		$this->SetFont('Arial','B',10);
		$this->SetY(6);
		$this->SetX(95);
		$this->Cell(20,0,'DISTRIBUCIÓN MENSUAL DE LAS METAS FÍSICAS AÑO 2012');
		$this->SetFont('Arial','',7);
		$this->SetY(10);$this->SetX(1);$this->Cell(10,0,'Nombre del Proyecto: Sistema Tributario Socialista / Sistema Aduanero Socialista - Segunda Fase Fortalecimiento.');
		$this->SetY(13);$this->SetX(1);$this->Cell(10,0,'Directriz: Modelo Productivo Socialista / Nueva Geopolítica Internacional.');

		$this->SetY(16);$this->SetX(1);$this->Cell(10,0,'Objetivo: Desarrollar el nuevo modelo productivo endógeno como base económica del Socialismo del Siglo XXI y alcanzar un crecimiento sostentivo. / Fortalecer la soberanía nac. vigorizando y ampliando las alianzas orientadas a la conformación del');

		$this->SetY(19);$this->SetX(1);$this->Cell(10,0,'bloque geopolítico regional de un mundo multipolar.');

		$this->SetY(22);$this->SetX(1);$this->Cell(10,0,'Estrategia: Consolidar el carácter endógeno de la economía. / Mantener relaciones soberanas ante el bloque hegemónico mundial.');
		$this->SetY(25);$this->SetX(1);$this->Cell(10,0,'Objetivo Estratégico Institucional: Reordenar el Sist. Tributario a la concepción Socialista del Estado Venezolano para garantizar estructuras impositivas que distribuyan a la carga en función del esfuerzo humano productivo, req. para generar la riqueza./ Reordenar el Sist. Aduanero a la concepción Socialista del Estado Venezolano para promover y proteger el modelo de desarrollo Socialista.');

		$this->SetY(28);$this->SetX(1);$this->Cell(10,0,'Reordenar el Sist. Aduanero a la concepción Socialista del Estado Venezolano para promover y proteger el modelo de desarrollo Socialista.');
		
		$this->SetY(31);$this->SetX(1);$this->Cell(10,0,'Objetivo Específico del Proyecto: Desarrollar un Sistema Integral de Cobranza y Control Fiscal./Fortalecer la capacidad del Serv. Aduanero para la seguridad y defensa nac., prot. y preservación de la vida, el ambiente, la soc. y la economía nac.');
		$this->SetY(33);$this->SetX(1);
		$this->Cell(278,0.1,'',0.1,0,'L',1);
		
		//Fecha	
		$this->SetFont('Arial','I',10);
		$this->SetY(2);
		$this->SetX(190);
		$this->Cell(120,10,$fecha,0,0,'C');
		
		//TITULOS
		$this->SetFillColor(232,232,232);
		$this->SetFont('Arial','B',9);
		$this->SetY(37);$this->SetX(1);
		$this->Cell(60,4,'Acción Específica / Acción Intermedia',0,0,'L',1);
		$this->SetY(41);$this->SetX(1);
		$this->Cell(66,4,'Unidad de Medida ',0,0,'L',1);
		$this->SetY(41);$this->SetX(67);$this->Cell(20,4,'Ene.',0,0,'L',1);
		$this->SetY(41);$this->SetX(84);
		$this->Cell(20,4,'Feb.',0,0,'L',1);
		$this->SetY(41);$this->SetX(101);
		$this->Cell(20,4,'Mar.',0,0,'L',1);
		$this->SetY(41);$this->SetX(118);
		$this->Cell(20,4,'Abr.',0,0,'L',1);
		$this->SetY(41);$this->SetX(135);
		$this->Cell(20,4,'May.',0,0,'L',1);
		$this->SetY(41);$this->SetX(152);
		$this->Cell(20,4,'Jun.',0,0,'L',1);
		$this->SetY(41);$this->SetX(169);
		$this->Cell(20,4,'Jul.',0,0,'L',1);
		$this->SetY(41);$this->SetX(186);
		$this->Cell(20,4,'Ago.',0,0,'L',1);
		$this->SetY(41);$this->SetX(203);
		$this->Cell(20,4,'Sep.',0,0,'L',1);
		$this->SetY(41);$this->SetX(219);
		$this->Cell(20,4,'Oct.',0,0,'L',1);
		$this->SetY(41);$this->SetX(236);
		$this->Cell(20,4,'Nov.',0,0,'L',1);
		$this->SetY(41);$this->SetX(252);
		$this->Cell(20,4,'Dic.',0,0,'L',1);
		$this->SetY(41);$this->SetX(266);
		$this->Cell(10,4,'Total',0,0,'L',1);
		$this->Ln();
		
	}
	function Footer()
	{
   		$this->SetTextColor(0,0,180);	
		$this->SetY(-15);
 	        $this->SetFont('Arial','I',8);
 	        $this->Cell(0,10,'Páginas '.$this->PageNo().'/{nb}',0,0,'C');
                
		$this->SetY(208);
		$this->SetX(90);
		$this->Cell(0,10,'FORMULACION DEL PLAN 2012 - Oficina de Planificación y Presupuesto');

	}
}
	$eje=$_GET['eje']; // para el ejecutor
	
	$pdf=new PDF('L','mm','letter');
	$pdf->AliasNbPages();

	$pdf->AddPage();
	$pdf->SetFont('Arial','',8);
	
	$Y_Fields_Name_position = 20;
	
		$db=DB_CONECCION();
		$SQL = ("SELECT safor_eje.descripcion
				FROM safor_eje
				WHERE (safor_eje.id_eje=".$eje.")");
		$grupo_eje = $db->Execute($SQL) or die("Error consultando el ejecutor");
		if (!$grupo_eje ->EOF)
		{
			$pdf->SetFont('Arial','B',9);
			$pdf->SetY(34);$pdf->SetX(1);$pdf->Cell(40,3,'Unidad Ejecutora: '.$grupo_eje ->fields['descripcion'],0,0,'L');	
			
			$SQL = ("SELECT safor_pry_ae_eje_um.id_ae, 
							safor_ae.descripcion
					FROM safor_ae INNER JOIN safor_pry_ae_eje_um ON safor_ae.id_ae = safor_pry_ae_eje_um.id_ae
					WHERE (safor_ae.id_eje=".$eje.") AND (safor_ae.poa=TRUE)
					GROUP BY safor_pry_ae_eje_um.id_ae, safor_ae.descripcion");

			$grupo_ae = $db->Execute($SQL) or die("Error consultando la accion especifica");			
			
			$pdf->SetY(42);
			while(!$grupo_ae ->EOF)
			{
			$pdf->SetFont('Arial','I',8);
			$pdf->SetX(1);
			$pdf->Cell(10,10,$grupo_ae ->fields['id_ae']." - ".$grupo_ae ->fields['descripcion'],0,0,'L');
			$pdf->Ln(); 
			
			$SQL = ("SELECT safor_pry_ae_eje_um.id_um, 
							Left(safor_pry_ae_eje_um.descripcion,40) AS descrip, 
							safor_pry_ae_eje_um.total, 
							safor_pry_ae_eje_um.ene, 
							safor_pry_ae_eje_um.feb, 
							safor_pry_ae_eje_um.mar, 
							safor_pry_ae_eje_um.abr, 
							safor_pry_ae_eje_um.may, 
							safor_pry_ae_eje_um.jun, 
							safor_pry_ae_eje_um.jul, 
							safor_pry_ae_eje_um.ago, 
							safor_pry_ae_eje_um.sep, 
							safor_pry_ae_eje_um.oct, 
							safor_pry_ae_eje_um.nov, 
							safor_pry_ae_eje_um.dic
					FROM safor_ae INNER JOIN safor_pry_ae_eje_um ON (safor_ae.id_eje = safor_pry_ae_eje_um.id_eje) AND (safor_ae.id_ae = safor_pry_ae_eje_um.id_ae)
					WHERE ((safor_ae.id_ae=".$grupo_ae->fields['id_ae'].") AND 
						   (safor_pry_ae_eje_um.id_eje=".$eje.") AND
						   (safor_ae.id_eje=".$eje."))");
					
					$grupo_part = $db->Execute($SQL) or die("Error consultando unidad de medida");
		
				
				while(!$grupo_part->EOF)
				{	
					$pdf->SetFont('Arial','',8);
					$pdf->SetX(3);$pdf->Cell(10,5,$grupo_part->fields['descrip'],'C');
					$pdf->Ln(); 
					$pdf->SetX(67);$pdf->Cell(5,5,number_format($grupo_part->fields['ene'],0,',','.'),0,0,'R');
					$pdf->SetX(84);$pdf->Cell(5,5,number_format($grupo_part->fields['feb'],0,',','.'),0,0,'R');
					$pdf->SetX(101);$pdf->Cell(5,5,number_format($grupo_part->fields['mar'],0,',','.'),0,0,'R');
					$pdf->SetX(118);$pdf->Cell(5,5,number_format($grupo_part->fields['abr'],0,',','.'),0,0,'R');
					$pdf->SetX(135);$pdf->Cell(5,5,number_format($grupo_part->fields['may'],0,',','.'),0,0,'R');
					$pdf->SetX(152);$pdf->Cell(5,5,number_format($grupo_part->fields['jun'],0,',','.'),0,0,'R');	
					$pdf->SetX(169);$pdf->Cell(5,5,number_format($grupo_part->fields['jul'],0,',','.'),0,0,'R');
					$pdf->SetX(186);$pdf->Cell(5,5,number_format($grupo_part->fields['ago'],0,',','.'),0,0,'R');
					$pdf->SetX(203);$pdf->Cell(5,5,number_format($grupo_part->fields['sep'],0,',','.'),0,0,'R');
					$pdf->SetX(219);$pdf->Cell(5,5,number_format($grupo_part->fields['oct'],0,',','.'),0,0,'R');
					$pdf->SetX(236);$pdf->Cell(5,5,number_format($grupo_part->fields['nov'],0,',','.'),0,0,'R');
					$pdf->SetX(252);$pdf->Cell(5,5,number_format($grupo_part->fields['dic'],0,',','.'),0,0,'R');
					$pdf->SetX(266);$pdf->Cell(5,5,number_format($grupo_part->fields['total'],0,',','.'),0,0,'R');
					$pdf->Ln();
					$grupo_part->MoveNext();	
				}
				
					$SQL = ("SELECT safor_ai.id_ai, 
								safor_ai.descripcion AS descripcion
						FROM safor_pry_ae_ai_eje_um 
						INNER JOIN (safor_ae INNER JOIN safor_ai ON safor_ae.id_ae=safor_ai.id_ae) ON (safor_ai.id_ai=safor_pry_ae_ai_eje_um.id_ai) AND (safor_pry_ae_ai_eje_um.id_ae=safor_ae.id_ae)
						WHERE ((safor_ae.id_ae=".$grupo_ae->fields['id_ae'].") AND
							   (safor_ae.id_eje=".$eje.") AND 
							   (safor_ai.id_eje=".$eje.") AND
							   (safor_pry_ae_ai_eje_um.id_eje=".$eje."))
						GROUP BY safor_ae.id_ae, safor_ai.id_ai, safor_ai.descripcion");
					$grupo_ai = $db->Execute($SQL) or die("Error consultando accion interna");

					while(!$grupo_ai->EOF)
						{						
						$pdf->SetFont('Arial','I',8);
						$pdf->SetX(8);$pdf->Cell(80,10,$grupo_ai->fields['id_ai']." - ".$grupo_ai->fields['descripcion']);
						$pdf->Ln(); 
						
						///consulta mas interna
						$SQL = ("SELECT safor_pry_ae_ai_eje_um.id_um, 
								Left(safor_pry_ae_ai_eje_um.descripcion,30) AS descripci, 
								safor_pry_ae_ai_eje_um.total, 
								safor_pry_ae_ai_eje_um.ene, 
								safor_pry_ae_ai_eje_um.feb, 
								safor_pry_ae_ai_eje_um.mar, 
								safor_pry_ae_ai_eje_um.abr, 
								safor_pry_ae_ai_eje_um.may, 
								safor_pry_ae_ai_eje_um.jun, 
								safor_pry_ae_ai_eje_um.jul, 
								safor_pry_ae_ai_eje_um.ago, 
								safor_pry_ae_ai_eje_um.sep, 
								safor_pry_ae_ai_eje_um.oct, 
								safor_pry_ae_ai_eje_um.nov, 
								safor_pry_ae_ai_eje_um.dic
								FROM safor_pry_ae_ai_eje_um
								WHERE ((safor_pry_ae_ai_eje_um.id_ae=".$grupo_ae ->fields['id_ae'].") AND (safor_pry_ae_ai_eje_um.id_ai=".$grupo_ai->fields['id_ai'].") AND (safor_pry_ae_ai_eje_um.id_eje=".$eje."))");
							$grupo_ai_um = $db->Execute($SQL) or die("Error consultando accion interna um");

						while(!$grupo_ai_um->EOF)
							{	
								$pdf->SetFont('Arial','',8);	
								$pdf->SetX(10);$pdf->Cell(20,5,$grupo_ai_um->fields['descripci']);
								$pdf->Ln(); 
								$pdf->SetX(67);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['ene'],0,',','.'),0,0,'R');
								$pdf->SetX(84);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['feb'],0,',','.'),0,0,'R');
								$pdf->SetX(101);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['mar'],0,',','.'),0,0,'R');
								$pdf->SetX(118);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['abr'],0,',','.'),0,0,'R');
								$pdf->SetX(135);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['may'],0,',','.'),0,0,'R');
								$pdf->SetX(152);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['jun'],0,',','.'),0,0,'R');
								$pdf->SetX(169);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['jul'],0,',','.'),0,0,'R');
								$pdf->SetX(186);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['ago'],0,',','.'),0,0,'R');
								$pdf->SetX(203);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['sep'],0,',','.'),0,0,'R');
								$pdf->SetX(219);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['oct'],0,',','.'),0,0,'R');
								$pdf->SetX(236);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['nov'],0,',','.'),0,0,'R');
								$pdf->SetX(252);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['dic'],0,',','.'),0,0,'R');
								$pdf->SetX(266);$pdf->Cell(5,5,number_format($grupo_ai_um->fields['total'],0,',','.'),0,0,'R');
								$pdf->Ln();
							$grupo_ai_um->MoveNext();
							}
						$grupo_ai->MoveNext();
						}
			$grupo_ae -> MoveNext();
			}
$pdf->Ln();$pdf->Ln(); $pdf->Ln();$pdf->Ln(); $pdf->Ln();
$pdf->SetFont('Arial','',9);
$pdf->SetX(2);$pdf->Cell(100,5,'APROBADO POR:____________________________________',0,0,'L');$pdf->Ln();
$pdf->SetX(30);$pdf->Cell(10,10,'JEFE DE LA UNIDAD EJECUTORA',0,0,'L');$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->SetX(50);$pdf->Cell(100,5,'SELLO',0,0,'L');
					
}
	
$pdf->Output("r_eje_ae_ai.pdf","I");

?>