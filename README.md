**makebanner** is a PHP console tool to create multi page banners in PDF format

#Instructions
1. Clone this repository
2. Run: _composer update_   ... to install TCPDF and other dependencies
3. Create the 'output' directory, with write permission
4. Run: Usage: _$ php makebanner.php --message='Text for the banner'_
5. Get the PDF in the ./output dir
6. Enjoy!

Also you can make a outline version with _--outline_ option: 

_$ php makebanner.php --message='Text for the banner' --outline_
