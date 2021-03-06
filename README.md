Fortytwo-Theme
==============

Parent theme for Wordpress based on [Foundation 5 Framework](http://foundation.zurb.com/docs/), lots of improvements glanced here and there on the internet and added to this theme for better bases.

Theme Loops
-----------

The theme offers basic loops :
+ **loop-excerpt.php** : displays a post title, post metas and excerpt
+ **loop-page.php** : classic page display (title & content)
+ **loop-single.php** : classic single post display (title, content, metadata, comments)

Inject Parts
------------

The theme offers two files, offering the possibility to inject things in the header and the footer without interfering with the classic ones :
+ **inject-footer.php**
+ **inject-header.php**

Loaded with
-----------

+ **Favicon**
+ Load **ie.css** for <IE9
+ **html5.js** from google for <IE9
+ Allow **zoom on handeld devices** while keeping the ability to scale to viewport
+ Speed up by sending header first through **flush**

Theme's functions
-----------------
The theme supports those things through its **functions.php** file :
+ Automatic **feed links**
+ Navigation **menus**
+ Post **thumbnails**
+ Ensure **maximum image size** regarding to content width
+ Improve **comment formatting**
+ Google's **rich snippets**
+ Clean the **dashboard** from useless boxes
+ Fix quote marks issues

Template Pages
--------------
**Default pages** included :
+ 404.php
+ tags.php
+ single.php
+ page.php
+ search.php
+ index.php
+ category.php

Security & Speed
--------------
+ No **login error** displayed
+ Remove **auto ping**
+ Set **revisions** to 10 versions.
+ Remove **useless links** from header
+ Remove **version number**


Improvements
------------
+ Allow **HTML in users profiles**
+ Updated users **contact fields**
+ **Autoclean editor** by closing open tags
+ Dynamic **copyright** (called by dynamic_copyright)
+ Fix **notifications**
