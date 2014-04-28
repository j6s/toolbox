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

    function __construct($cache_dir){

        if(!is_dir($cache_dir)){
            mkdir($cache_dir);
        }

        if(!is_dir($cache_dir."/thumbs")){
            mkdir($cache_dir."/thumbs");
        }

        if(!is_dir($cache_dir."/img")){
            mkdir($cache_dir."/img");
        }
        $this->cache_dir = $cache_dir;
    }

    function getName($file,$size,$type = "thumb"){
        $filename = str_replace(dirname($file),"",$file);
        $filename = str_replace(".".$this->getFiletype($file),"",$filename);
        $filename = str_replace($this->cache_dir."thumbs/","",$filename);

        $filehash = md5_file($file);
        $filehash == ($file == $filehash) ? "" : "_".$filehash;
        $filetype = $this->getFiletype($file);

        return $this->cache_dir."thumbs/".$filename."_{$type}_{$size}".$filehash.".".$filetype;
    }

    /**
	* @param string $file
	* @param integer $width
	**/
	function createThumb($file,$width = 300){
		// echo "<h1>creating thumb for $file </h1>";
		$cache_dir = $this->cache_dir;

		$SInamespace = __NAMESPACE__."\\lib\\simpleImage";
		$image = new $SInamespace;
		$image->load($file);

		$image->resizeToWidth($width);

		$image->save($this->getName($file,$width,"thumb"));
	}

	/**
	* @param string $file
	* @param integer $width
	**/
	function getThumb($file, $width = 300){
		@$expTime = filectime($file) + $this->cache_lifetime;
        $filename = $this->getName($file,$width,"thumb");

  		if(file_exists($filename) && $expTime > time()){
  			// file is valid, do nothing
  		}else{
            $this->createThumb($file,$width);
  		}

  		return $filename;
	}

	/**
	* @param string $file
	* @param integer $width
	**/
	function createSquareThumb($file,$width = 300){
		$SInamespace = __NAMESPACE__."\\lib\\simpleImage";
		$image = new $SInamespace;
		$image->load($file);

		$image->square($width);

		$image->save($this->getName($file,$width,"square"));
	
	}

	/**
	* @param string $file
	* @param integer $width
	**/
	function getSquareThumb($file, $width = 300){
        $filename = $this->getName($file,$width,"square");

        @$expTime = filectime($file) + $this->cache_lifetime;
  		if(file_exists($filename) && $expTime > time()){
  			// file is valid, do nothing
  		}else{
            $this->createSquareThumb($file,$width);
  		}

  		return $filename;
	}


	function extract($file){
		$cache_dir = $this->cache_dir;
		$filetype = $this->getFiletype($file);
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