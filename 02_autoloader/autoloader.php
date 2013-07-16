<?php
/**
* @author Johannes Hertenstein
* @licence GNU / GPL
* feel free to use this in your own project, thats what its for
*
* @see github.com/thephpjo/toolbox
**/
namespace toolbox;
/*
* Autoloader
* takes namespace as input
* namespace must equal path to file
* classname must equal filename
*/
class autoloader {
	static function load($name){
		if(!empty($name)){
			// input as namespace with or without leading backslash
			// add leading backslash, when not allready there (this is to bring all the inputs to the same format)
			$name = str_replace("\\\\","\\","\\".$name);

			// delete starting slash
			$name = substr($name,1);
			// delete function name, if given
			// $name = substr($name, 0, strpos($name,"::"));
			$path = str_replace("\\","/",$name);
			include($path.".php");
		}
	}	
}
spl_autoload_register(__NAMESPACE__."\autoloader::load");
?>