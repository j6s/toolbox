#Toolbox
---

## What is this?
Here you can find my personal collection of PHP libraries for many different things. They mostly are standalone and you can slap any namespace on it, that you want.

## Things you'll find here

### \thephpjo\toolbox\textcache
Simple caching solution for HTML & Text files. Mainly to compensate proccessing time of conversion scripts: Only convert the thing, if it was changed

__usage:__
```PHP
// the directory, where the cache is located, make shure you have write permissions here
$cache_dir = "content/cache/";

// the lifetime of your cache in seconds. In this example: 3 days
$lifetime = 60*60*24*3;

// In this example we want to parse a ODT file. Of course this is dependent on what you want to do. No matter what: we need a hash, that will be the filename of the cachefile (we don't care about hash-collisions)
// In this example i am using the file hash of the file. This is recommended for this kind of operations cause it will automatically update, when you change the file
$file = "test/123.odt";
$hash = md5_file($file);

$textcache = new \toolbox\textcache($cache_dir,$lifetime);

// se if the file are cached
if($textcache->exists($hash)){
    // if the cache exists, just read it
    $out = $textcache->read($hash);
} else {
    // if the cache does not exist or is to old, then create the content
    $out = \parser\ODTParserclass::parse($file);

    // and write it into a cache
    $textcache->create($hash,$out)
}
echo $out
```


### \thephpjo\toolbox\thumbnail
Simple thumbnail generation: Deliver your user a scaled down version of what you upload

__usage:__
```PHP
// the parameter is the caching folder
$thumb = new \thephpjo\toolbox\thumbnail("images/thumbs/");

// This will generate a Thumbnail with 512px width (if not already existant)
$thumbPath = $thumb->getThumb($bigPicturePath,512);

// generates a 250x250 cropped square of the image
$squareThumbPath = $thumb->getSquareThumb($bigPicture,250);
```

### \thephpjo\toolbox\autoloader
Small autoloader, that loads classes, if the folder structure of your project represents your namespaces. But you should not really use this, use the autoloader of your framework or at least the one of composer