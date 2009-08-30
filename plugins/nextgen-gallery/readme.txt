=== NextGEN Gallery ===
Contributors: Alex Rabe
Donate link: http://alexrabe.boelinger.com/donation/
Tags: photos, flash, slideshow, images, gallery, media, admin, post, photo-albums, pictures, widgets, photo, picture
Requires at least: 2.7
Stable tag: trunk

NextGEN Gallery is a full integrated Image Gallery plugin for WordPress with a Flash slideshow option.

== Description ==

NextGEN Gallery is a full integrated Image Gallery plugin for WordPress with a Flash slideshow option. Before I start writing the plugin I study all image and gallery plugins for WordPress,
I figure out that some of them are really good and well designed, but I missed a simple and easy administration back end to handle multiple galleries and albums.

Important Links:

* <a href="http://nextgen.boelinger.com/" title="Demonstration page">Demonstration</a>
* <a href="http://alexrabe.boelinger.com/wordpress-plugins/nextgen-gallery/languages/" title="Translation and Language files">Language files</a>
* <a href="http://alexrabe.boelinger.com/wordpress-plugins/nextgen-gallery/changelog/" title="NextGEN Gallery Changelog">Changelog</a>
* <a href="http://alexrabe.boelinger.com/wordpress-plugins/nextgen-gallery/faq/" title="NextGEN Gallery FAQ">NextGEN Gallery FAQ</a>
* <a href="http://wordpress.org/tags/nextgen-gallery" title="Wordpress Support Forum">Support Forum</a>

= NEW in VERSION 1.0 for WordPress 2.7 =

* Templates : You can add custom templates for your theme. See here for some example
* Media RSS feed : Add the Cooliris Effect to your gallery
* More role settings : Each gallery has now a author
* AJAX based thumbnail generator : No more server limitation during the batch process
* New Shortcodes : You can now insert thumbnails for one or more images (that are not necessarly inside the same gallery).
* Copy/Move : Now you can copy or move images between galleries 

Other features:

* Sortable Albums : Create your own sets of images 
* Upload a Zip-File with pictures : Upload pictures in a zip-file (Not in Safe-mode) 
* Watermark function : You can add a watermark image or text 
* JavaScript Effect : Use any available popular image effect : Shutter, Thickbox, Lightbox or Highslide
* Multiple CSS Stylesheet : Use a nice shadow effect for your thumbnails with your own CSS file 
* Slideshow : Full integrated flash slideshow
* TinyMCE : Button integration for easy adding the gallery tags
* Sidebar Widget : Show a slideshow, random or recent picture at your sidebar 
* Language support : Translated in more than 30 languages
* Upload tab integration : You have access to all pictures via the upload tab
* Tag support for images : Append related images to your post
* Meta data support : Import EXIF, IPTC or XMP meta data 
* Sort images feature
* Cool flash addons here : http://wordpress.org/extend/plugins/nextgen-flashviewer/

== Credits ==

Copyright 2007-2009 Alex Rabe & NextGEN DEV-Team

The NextGEN button is taken from the Fugue Icons of http://www.pinvoke.com/.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

** Please note **

The JW Image Rotator (Slideshow) is not part of this license and is available
under a Creative Commons License, which allowing you to use, modify and redistribute 
them for noncommercial purposes. 

For commercial use please look at the Jeroen's homepage : http://www.longtailvideo.com/


== Installation ==

1. 	Upload the files to wp-content/plugins/nextgen-gallery

2.  If you would like to use a Flash slideshow (only a option), go to <a href="http://www.longtailvideo.com/players/jw-image-rotator/" title="JW Image Rotator">Longtail Video</a>, download the JW Image Rotator and unpack the conent. Upload the file imagerotator.swf to the NextGEN-Gallery folder

3. 	Activate the plugin

4.	Add a gallery and upload some images (the main gallery folder must have write permission)

5. 	Go to your post/page an enter the tag '[nggallery id=x]' or '[slideshow id=x]'.
	See more tags in the FAQ section

That's it ... Have fun

== Screenshots ==

1. Screenshot Admin Area 
2. Screenshot Album Selection
3. Screenshot Shutter Effect
4. Screenshot Watermark function
5. Screenshot Flexible template layout
6. Screenshot Show Exif data

== Frequently Asked Questions ==

**Read as startup :** http://dpotter.net/Technical/index.php/2008/03/04/nextgen-gallery-review-introduction/

When writing a page/post, you can use the follow tags:

For a slideshow : **[slideshow id=x w=width h=height]**

Example : http://nextgen.boelinger.com/slideshow/

For a album : **[album id=x template=extend]** or **[album id=x template=compact]**

Example : http://nextgen.boelinger.com/album/

For a gallery : **[nggallery id=x]**

Example : http://nextgen.boelinger.com/gallery-page/

For a single picture : **[singlepic id=x w=width h=height mode=web20|watermark float=left|right]**

Example : http://nextgen.boelinger.com/singlepic/

For a image browser : **[imagebrowser id=x]**

Example : http://nextgen.boelinger.com/image-browser/

To show image sorted by tags : **[nggtags gallery=mytag,wordpress,... ]**

Example : http://nextgen.boelinger.com/gallery-tags/

To show tag albums : **[nggtags album=mytag,wordpress,... ]**

Example : http://nextgen.boelinger.com/albumtags/

**A further FAQ you can found here :** http://alexrabe.boelinger.com/wordpress-plugins/nextgen-gallery/faq/

**And at least request your question here :** http://alexrabe.boelinger.com/forums/