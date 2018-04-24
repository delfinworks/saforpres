<?php class myFunctions extends saja {
################################################################################
# SAJA QUICK REFERENCE
# $this->[rawjs, text, hide, show, send]
#
# $this->rawjs({JavaScript Code});
# $this->text({Content}, {ElementID:Property});
# $this->hide({ElementID});
# $this->show({ElementID});
# $this->send(); //usage: return $this->send();
#
# Add your functions below...
#

function ecco($text){
	return $text;
}

function echoUTF($text){
	$this->text(strlen($text), 'utfPhpLen:value');
	return $text;
}

function echoUTF2($text){
	$this->text(strlen($text), 'utfPhpLen2:value');
	return $text;
}

function countWords($text){
	return strlen($text);
}

function getPageTitle($url){
	$html = @file_get_contents($url);
	if(!$html)
		return 'Sourceforge server could not read that url!';
	
	$matches = array();
	preg_match('/<title>([^<]*)</i', $html, $matches);
	
	$title = $matches[1];
	if(!$title)
		return "No title was found on this page.";
	
	return $title;
}

function doMath($num, $operation, $static, $addOne){
	$addOne = $addOne=='true' ? 1 : 0;
	if($operation == 'mult')
		return $num * $static + $addOne;
	if($operation == 'pow')
		return pow($num, $static) + $addOne;
	if($operation == 'mod')
		return $num % $static + $addOne;
}

function getRand(){
	return rand(1,10);	
}

function merge($a, $b){
	print_r(array_merge($a, $b));	
}

function print_r($ob){
	print_r($ob);
}

function SleepFor1Second(){
	sleep(1);
	$this->hide('sleepButton');
	$this->alert('Slept for 1 second!');
	$this->text('You have already slept! No more sleeping allowed!', 'sleeperOut');
}

function changeStyle($bg, $text){
	if(!$bg){
		$this->js("alert('Please enter a background color.')");
		return $this->send();
	}
	if(!$text)
		return 'Please enter a text color';
			
	if(substr($bg, 0, 1) != '#')
		$bg = '#'.$bg;
	if(substr($text, 0, 1) != '#')
		$text = '#'.$text;
	
	$this->text('', 'bgColor:value');
	$this->text('', 'textColor:value');
	$this->style('myStyles', 'background-color:'.$bg.'; color:'.$text.';');
}

#
#   Keep your functions above this line...
#
################################################################################
} ?>