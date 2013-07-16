#autoloader
---
##what is this?
This is a autoloader class. Whenever a class is called and that class is not found, this autoloader will include the appropriate file, so you don't have to hassle around with includes

##how to use
Usage is really easy on this. Just include the file and your ready to go

```
include("toolbox/autoloader.php");
```

##Rules / conventions
For this class, it is important, that you follow some rules with your namespaces and where you put your files. Essentially the folders and subfolders must be named exactly the same as the namespace and the file must be named like the class.

For example: If i have the call ``` \lorbeer\lib\filetypes\md::getHtml($file) ``` the autoloader will include the file ``` lorbeer/lib/filetypes/md.php ```