Fortytwo-Theme
==============

Parent theme for Wordpress based on Foundation Framework, lots of improvements glanced here and there on the internet and added to this theme for better bases.

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

Header
------

The header sets all the defaults for things such as :
+ **Favicon **
+ **Apple Icon** (iPhone, iPad)
+ **Apple Startup Image** for webapps (iPhone, iPhone Retina, iPad (portrait & paysage), iPad Retina)
+ Enable **webapp mode**
+ **Foundation Framework CSS + Wordpress Rebuild CSS** (avoid problems)
+ Load a **specific css** for <IE9
+ **html5.js** from google for <IE9
+ **Respond** scripts (enabling responsive design on old browsers
+ SEO Optimized **Opengraph Meta** (changing if page of other)
+ Allow **zoom on handeld devices** while keeping the ability to scale to viewport
+ Speed up by sending header first through **flush**

Theme's functions
-----------------
The theme supports those things through its **functions.php** file :
+ Automatic **feed links**
+ Navigation **menus**
+ Post **thumbnails**
+ Inject **opengraph doctype**
+ Ensure **maximum image size** regarding to content width
+ Improve **comment formatting**
+ **Enqueue JS from Google CDN**
+ Load **several scripts** from Nithou CDN (http://assets.nithou.net) : Jquery Reveal / Orbit / Customforms / Placeholder / Tooltips, App.js, off-canvas.js
+ **TGM Activation plugins** : displays a warning to install some plugins (Gravity Forms, WPML, Nithou Plugin, Piwik, Infinite WP Client, Maintenance Mode, Breadcrumb NavXT, Social Bartender)

Included
--------
The parent theme includes **timthumb.php** for on-the-fly image resizing.

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
