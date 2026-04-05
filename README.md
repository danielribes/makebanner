**makebanner** is a PHP console tool to create multi-page banners in PDF format

I created this small project several years ago to solve a specific need. Over time, it has evolved into a practice ground for updating code and dependencies, primarily keeping the Symfony Console implementation up to date.

However, as seen in the recent commit history, it has lately become an example of how to modernize legacy code using best practices: adding tests to ensure safe refactoring, using mock objects, implementing dependency injection, and adopting type hints and modern PHP features.

Feel free to use it if you need to create multi-page PDF banners, or simply as a reference for code refactoring and maintenance. :)

# Instructions
1. Clone this repository
2. Run: _composer update_   ... to install TCPDF and Symfony Console component
3. Create the output directory called _output_, with write permission
4. Run: 

_$ php makebanner.php --message='Text for the banner'_

5. Get the *banner.pdf* in the ./output dir
6. Enjoy!

Also you can make a outline version with _--outline_ option: 

_$ php makebanner.php --message='Text for the banner' --outline_
