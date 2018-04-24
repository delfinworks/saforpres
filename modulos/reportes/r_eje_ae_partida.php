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
		
		$this->SetTextColor(0,0,180);

		$this->Image('../../images/logo.JPG',1,1,33);
    		$this->SetFont('Arial','B',14);
		$this->SetY(6);
		$this->SetX(105);
		$this->Cell(20,0,'Detalle por Ejecutor y Partida');
		$this->SetY(11);
		$this->SetX(115);
		$this->Cell(10,0,'Ejercicio Fiscal 2012');
		
		
		//Fecha	
		$this->SetFont('Arial','I',10);
		$this->SetY(2);
		$this->SetX(190);
		$this->Cell(120,10,$fecha,0,0,'C');
		
		//TITULOS
		$this->SetFillColor(232,232,232);
		$this->SetFont('Arial','B',9);
		$this->SetY(21);$this->SetX(1);
		$this->Cell(30,4,'Acción Específica',0,0,'L',1);
		$this->SetY(25);$this->SetX(1);
		$this->Cell(30,4,'Partida',0,0,'L',1);
		$this->SetY(25);$this->SetX(28);
		$this->Cell(40,4,'Descripción',0,0,'L',1);
		$this->SetY(25);$this->SetX(67);
		$this->Cell(20,4,'Ene.',0,0,'L',1);
		$this->SetY(25);$this->SetX(84);
		$this->Cell(20,4,'Feb.',0,0,'L',1);
		$this->SetY(25);$this->SetX(101);
		$this->Cell(20,4,'Mar.',0,0,'L',1);
		$this->SetY(25);$this->SetX(118);
		$this->Cell(20,4,'Abr.',0,0,'L',1);
		$this->SetY(25);$this->SetX(135);
		$this->Cell(20,4,'May.',0,0,'L',1);
		$this->SetY(25);$this->SetX(152);
		$this->Cell(20,4,'Jun.',0,0,'L',1);
		$this->SetY(25);$this->SetX(169);
		$this->Cell(20,4,'Jul.',0,0,'L',1);
		$this->SetY(25);$this->SetX(186);
		$this->Cell(20,4,'Ago.',0,0,'L',1);
		$this->SetY(25);$this->SetX(203);
		$this->Cell(20,4,'Sep.',0,0,'L',1);
		$this->SetY(25);$this->SetX(219);
		$this->Cell(20,4,'Oct.',0,0,'L',1);
		$this->SetY(25);$this->SetX(236);
		$this->Cell(20,4,'Nov.',0,0,'L',1);
		$this->SetY(25);$this->SetX(252);
		$this->Cell(20,4,'Dic.',0,0,'L',1);
		$this->SetY(25);$this->SetX(266);
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
		$this->Cell(0,10,'FORMULACION DEL PRESUPUESTO 2012 - Oficina de Planificación y Presupuesto');

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
		$grupo_eje = $db->Execute($SQL) or die("Error consultando");
		if (!$grupo_eje ->EOF)
		{	
			$pdf->SetFont('Arial','B',10);
			$pdf->SetY(16);$pdf->SetX(1);$pdf->Cell(40,3,'Unidad Ejecutora: '.$grupo_eje ->fields['descripcion'],0,0,'L');	
			
			$pdf->SetFont('Arial','I',8);
			$SQL = ("SELECT 
						safor_pry_ae_eje_part.id_ae, 
						safor_ae.descripcion
					FROM safor_pry_ae_eje_part INNER JOIN safor_ae ON (safor_pry_ae_eje_part.id_eje = safor_ae.id_eje) AND (safor_pry_ae_eje_part.id_ae = safor_ae.id_ae)
					WHERE (((safor_pry_ae_eje_part.id_eje)=".$eje."))
					GROUP BY safor_pry_ae_eje_part.id_ae, safor_ae.descripcion
					ORDER BY safor_pry_ae_eje_part.id_ae");
			$grupo_ae = $db->Execute($SQL) or die("Error consultando");
			
			
			$pdf->SetY(30);
			$pdf->SetX(1);
			while(!$grupo_ae ->EOF)
			{
			$pdf->SetFont('Arial','',8);
			$pdf->SetX(1);
			$pdf->Cell(275,5,$grupo_ae ->fields['descripcion'],0,0,'L');
			$pdf->Ln();

			$SQL = ("SELECT safor_pry_ae_eje_part.id_partida, 
						Left(safor_puc.descripcion,28) AS descrip,
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
					FROM safor_pry_ae_eje_part INNER JOIN safor_puc ON safor_pry_ae_eje_part.id_partida = safor_puc.id_partida
					WHERE (safor_pry_ae_eje_part.id_ae=".$grupo_ae ->fields['id_ae'].") AND 	
						  (safor_pry_ae_eje_part.id_eje=".$eje.") AND 	
						  (safor_puc.id_eje=".$eje.")
					ORDER BY safor_pry_ae_eje_part.id_partida");
				$grupo_part = $db->Execute($SQL) or die("Error consultando");
		
				while(!$grupo_part->EOF)
				{	
					$pdf->SetFont('Arial','',8);
					$pdf->SetX(6);$pdf->Cell(10,10,$grupo_part->fields['id_partida'],'C');
					$pdf->SetX(25);$pdf->Cell(40,10,$grupo_part->fields['descrip']);

					$pdf->SetX(67);$pdf->Cell(5,10,number_format($grupo_part->fields['ene'],0,',','.'),0,0,'R');
					$pdf->SetX(84);$pdf->Cell(5,10,number_format($grupo_part->fields['feb'],0,',','.'),0,0,'R');
					$pdf->SetX(101);$pdf->Cell(5,10,number_format($grupo_part->fields['mar'],0,',','.'),0,0,'R');
					$pdf->SetX(118);$pdf->Cell(5,10,number_format($grupo_part->fields['abr'],0,',','.'),0,0,'R');
					$pdf->SetX(135);$pdf->Cell(5,10,number_format($grupo_part->fields['may'],0,',','.'),0,0,'R');
					$pdf->SetX(152);$pdf->Cell(5,10,number_format($grupo_part->fields['jun'],0,',','.'),0,0,'R');
					$pdf->SetX(169);$pdf->Cell(5,10,number_format($grupo_part->fields['jul'],0,',','.'),0,0,'R');
					$pdf->SetX(186);$pdf->Cell(5,10,number_format($grupo_part->fields['ago'],0,',','.'),0,0,'R');
					$pdf->SetX(203);$pdf->Cell(5,10,number_format($grupo_part->fields['sep'],0,',','.'),0,0,'R');
					$pdf->SetX(220);$pdf->Cell(5,10,number_format($grupo_part->fields['oct'],0,',','.'),0,0,'R');
					$pdf->SetX(237);$pdf->Cell(5,10,number_format($grupo_part->fields['nov'],0,',','.'),0,0,'R');
					$pdf->SetX(254);$pdf->Cell(5,10,number_format($grupo_part->fields['dic'],0,',','.'),0,0,'R');
					$pdf->SetX(270);$pdf->Cell(5,10,number_format($grupo_part->fields['total'],0,',','.'),0,0,'R');
					$pdf->Ln();


					$grupo_part->MoveNext();
					
				}
					$SQL = ("SELECT 
								Sum(safor_pry_ae_eje_part.total) AS SumaDetotal, 
								Sum(safor_pry_ae_eje_part.ene) AS SumaDeene, 
								Sum(safor_pry_ae_eje_part.feb) AS SumaDefeb, 	
								Sum(safor_pry_ae_eje_part.mar) AS SumaDemar, 
								Sum(safor_pry_ae_eje_part.abr) AS SumaDeabr, 
								Sum(safor_pry_ae_eje_part.may) AS SumaDemay, 
								Sum(safor_pry_ae_eje_part.jun) AS SumaDejun, 
								Sum(safor_pry_ae_eje_part.jul) AS SumaDejul, 
								Sum(safor_pry_ae_eje_part.ago) AS SumaDeago, 
								Sum(safor_pry_ae_eje_part.sep) AS SumaDesep, 
								Sum(safor_pry_ae_eje_part.oct) AS SumaDeoct, 
								Sum(safor_pry_ae_eje_part.nov) AS SumaDenov, 
								Sum(safor_pry_ae_eje_part.dic) AS SumaDedic
							FROM safor_pry_ae_eje_part
							GROUP BY safor_pry_ae_eje_part.id_ae, safor_pry_ae_eje_part.id_eje
							HAVING (safor_pry_ae_eje_part.id_ae=".$grupo_ae ->fields['id_ae'].") AND (safor_pry_ae_eje_part.id_eje=".$eje.")");
					$grupo_ene_part = $db->Execute($SQL) or die("Error consultando");
		
				 	$pdf->SetFont('Arial','B',8);
					if (!$grupo_ene_part->EOF)
					{
						$pdf->SetX(50);$pdf->Cell(5,5,'Total AE: ',0,0,'R');

						$pdf->SetX(67);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDeene'],0,',','.'),0,0,'R');		
						$pdf->SetX(84);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDefeb'],0,',','.'),0,0,'R');		
						$pdf->SetX(101);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDemar'],0,',','.'),0,0,'R');
						$pdf->SetX(118);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDeabr'],0,',','.'),0,0,'R');
						$pdf->SetX(135);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDemay'],0,',','.'),0,0,'R');
						$pdf->SetX(152);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDejun'],0,',','.'),0,0,'R');
						$pdf->SetX(169);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDejul'],0,',','.'),0,0,'R');
						$pdf->SetX(186);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDeago'],0,',','.'),0,0,'R');
						$pdf->SetX(203);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDesep'],0,',','.'),0,0,'R');
						$pdf->SetX(220);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDeoct'],0,',','.'),0,0,'R');
						$pdf->SetX(237);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDenov'],0,',','.'),0,0,'R');
						$pdf->SetX(254);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDedic'],0,',','.'),0,0,'R');
						$pdf->SetX(270);$pdf->Cell(5,5,number_format($grupo_ene_part->fields['SumaDetotal'],0,',','.'),0,0,'R');
						$pdf->Ln();
						$pdf->Ln();
						$pdf->Ln();
					}
			
			$grupo_ae -> MoveNext();
			}
		}
					//TOTAL EJECUTOR
					$SQL = ("SELECT 
								Sum(safor_pry_ae_eje_part.total) AS SumaDetotal, 
								Sum(safor_pry_ae_eje_part.ene) AS SumaDeene, 
								Sum(safor_pry_ae_eje_part.feb) AS SumaDefeb, 
								Sum(safor_pry_ae_eje_part.mar) AS SumaDemar, 
								Sum(safor_pry_ae_eje_part.abr) AS SumaDeabr, 
								Sum(safor_pry_ae_eje_part.may) AS SumaDemay, 
								Sum(safor_pry_ae_eje_part.jun) AS SumaDejun, 
								Sum(safor_pry_ae_eje_part.jul) AS SumaDejul, 
								Sum(safor_pry_ae_eje_part.ago) AS SumaDeago, 
								Sum(safor_pry_ae_eje_part.sep) AS SumaDesep, 
								Sum(safor_pry_ae_eje_part.oct) AS SumaDeoct, 
								Sum(safor_pry_ae_eje_part.nov) AS SumaDenov, 
								Sum(safor_pry_ae_eje_part.dic) AS SumaDedic
							FROM safor_pry_ae_eje_part
							WHERE (safor_pry_ae_eje_part.id_eje=".$eje.")");
					$grupo_totG = $db->Execute($SQL) or die("Error consultando");
		
				 	$pdf->SetFont('Arial','B',8);
					if (!$grupo_totG->EOF)
					{
						$pdf->SetFillColor(232,232,232);

						$pdf->SetX(30);$pdf->Cell(15,5,'Total GENERAL: ',0,0,'L');

						$pdf->SetX(62);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDeene'],0,',','.'),0,0,'L',1);		
						$pdf->SetX(78);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDefeb'],0,',','.'),0,0,'L',1);		
						$pdf->SetX(90);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDemar'],0,',','.'),0,0,'L',1);
						$pdf->SetX(109);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDeabr'],0,',','.'),0,0,'L',1);
						$pdf->SetX(126);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDemay'],0,',','.'),0,0,'L',1);
						$pdf->SetX(143);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDejun'],0,',','.'),0,0,'L',1);
						$pdf->SetX(160);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDejul'],0,',','.'),0,0,'L',1);
						$pdf->SetX(177);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDeago'],0,',','.'),0,0,'L',1);
						$pdf->SetX(194);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDesep'],0,',','.'),0,0,'L',1);
						$pdf->SetX(211);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDeoct'],0,',','.'),0,0,'L',1);
						$pdf->SetX(229);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDenov'],0,',','.'),0,0,'L',1);
						$pdf->SetX(246);$pdf->Cell(20,5,number_format($grupo_totG->fields['SumaDedic'],0,',','.'),0,0,'L',1);
						$pdf->SetX(262);$pdf->Cell(15,5,number_format($grupo_totG->fields['SumaDetotal'],0,',','.'),0,0,'L',1);
						
					}
	
$pdf->Output("r_eje_ae_partida.pdf","I");

?>