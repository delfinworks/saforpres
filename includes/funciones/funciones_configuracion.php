<?php

//funcion para los archivos de configuración 
//la cual permite parametrizar las Constantes de la aplicación

function strip_crlf ($data)
{
	$len = strlen ($data);
	for ($i = 0; $i < $len; ++$i)
	{
		$cc = substr ($data, $i, 1);
		$cc1 = substr ($data, $i + 1, 1);

		if ((ord ($cc) == 10) ||  // caracter igual a una nueva linea
		(ord ($cc) == 13)     // Caracter igual a el retorno de la nueva linea
		)
		{
			$data = substr ($data, 0, $i);
			break;
		}
	}
	return ($data);
}

function getFromQuery ($var)
{
	$query = $_SERVER['QUERY_STRING'];

	$string = $var . "=";

	$idx = strpos ($query, $string);
	if ($idx === false)
	{
		return ("");
	}

	$string = substr ($query, $idx);
	$idx = strpos ($string, "=");
	$string = substr ($string, $idx + 1);
	$idx = strpos ($string, "&");
	if ($idx === false)
	{
	}
	else
	{
		$string = substr ($string, 0, $idx);
	}

	$string = urldecode ($string);

	return ($string);
}

if (strlen ($_POST['action']))
{
	if (!strcmp ($_POST['action'], 'Guardar Cambio'))
	{

		
		$file = $_POST['filename'];
		

		if (!is_writeable ($file))
		{
			$string = "XX:" . $_POST['filename'] . ":" . $_POST['lngdir'] . ":" .
			$file . ":";
?>
                <tr><td colspan=10>><?php echo sprintf("El Archivo esta bloqueado", $string) ?></td></tr>
<?php }
		else
		{	$num_defines = $_POST['num_defines'];
			$idx = 0;
			$string = "start_" . $idx;
			$start_line = $_POST[$string];
			$string = "end_" . $idx;
			$end_line = $_POST[$string];
			$string = "name_" . $idx;
			$name = $_POST[$string];
			$string = "text_" . $idx;
			$text = str_replace("'", "\\'",str_replace("\\", "\\\\", $_POST[$string]));

		

			$temp_fname = tempnam ("", "edit_");
			$fin = fopen ($file, "rb");
			$fout = fopen ($temp_fname, "wb");
			$line_no = 0;
			while (!feof ($fin))
			{
				$line = fgets ($fin);
				$xline = $line;
				$line = strip_crlf ($line);
				$line_no ++;
				if ($start_line == -1 ||
				$line_no < $start_line)
				{
					fwrite ($fout, $xline);
					continue;
				}
				if ($line_no == $end_line)
				{
					
					$string = "define('" . $name . "', ";
					if (strstr($text,"'"))
					{
					
						$text=preg_replace("/^(\s*\\\')/", "'", $text);
						$text=preg_replace("/(\\\'\s*)$/", "'", $text);
						$text=preg_replace("/\s*\.\s*\\\'/", " . '", $text);
						$text=preg_replace("/\\\'\s*\.\s*/", "' . ", $text);
						foreach($forbidden_variables as $forbidden){
							$text=preg_replace("/".$forbidden."/i", "____", $text);
						}
						$string .= $text . ");\n";
					}
					else
					{
						$string .= "'" . $text . "');\n";
					}

					fwrite ($fout, $string); //. "\n");

					// now get the next define

					$idx ++;
					if ($idx >= $num_defines)
					{
						$start_line = -1;
					}
					else
					{
						$string = "start_" . $idx;
						$start_line = $_POST[$string];

						$string = "end_" . $idx;
						$end_line = $_POST[$string];

						$string = "name_" . $idx;
						$name = $_POST[$string];

						$string = "text_" . $idx;
						$text = str_replace("'", "\\'", str_replace("\\", "\\\\", $_POST[$string]));
					}
				}
			}
			fclose ($fin);
			fclose ($fout);
			// salvamos una copia de la configuración original
			$backup = $file . ".bkp";
			if (!@copy ($file, $backup)) echo 'no se creo backup<br>';
			copy ($temp_fname, $file);
			unlink ($temp_fname);
		}
	}
	else if (!strcmp ($_POST['action'], 'Configuración anterior'))
	{
		$backup = $_POST['backup'];
		$file   = $_POST['file'];
		copy ($backup, $file);
	}
}

function process_data ($data)
{
	$data = trim ($data);

	$cc = substr ($data, 0, 1);
	$end = strlen ($data) - 1;
	$cc1 = substr ($data, $end, 1);

	
//chequeamos si el primer caracter o el ultimo es una comilla
	if (!strcmp ($cc, $cc1) &&
	(!strcmp ($cc, '"') ||
	!strcmp ($cc, "'")))
	{
	

		$len = strlen ($data) - 1; 
		for ($i = 1; $i < $len; ++$i)
		{
			$cc1 = substr ($data, $i, 1);
			$cc2 = substr ($data, $i - 1, 1);
			if (!strcmp ($cc, $cc1) &&
			strcmp ($cc2, '\\'))
			{
				// ok no tiene comillas
				// Solo retornamos el valor
				//
				

				return ($data);
			}
		}

		// ok si tiene comillas , las quitamos

		$data = substr ($data, 1, $len - 1);
	}

	return ($data);
}


function readLine ()
{
	global $file_data;

	

	if (feof ($file_data ['handle']))
	{
	

		$file_data ['eof'] = 1;
		return;
	}



	$data = fgets ($file_data ['handle']);



	$len = strlen ($data);
	for ($i = 0; $i < $len; ++$i)
	{
		$cc = substr ($data, $i, 1);
		$cc1 = substr ($data, $i + 1, 1);
		$cc0 = substr ($data, $i - 1, 1);

		if ((ord ($cc) == 10) ||  
		(ord ($cc) == 13) ||  
		(
		($cc  == '/' &&
		$cc1 == '/' &&
		$cc0!=":" 
		)
		)
		)
		{
			$data = substr ($data, 0, $i);
			break;
		}
	}

	

	$file_data ['data'] = $data;
	$file_data ['len']  = strlen ($data);
	$file_data ['idx']  = 0;
	$file_data ['line'] ++;

	if ($file_data['len'] == 0)
	{
	
		return (readLine ());
	}

	return;
}

function getChar ()
{
	global $file_data;

	

	if ($file_data ['idx'] >= $file_data ['len'])
	{
		readLine ();
		if ($file_data ['eof'] == 1)
		return;

	
		$file_data ['eol'] = 1;
	}
	else
	$file_data ['eol'] = 0;

	

	$file_data ['last'] = $file_data ['current'];

	
	if ($file_data ['eol'] == 1)
	$file_data ['last'] = 0;

	$file_data ['current'] = substr ($file_data ['data'],
	$file_data ['idx'], 1);
	$file_data ['idx'] ++;
}
function parseFile ($this_filename)
{
	
	global $file_data;
	global $defines;

	$fh = fopen ($this_filename, "rb");

	$file_data ['handle'] = $fh;
	$file_data ['filename'] = $this_filename;
	$file_data ['line'] = 0;
	$file_data ['eof'] = 0;
	$file_data ['len'] = 0;
	$file_data ['idx'] = 0;
	$file_data ['last'] = 0;

	
	$state [0] = array ( 'string' => "define('",
	'eatall' => 0,
	'data' => '',
	'sidx' => 0);

	
	$state [1] = array ( 'string' => "'",
	'eatall' => 1,
	'data' => '',
	'sidx' => 0);

	
	$state [2] = array ( 'string' => ",",
	'eatall' => 0,
	'data' => '',
	'sidx' => 0);

	
	$state [3] = array ( 'string' => "",
	'eatall' => 0,
	'data' => '',
	'sidx' => 0);

	
	$state [4] = array ( 'string' => "",
	'eatall' => 1,
	'data' => '',
	'sidx' => 0);

	
	$state [5] = array ( 'string' => ";",
	'eatall' => 0,
	'data' => '',
	'sidx' => 0);

	$the_state = 0;
	$num_defines = 0;

	

	while ($file_data ['eof'] == 0)
	{
	

		getChar ();

		$cc = $file_data ['current'];
		$cc1 = $file_data ['last'];

	

		if (!$eatall &&
		($cc == ' ' || $cc == '\t'))
		{
			continue;
		}

		$idx = $state [$the_state]['sidx'];
		$schar = substr ($state [$the_state]['string'], $idx, 1);
		$eatall = $state [$the_state]['eatall'];

	
		if ($the_state == 3)
		{
			if (strcmp ($cc, " ") &&
			strcmp ($cc, "\t"))
			{
	

				$state [$the_state]['sidx'] = 0;
				$the_state ++;

				$in_quote = 0;
				$quote_type = "'";
				$dequoted = 0;

				if (!strcmp ($cc, "'") ||
				!strcmp ($cc, '"'))
				{
					$in_quote = 1;
					$quote_type = $cc;
				}

	

				$state[$the_state]['data'] = $cc;
			}

			continue;
		}

	
		if ($the_state == 4)
		{
			if ($cc == ')' &&
			$cc1 != '\\' &&
			$in_quote == 0)
			{
	

				$state [$the_state]['data'] = process_data (
				$state [$the_state]['data']);

				$state [$the_state]['sidx'] = 0;

				$the_state++;

				continue;
			}

	

			if ($in_quote == 1 &&
			!strcmp ($cc, $quote_type) &&
			strcmp ($cc1, "\\")) 
			{
	

				$dequote = 1;
				$in_quote = 0;

				

				if ($file_data ['eol'] == 1)
				$state [$the_state]['data'] .= "\n";

				

				$state [$the_state]['data'] .= $cc;

				continue;
			}

			// ok are we being quoted

			if ($in_quote == 0 &&
			(!strcmp ($cc, '"') ||
			!strcmp ($cc, "'") ||
			!strcmp ($cc, '('))) 
			
			{
			

				$in_quote = 1;
				$quote_type = $cc;

			

				if (!strcmp ($cc, '('))
				$quote_type = ')';
			}

			

			if ($file_data ['eol'] == 1)
			{
				$state [$the_state]['data'] .= "\n";
			}

			
			$state [$the_state]['data'] .= $cc;
			continue;
		}

		
		if ($eatall == 0)
		{
		
			if (strcmp ($cc, $schar))
			{
		
				for ($i = 0; $i < 7; ++$i)
				{
					$state [$i]['sidx'] = 0;
					$state [$i]['data'] = '';
				}

				$the_state = 0;

				continue;
			}
		}
		else
		{
			if (strcmp ($cc, $schar) ||
			!strcmp ($cc1, '\\'))
			{
		

				if ($file_data ['eol'] == 1)
				$state [$the_state]['data'] .= "\n";
				$state [$the_state]['data'] .= $cc;

				continue;
			}
		}

		

		$len = strlen ($state [$the_state]['string']);
		$sidx = $state [$the_state]['sidx'];
		$sidx ++;
		$state [$the_state]['sidx'] = $sidx;

		

		if ($eatall == 0)
		{
			if ($file_data ['eol'] == 1)
			$state [$the_state]['data'] .= "\n";
			$state [$the_state]['data'] .= $cc;
		}

		

		if ($the_state == 0 && $sidx == 1)
		{
		
			$start_line = $file_data ['line'];
		}

		

		if ($sidx >= $len)
		{
		

			$state [$the_state]['sidx'] = 0;
			$the_state ++;

			if ($the_state == 6)
			{
		

				$end_line = $file_data ['line'];

		

				$this_define =
				array (
				'name'       => $state [1]['data'],
				'data'       => $state [4]['data'],
				'start_line' => $start_line,
				'end_line'   => $end_line);

				

				$defines [$num_defines] = $this_define;
				$num_defines++;

				
				for ($i = 0; $i < 7; ++$i)
				{
					$state [$i]['sidx'] = 0;
					$state [$i]['data'] = '';
				}

				$the_state = 0;
			}
		}
	}

	
	fclose ($file_data ['handle']);
	return $num_defines;
}
parseFile ($file);


?>