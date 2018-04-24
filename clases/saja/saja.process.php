<?php	
//let browser know that response is utf-8 encoded
header('Content-Type: text/html; charset=utf-8');

//initialize vars
$php = null;
$proc_file = null;
$function = null;
$session_id = null;
$request_id = null;
$true_utf8 = null;
$proc_class= null;
$errors = '';
$req = $_POST['req'];

if(!$req){
	$errors .= 'Empty Request';
}

if(!$errors){
	//start session and set ID to the expected saja session
	list($php, $session_id, $request_id) = explode('<!SAJA!>', $req);
	if($session_id)
		session_id($session_id);
	session_start();
	
	//validate this request
	if(!is_array($_SESSION['SAJA_PROCESS']['REQUESTS']))
		$errors .=  'Invalid Request!';
	else if(!in_array($request_id, array_keys($_SESSION['SAJA_PROCESS']['REQUESTS'])))
		$errors .= 'Invalid Request.';
}

//start capturing the response
ob_start();

if(!$errors) {

	//get function name and process file
	$REQ = $_SESSION['SAJA_PROCESS']['REQUESTS'][$request_id];
	$proc_file = $REQ['PROCESS_FILE'];
	$function = $REQ['FUNCTION'];
	//$use_history = $REQ['HISTORY'];
	$true_utf8 = $REQ['UTF8'];
	//--Modification: adding a variable for de process class--//
	$proc_class =$REQ['CLASS'];
	//------------------------------------//
	//add this request to the history
	//if($use_history)
	//	$_SESSION['SAJA_PROCESS']['HISTORY'][] = $_SESSION['SAJA_PROCESS']['REQUESTS'][$request_id]['HISTORY'];
	
	//load the saja core library
	require('saja.php');	

	
	
	//load the class extension containing the user functions
	if(file_exists($proc_file))
		require($proc_file);
	else
		echo  'Process file: ' . $proc_file . ' not found.';
	
	/*
	*Original code
	execute the requested function
	$s = new myFunctions();
	$s->set_true_utf8($true_utf8);
	$s->runFunc($function, $php);
	if($s->hasActions())
		echo $s->send();
    */

	//--Modify code--//
	$s=new $proc_class;
	$s->set_true_utf8($true_utf8);
	$s->runFunc($function, $php);
	if($s->hasActions())
	echo $s->send();
	//-------------------//	
	
} else {
	echo $errors;
}

//capture the response and output as utf-8 encoded
$content = ob_get_contents();
ob_end_clean();

if($s->true_utf8)
	echo $content;
else
	echo utf8_encode($content);
?>