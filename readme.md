Responsible WP theme framework
===
Well, it's not even framework. It's more of and idea, how to organize your theme to be more responsible to server memory and maybe gain some speed at the end.

Usualy, themes and plugins are made, that all it's functions, hooks and filters are loaded on every pageload.
It seems very redundant to me, especially when we have access to functions like is_admin() very early in WP execution. There is no need to load huge plugin files on frontend, if the plugin only make changes in admin...

I'm trying to build some kind of scheme to load only necessary files based on those enviorement functions.

But this is still far from production. Take it more as idea or proof of concept and I will be very glad to hear your feedback about this. Really any idea appreciated.

Maybe I'm overreacting over whole thing, so if you have some knowledge about php memory management and it's speed effects, I will be very glad to hear from you.

Automatic class loading
---
It all begins in functions.php. There is function to load classes from /core directory.
Here comes the important part: Classes are included only when needed based on is_admin() WP function.
This works automatically based on suffix of file name.
There are three types of files in core directory:

 - `.glob.php` files are loaded on every pageload.
 - `.frontend.php` files are loaded only on frontend pages (when is_admin() is false)
 - `.admin.php` files are loaded (suprisingly) only on admin pages

Every file contains one class with same name, which is automaticaly instanciated by autoloading function.
So you can put all your actions into __construct() functions as usual.

Template files (aka. onDemand Singletons)
---
Root files in theme direcotry are ment to only generate output. No advanced functionality shouldn't be there. All more complicated functions shoud go to .template.php files in core directory
Files with suffix `.template.php` are not loaded automaticaly. There are ment to contain functions, which will be needed only on specific pages,
so there is no need to load them on every pageload (admin or frontend).

When you need those functions, you will call `lumi_template('ClassName')` first, which will return reference to the class.
You can than call functions as needed. The example in the source code will probably explain it better than I can.

Classes
---
Probably only pure-php-way thing in this framework are Classes. They are used in very standard php way and are loaded automatically, when needed. Checkout example in Layout.frontend.

All classes are stored in `core/classes` directory in files named as `ClassName.class.php`. All classes are in namespace `Lumi\Classes`. Don't forget to prefix your instanciation with correct namespace or use `use` keyword as in exapmle.

lumi array
---
There is one global array, which contains all references to classes. I like to keep global things to minimum to avoid any possible conflicts.
`$lumi['Frontend']['Layout']` will reference class defined in Layout.frontend.php and so on, you get the point.