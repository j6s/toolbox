<?php

/**
* @author Johannes Hertenstein
* @licence GNU / GPL
* feel free to use this in your own project, thats what its for
*
* @see github.com/thephpjo/toolbox
**/


namespace toolbox;

class thumbnail {
	/**
	* @param string $file
	* @param integer $width
	**/
	function createThumb($file,$width = 300){
		// echo "<h1>creating thumb for $file </h1>";
		$cache_dir = $this->cache_dir;
		$filename = str_replace(dirname($file),"",$file);
		$filename = str_replace(".".thumbnail::getFiletype($file),"",$filename);		

		if(!is_dir($cache_dir)){
			mkdir($cache_dir);
		}

		if(!is_dir($cache_dir."thumbs")){
			mkdir($cache_dir."thumbs");
		}

  		$filetype = thumbnail::getFiletype($file);		
		$filehash = md5_file($file);

		$SInamespace = __NAMESPACE__."\\lib\\simpleImage";
		$image = new $SInamespace;
		$image->load($file);

		$image->resizeToWidth($width);

		$image->save($cache_dir."thumbs/".$filename."_thumb_".$filehash.".".$filetype);		
	
	}

	/**
	* @param string $file
	* @param integer $width
	**/
	function getThumb($file, $width = 300){
		$cache_dir = $this->cache_dir;	
		$filename = str_replace(dirname($file),"",$file);
		$filename = str_replace(".".thumbnail::getFiletype($file),"",$filename);		


  		$filetype = thumbnail::getFiletype($file);		
		$filehash = md5_file($file);
		@$expTime = filectime($file) + $this->cache_lifetime;
  		if(file_exists($cache_dir."thumbs/".$filename."_thumb_".$filehash.".".$filetype) && $expTime > time()){
  			// file is valid, do nothing
  		}else{
  			thumbnail::createThumb($file,$width);
  		}

  		return $cache_dir."thumbs/".$filename."_thumb_".$filehash.".".$filetype;
	}

	/**
	* @param string $file
	* @param integer $width
	**/
	function createSquareThumb($file,$width = 300){
		// echo "<h1>creating thumb for $file </h1>";
		$cache_dir = $this->cache_dir;
		$filename = str_replace(dirname($file),"",$file);
		$filename = str_replace(".".thumbnail::getFiletype($file),"",$filename);		

		if(!is_dir($cache_dir)){
			mkdir($cache_dir);
		}

		if(!is_dir($cache_dir."thumbs")){
			mkdir($cache_dir."thumbs");
		}

  		$filetype = thumbnail::getFiletype($file);		
		$filehash = md5_file($file);

		$SInamespace = __NAMESPACE__."\\lib\\simpleImage";
		$image = new $SInamespace;
		$image->load($file);

		$image->square($width);

		$image->save($cache_dir."thumbs/".$filename."_square_".$filehash.".".$filetype);		
	
	}

	/**
	* @param string $file
	* @param integer $width
	**/
	function getSquareThumb($file, $width = 300){
		$cache_dir = $this->cache_dir;	
		$filename = str_replace(dirname($file),"",$file);
		$filename = str_replace(".".thumbnail::getFiletype($file),"",$filename);		


  		$filetype = thumbnail::getFiletype($file);		
		$filehash = md5_file($file);
		@$expTime = filectime($file) + $this->cache_lifetime;
  		if(file_exists($cache_dir."thumbs/".$filename."_square_".$filehash.".".$filetype) && $expTime > time()){
  			// file is valid, do nothing
  		}else{
  			thumbnail::createSquareThumb($file,$width);
  		}

  		return $cache_dir."thumbs/".$filename."_square_".$filehash.".".$filetype;
	}


	function extract($file){
		$cache_dir = $this->cfg->home_dir.$this->cfg->cache_dir;
		$filetype = thumbnail::getFiletype($file);		
		$filehash = md5_file($file);


		if(!file_exists($cache_dir."img/".$filehash.".".$filetype)){
			if(!is_dir($cache_dir)){mkdir($cache_dir);}
			if(!is_dir($cache_dir."img")){mkdir($cache_dir."img");}

			$filestring = file_get_contents($file);

		 	$tmp = fopen($cache_dir."img/".$filehash.".".$filetype,"w");
			fwrite($tmp,$filestring);
			fclose($tmp);
			unset($tmp);
		}

		return $cache_dir."img/".$filehash.".".$filetype;
	}

	function getFiletype($file){
		$tmp= pathinfo($file);
  		$filetype = $tmp["extension"];
  		unset($tmp);

  		return $filetype;
	}






}