<?php
namespace toolbox;

class textcache
{
    private $cache_dir;
    private $cache_lifetime;

    function __construct($cache_dir = "content/cache/", $lifetime = 110592000)
    {
        if(!is_dir($cache_dir)){
            mkdir($cache_dir,0775,true);
        }
        if(!is_dir($cache_dir."/txt")){
            mkdir($cache_dir."/txt");
        }
        if($lifetime < 0){
            $lifetime = 110592000;
        }

        $this->cache_dir = $cache_dir;
        $this->cache_lifetime = $lifetime;
    }

    function exists($hash)
    {
        if(!empty($_GET["no_cache"])){
            error_log("{$hash} no_cache supplied");
            return false;
        }
        $file = $this->cache_dir . "/txt/" . $hash . ".html";
        @$filetime = filemtime($file);
        $cachetime = $filetime + $this->cache_lifetime;

        if (file_exists($file) && $cachetime > time()) {
            $this->log("{$hash} textcache exists");
            return true;
        } else {
            $this->log("{$hash} textcache does not exist");
            return false;
        }
    }

    function create($hash, $content)
    {
        $this->log("{$hash} creating textcache");
        $cache_dir = $this->cache_dir;

        $file = $cache_dir . "/txt/" . $hash . ".html";
        $tmp = fopen($file, "w");
        fwrite($tmp, $content);
        fclose($tmp);
        unset($tmp);
    }

    function read($hash)
    {
        return file_get_contents($this->cache_dir . "/txt/" . $hash . ".html");
    }

    function log($to_log)
    {
        error_log("textcache: ".$to_log);
    }
}