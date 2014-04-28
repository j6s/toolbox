<?php
namespace toolbox;

class textcache{
	function __construct($cache_dir,$lifetime){
		$this->cache_dir = $cache_dir;
		$this->cache_lifetime = $lifetime;
	}
	function exists($hash){
		if(!empty($this->cache_dir)){
			$cache_dir = $this->cache_dir;
		} else {
			$cache_dir = "content/cache/";
		}

		if(!empty($this->cache_lifetime)){
			$lifetime = $this->cache_lifetime;
		} else {
			$lifetime = 110592000; //5 years lifetime
		}

		$file = $cache_dir."txt/".$hash.".html";
		@$filetime = filemtime($file);
		$cachetime = $filetime + $lifetime;

		if(file_exists($file) && $cachetime > time())
			{return true;echo "<h1>textcashe exists</h1>";}
		else
			{return false;echo "<h1>textcashe does no exist</h1>";}
	}

	function create($hash,$content){
		$cache_dir = "content/cache/";

		if(!is_dir($cache_dir)){
			mkdir($cache_dir);
		}
		if(!is_dir($cache_dir."txt")){
			mkdir($cache_dir."txt");
		}

		$file = $cache_dir."txt/".$hash.".html";
		$tmp = fopen($file,"w");
		fwrite($tmp,$content);
		fclose($tmp);
		unset($tmp);
	}

	function read($hash){
		return file_get_contents("content/cache/txt/".$hash.".html");
	}
}