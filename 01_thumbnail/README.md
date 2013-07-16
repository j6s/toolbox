#Thumbnails
---
##what is it?
This class lets you easily create thumbnails out of your images without being complicated.

##usage
This class only has 1 variable, that you have to be aware of: the cache dir. It defines the location, where your thumbnails should be stored. Here are 2 ways you can set this and then set the cache_dir.

####create an Object
This is the more conventional way you can use this:

```PHP
$thumb = new toolbox\thumbnail;
$thumb->cache_dir = "images/thumbs/";
$pathToThumb = $thumb->getThumb($pathToPicture);
```


####Use it "inline"
I like this one more, since you can use global variables much easier:

```PHP
$this->cache_dir = "images/thumbs/";
$pathToThumb = toolbox\thumbnail::getThumb($pathToPicture);
```














##functions
This comes with 3 main functions:

###getThumb($pathToPicture,$width)
This takes a existing image, checks if a thumbnail if already created and returns the thumbnail Path. If a thumbnail does not exist it will be created. Its width is defined by $width and is set to 300 by default.

```PHP
$pathToThumb = toolbox\thumbnail::getThumb($pathToPicture);
```

###getSquareThumb($pathToPicture,$width)
This essentially does the same as getThumb does, but it creates square thumbs

```PHP
$pathToSquareThumb = toolbox\thumbnail::getSquareThumb($pathToPicture);
```

###extract($pathToPicture)
This only takes the image file as it is and copies it to the cache folder. This seems a little senseless at first glance, but there are occasions, where this can come in handy

(hint: PHP can directly access ZIPs, a browser can not)

##Rules
There are nearly no rules for this one. You can slap your own namespace on it, not problem.
The only rule: the file simpleImage.php has to be in the subdirectory ```lib/``` relative to ```thumbnail.php``