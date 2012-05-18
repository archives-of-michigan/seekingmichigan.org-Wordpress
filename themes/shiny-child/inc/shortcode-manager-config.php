<?php
$aligns = array('' => 'none', 'left' => 'left', 'right' => 'right', 'center' => 'center');
$button_colors = array('', 'darkgray', 'black', 'red', 'orange', 'brown', 'darkcoffee', 'lemon', 'pear', 'grass', 'turquoise', 'aquamarine', 'ice', 'denim', 'indigo', 'violet', 'fuschia', 'carnationpink', 'frenchrose');
$nivo_effects = array('random', 'sliceDown', 'sliceDownLeft', 'sliceUp', 'sliceUpLeft', 'sliceUpDown', 'sliceUpDownLeft', 'fold', 'fade', 'slideInRight', 'slideInLeft', 'boxRandom', 'boxRain', 'boxRainReverse');

$slideshows = get_terms('e404_slideshow');
$slideshow_options[0] = 'All';
foreach($slideshows as $slideshow)
	$slideshow_options[$slideshow->slug] = $slideshow->name;

$icons = array();
$icons[] = '';
$iterator = new DirectoryIterator(OF_FILEPATH."/images/icons/black/");
foreach($iterator as $fileinfo) {
    if($fileinfo->isFile()) {
        $icons[] = str_replace('.png', '', $fileinfo->getFilename());
    }
}
sort($icons);
unset($iterator);

$icon_types_normal = $icon_types_small = array();
$icon_types_normal[] = '';
$iterator = new DirectoryIterator(OF_FILEPATH."/images/bullets/");
foreach($iterator as $fileinfo) {
    if($fileinfo->isFile()) {
        if(substr($fileinfo->getFilename(), 0, 6) == 'small-') {
            $icon_types_small[] = str_replace('.png', '', $fileinfo->getFilename());
        }
        else {
            $icon_types_normal[] = str_replace('.png', '', $fileinfo->getFilename());
        }
    }
}
sort($icon_types_normal);
sort($icon_types_small);
$icon_types = array_merge($icon_types_normal, $icon_types_small);
unset($iterator);

$image_sizes = array(   '' => 'orginal',
                        'vtiny' => 'vtiny (78 px)',
                        'tiny' => 'tiny (118 px)',
                        'vsmall' => 'vsmall (150 px)',
                        'small' => 'small (198 px)',
                        'medium' => 'medium (278 px)',
                        'large' => 'large (438 px)',
                        'huge' => 'huge (598 px)',
                        'full' => 'full width (918 px)',
                        'blog-full' => 'blog full width (538 px)'
                    );

// shortcodes definitions
$e404_shortcodes = array();

$e404_shortcodes[] = array('title' => '-- Columns --',
                           'disabled' => true,
                           );

$e404_shortcodes[] = array('title' => '2 columns',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[one_half]\nYour content here...\n[/one_half]\n\n[one_half_last]\nYour content here...\n[/one_half_last]\n"
                           );

$e404_shortcodes[] = array('title' => '3 columns',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[one_third]\nYour content here...\n[/one_third]\n\n[one_third]\nYour content here...\n[/one_third]\n\n[one_third_last]\nYour content here...\n[/one_third_last]\n"
                           );

$e404_shortcodes[] = array('title' => '4 columns',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[one_fourth]\nYour content here...\n[/one_fourth]\n\n[one_fourth]\nYour content here...\n[/one_fourth]\n\n[one_fourth]\nYour content here...\n[/one_fourth]\n\n[one_fourth_last]\nYour content here...\n[/one_fourth_last]\n"
                           );

$e404_shortcodes[] = array('title' => '5 columns',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[one_fifth]\nYour content here...\n[/one_fifth]\n\n[one_fifth]\nYour content here...\n[/one_fifth]\n\n[one_fifth]\nYour content here...\n[/one_fifth]\n\n[one_fifth]\nYour content here...\n[/one_fifth]\n\n[one_fifth_last]\nYour content here...\n[/one_fifth_last]\n"
                           );

$e404_shortcodes[] = array('title' => '6 columns',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[one_sixth]\nYour content here...\n[/one_sixth]\n\n[one_sixth]\nYour content here...\n[/one_sixth]\n\n[one_sixth]\nYour content here...\n[/one_sixth]\n\n[one_sixth]\nYour content here...\n[/one_sixth]\n\n[one_sixth]\nYour content here...\n[/one_sixth]\n\n[one_sixth_last]\nYour content here...\n[/one_sixth_last]\n"
                           );

$e404_shortcodes[] = array('title' => '1/3 column + 2/3 column',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[one_third]\nYour content here...\n[/one_third]\n\n[two_third_last]\nYour content here...\n[/two_third_last]\n"
                           );

$e404_shortcodes[] = array('title' => '2/3 column + 1/3 column',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[two_third]\nYour content here...\n[/two_third]\n\n[one_third_last]\nYour content here...\n[/one_third_last]\n"
                           );

$e404_shortcodes[] = array('title' => '1/4 column + 3/4 column',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[one_fourth]\nYour content here...\n[/one_fourth]\n\n[three_fourth_last]\nYour content here...\n[/three_fourth_last]\n"
                           );

$e404_shortcodes[] = array('title' => '3/4 column + 1/4 column',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[three_fourth]\nYour content here...\n[/three_fourth]\n\n[one_fourth_last]\nYour content here...\n[/one_fourth_last]\n"
                           );

$e404_shortcodes[] = array('title' => '-- Shortcodes --',
                           'disabled' => true,
                           );

// [image]
$e404_shortcodes[] = array('title' => 'Image',
                           'options' => array('lightbox' => array('type' => 'checkbox', 'title' => 'Lightbox'),
                                              'group' => array('type' => 'text', 'title' => 'Lightbox group name'),
                                              'shadow' => array('type' => 'checkbox', 'title' => 'Shadow'),
                                              'border' => array('type' => 'checkbox', 'title' => 'Border'),
                                              'title' => array('type' => 'text', 'title' => 'Image title'),
                                              'caption' => array('type' => 'text', 'title' => 'Image caption'),
                                              'href' => array('type' => 'text', 'title' => 'Target URL'),
                                              'size' => array('type' => 'select', 'title' => 'Size', 'values' => $image_sizes),
                                              'align' => array('type' => 'select', 'title' => 'Align', 'values' => $aligns),
                                              'height' => array('type' => 'number', 'title' => 'Height (in pixels)'),
                                              'width' => array('type' => 'number', 'title' => 'Width (in pixels)'),
                                              ),
                           'tag' => 'image',
                           'content' => 'Image URL',
                           );

// [button]
$e404_shortcodes[] = array('title' => 'Button',
                           'options' => array('style' => array('type' => 'select2', 'title' => 'Style', 'values' => array('', 'normal', 'light', 'glass', 'gradient')),
                                              'color' => array('type' => 'select2', 'title' => 'Color variant', 'values' => $button_colors),
                                              'size' => array('type' => 'select2', 'title' => 'Size', 'values' => array('small', 'medium', 'big')),
                                              'width' => array('type' => 'text', 'title' => 'Width (in pixels or percents)'),
                                              'icon' => array('type' => 'icons', 'title' => 'Icon', 'values' => $icon_types_normal, 'icons_dir' => OF_DIRECTORY.'/images/bullets'),
                                              'stroke' => array('type' => 'checkbox', 'title' => 'Stroke'),
                                              'textcolor' => array('type' => 'color', 'title' => 'Custom text color'),
                                              'bgcolor' => array('type' => 'color', 'title' => 'Custom background color'),
                                              'bordercolor' => array('type' => 'color', 'title' => 'Custom border color'),
                                              'href' => array('type' => 'text', 'title' => 'Target URL'),
                                              'target' => array('type' => 'text', 'title' => 'Link target (e.g. _blank)'),
                                              ),
                           'tag' => 'button',
                           'content' => true,
                           'content_placeholder' => "Your text here..."
                           );

// [icon_box]
$e404_shortcodes[] = array('title' => 'Icon Box',
                           'options' => array('title' => array('type' => 'text', 'title' => 'Title'),
                                              'caption' => array('type' => 'text', 'title' => 'Caption'),
                                              'icon' => array('type' => 'icons', 'title' => 'Icon', 'values' => $icons, 'icons_dir' => OF_DIRECTORY.'/images/icons/black', 'height' => 48),
                                              'color' => array('type' => 'select2', 'title' => 'Icons color', 'values' => array('black', 'white')),
                                              'size' => array('type' => 'select2', 'title' => 'Size', 'values' => array('big', 'medium', 'small')),
                                              'transparent' => array('type' => 'checkbox', 'title' => 'Transparency'),
                                              'url' => array('type' => 'text', 'title' => 'Target URL'),
                                              'more_text' => array('type' => 'text', 'title' => '"More" button text'),
                                              ),
                           'tag' => 'icon_box',
                           'content' => true,
                           'content_placeholder' => 'Your text here...',
                           );

// [icon_button]
$e404_shortcodes[] = array('title' => 'Icon Button',
                           'options' => array('title' => array('type' => 'text', 'title' => 'Title'),
                                              'caption' => array('type' => 'text', 'title' => 'Caption'),
                                              'icon' => array('type' => 'icons', 'title' => 'Icon', 'values' => $icons, 'icons_dir' => OF_DIRECTORY.'/images/icons/black', 'height' => 48),
                                              'color' => array('type' => 'select2', 'title' => 'Icons color', 'values' => array('black', 'white')),
                                              'transparent' => array('type' => 'checkbox', 'title' => 'Transparency'),
                                              'url' => array('type' => 'text', 'title' => 'Target URL'),
                                              ),
                           'tag' => 'icon_button',
                           'content' => false,
                           );

// [lightbox]
$e404_shortcodes[] = array('title' => 'LightBox',
                           'options' => array('title' => array('type' => 'text', 'title' => 'LightBox title'),
                                              'group' => array('type' => 'text', 'title' => 'Lightbox group name'),
                                              'height' => array('type' => 'number', 'title' => 'Window height (in pixels)'),
                                              'width' => array('type' => 'number', 'title' => 'Window width (in pixels)'),
                                              'href' => array('type' => 'text', 'title' => 'Target URL'),
                                              'iframe' => array('type' => 'checkbox', 'title' => 'iFrame'),
                                              ),
                           'tag' => 'lightbox',
                           'content' => 'Your text here...',
                           );

// [blockquote]
$e404_shortcodes[] = array('title' => 'Blockquote',
                           'options' => array('author' => array('type' => 'text', 'title' => 'Author'),
                                              'align' => array('type' => 'select', 'title' => 'Align', 'values' => $aligns),
                                              ),
                           'tag' => 'blockquote',
                           'content' => true,
                           'content_placeholder' => 'Your text here...',
                           );

// [tip]
$e404_shortcodes[] = array('title' => 'Tip',
                           'options' => array('title' => array('type' => 'text', 'title' => 'Tip text', 'default' => 'Tip text'),
                                              ),
                           'tag' => 'tip',
                           'content' => true,
                           'content_placeholder' => 'Your text here...',
                           );

// [testimonial]
$e404_shortcodes[] = array('title' => 'Testimonial',
                           'options' => array('image' => array('type' => 'text', 'title' => 'Author image URL'),
                                              'name' => array('type' => 'text', 'title' => 'Author name'),
                                              'info' => array('type' => 'text', 'title' => 'Author info'),
                                              'url' => array('type' => 'text', 'title' => 'Target URL'),
                                              ),
                           'tag' => 'testimonial',
                           'content' => true,
                           'content_placeholder' => 'Your text here...',
                           );

// [person]
$e404_shortcodes[] = array('title' => 'Person',
                           'options' => array('image' => array('type' => 'text', 'title' => 'Author image URL'),
                                              'name' => array('type' => 'text', 'title' => 'Author name'),
                                              'info' => array('type' => 'text', 'title' => 'Author info'),
                                              'url' => array('type' => 'text', 'title' => 'Target URL'),
                                              'twitter' => array('type' => 'text', 'title' => 'Twitter username'),
                                              'linkedin' => array('type' => 'text', 'title' => 'LinkedIn username'),
                                              'facebook' => array('type' => 'text', 'title' => 'Facebook page URL'),
                                              ),
                           'tag' => 'person',
                           'content' => true,
                           'content_placeholder' => 'Your text here...',
                           );

// [line_dotted]
$e404_shortcodes[] = array('title' => 'Line (dotted)',
                           'options' => array(),
                           'tag' => 'line_dotted',
                           'content' => false,
                           );

// [line_top]
$e404_shortcodes[] = array('title' => 'Line with the Top link',
                           'options' => array(),
                           'tag' => 'line_top',
                           'content' => false,
                           );

// [line]
$e404_shortcodes[] = array('title' => 'Line',
                           'options' => array(),
                           'tag' => 'line',
                           'content' => false,
                           );

// [dropcap]
$e404_shortcodes[] = array('title' => 'Dropcap',
                           'options' => array('style' => array('type' => 'select', 'title' => 'Style', 'values' => array(
                                                                                                                         '1' => 'Style 1',
                                                                                                                         '2' => 'Style 2',
                                                                                                                         '3' => 'Style 3',
                                                                                                                         '4' => 'Style 4',
                                                                                                                         '5' => 'Style 5',
                                                                                                                         '6' => 'Style 6',
                                                                                                                         '7' => 'Style 7',
                                                                                                                         '8' => 'Style 8',
                                                                                                                         '9' => 'Style 9',
                                                                                                                         '10' => 'Style 10',
                                                                                                                       )),
                                              'color' => array('type' => 'color', 'title' => 'Color'),
                                              ),
                           'tag' => 'dropcap',
                           'content' => 'Dropcap letter/number',
                           );

// [list]
$e404_shortcodes[] = array('title' => 'List',
                           'options' => array('type' => array('type' => 'icons', 'title' => 'List style', 'values' => $icon_types, 'icons_dir' => OF_DIRECTORY.'/images/bullets'),
                                              ),
                           'tag' => 'list',
                           'content' => true,
                           'content_placeholder' => "\n[li]First line[/li]\n[li]Second line[/li]\n[li]Third line[/li]\n"
                           );

// [link]
$e404_shortcodes[] = array('title' => 'Link with icon',
                           'options' => array('type' => array('type' => 'icons', 'title' => 'List style', 'values' => $icon_types, 'icons_dir' => OF_DIRECTORY.'/images/bullets'),
                                              'href' => array('type' => 'text', 'title' => 'Target URL'),
                                              'target' => array('type' => 'text', 'title' => 'Link target (e.g. _blank)'),
                                              ),
                           'tag' => 'link',
                           'content' => true,
                           'content_placeholder' => "Your text here..."
                           );

// [span]
$e404_shortcodes[] = array('title' => 'Text with icon',
                           'options' => array('type' => array('type' => 'icons', 'title' => 'List style', 'values' => $icon_types, 'icons_dir' => OF_DIRECTORY.'/images/bullets'),
                                              ),
                           'tag' => 'span',
                           'content' => true,
                           'content_placeholder' => "Your text here..."
                           );

// [message]
$e404_shortcodes[] = array('title' => 'Text message',
                           'options' => array('type' => array('type' => 'select2', 'title' => 'List style', 'values' => array('info', 'tip', 'note', 'error')),
                                              ),
                           'tag' => 'message',
                           'content' => true,
                           'content_placeholder' => "Your text here..."
                           );

// [accordions]
$e404_shortcodes[] = array('title' => 'Accordions',
                           'options' => array('style' => array('type' => 'select2', 'title' => 'Accordions style', 'values' => array('dark', 'medium', 'light')),
                                              ),
                           'tag' => 'accordions',
                           'content' => true,
                           'content_placeholder' => "\n[accordion title='First element title' bgcolor='' color='' bordercolor='' header_bgcolor='' header_color='' header_bordercolor='']\nYour text here...\n[/accordion]\n[accordion title='Second element title' bgcolor='' color='' bordercolor='' header_bgcolor='' header_color='' header_bordercolor='']\nYour text here...\n[/accordion]\n[accordion title='Third element title' bgcolor='' color='' bordercolor='' header_bgcolor='' header_color='' header_bordercolor='']\nYour text here...\n[/accordion]\n",
                           );

// [toggle]
$e404_shortcodes[] = array('title' => 'Toggle',
                           'options' => array('style' => array('type' => 'select2', 'title' => 'Accordions style', 'values' => array('light', 'medium', 'dark')),
                                              'title' => array('type' => 'text', 'title' => 'Title'),
                                              'color' => array('type' => 'color', 'title' => 'Text color'),
                                              'bgcolor' => array('type' => 'color', 'title' => 'Background color'),
                                              'header_color' => array('type' => 'color', 'title' => 'Header text color'),
                                              'header_bgcolor' => array('type' => 'color', 'title' => 'Header background color'),
                                              'header_bordercolor' => array('type' => 'color', 'title' => 'Header border color'),
                                              ),
                           'tag' => 'toggle',
                           'content' => true,
                           'content_placeholder' => 'Your text here...',
                           );

// [box]
$e404_shortcodes[] = array('title' => 'Text Box',
                           'options' => array('style' => array('type' => 'select2', 'title' => 'Style', 'values' => array('light', 'medium', 'dark')),
                                              'title' => array('type' => 'text', 'title' => 'Title'),
                                              'color' => array('type' => 'color', 'title' => 'Text color'),
                                              'bgcolor' => array('type' => 'color', 'title' => 'Background color'),
                                              'header_color' => array('type' => 'color', 'title' => 'Header text color'),
                                              'header_bgcolor' => array('type' => 'color', 'title' => 'Header background color'),
                                              'header_bordercolor' => array('type' => 'color', 'title' => 'Header border color'),
                                              'rounded' => array('type' => 'checkbox', 'title' => 'Rounded corners'),
                                              ),
                           'tag' => 'box',
                           'content' => true,
                           'content_placeholder' => 'Your text here...',
                           );

// [tabs]
$e404_shortcodes[] = array('title' => 'Tabs',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[tabs tabs='Tab 1,Tab 2,Tab3']\n[tab]\nYour tab 1 content here...\n[/tab]\n\n[tab]\nYour tab 2 content here...\n[/tab]\n\n[tab]\nYour tab 3 content here...\n[/tab]\n[/tabs]\n"
                           );

// [table]
$e404_shortcodes[] = array('title' => 'Table',
                           'options' => array('style' => array('type' => 'select2', 'title' => 'Style', 'values' => array('light', 'medium', 'dark')),
                                              'align' => array('type' => 'select', 'title' => 'Align', 'values' => $aligns),
                                              'width' => array('type' => 'number', 'title' => 'Width (px)'),
                                              'border' => array('type' => 'checkbox', 'title' => 'Border'),
                                              'highlight' => array('type' => 'checkbox', 'title' => 'Row highlighting'),
                                              ),
                           'tag' => 'table',
                           'content' => true,
                           'content_placeholder' => "\n[thead]\n[tr]\n[th align='']Title 1[/th]\n[th align='']Title 2[/th]\n[th align='']Title 3[/th]\n[th align='']Title 4[/th]\n[/tr]\n[/thead]\n\n[tbody]\n[tr]\n[th align='']Row 1[/th]\n[td align='']Row 1 Cell 2[/td]\n[td align='']Row 1 Cell 3[/td]\n[td align='']Row 1 Cell 4[/td]\n[/tr]\n\n[tr]\n[th align='']Row 2[/th]\n[td align='']Row 2 Cell 2[/td]\n[td align='']Row 2 Cell 3[/td]\n[td align='']Row 2 Cell 4[/td]\n[/tr]\n[/tbody]\n",
                           );

// [pricebox]
$e404_shortcodes[] = array('title' => 'Pricebox',
                           'options' => array(),
                           'content' => true,
                           'tag' => '',
                           'code' => "[one_third]\n[pricebox title='Max']\n[pricebox_price price='$18' period='month']\n[pricebox_body]\n[b]35[/b] projects\n[b]15 GB[/b] storage\n[b]Unlimited[/b] users\n[/pricebox_body]\n[pricebox_footer]\n[button style='gradient' stroke='true']Buy now[/button]\n[/pricebox_footer]\n[/pricebox]\n[/one_third]\n
[one_third]\n[pricebox title='Premium' featured='true']\n[pricebox_price price='$24' period='month']\n[pricebox_body]\n[b]100[/b] projects\n[b]30 GB[/b] storage\n[b]Unlimited[/b] users\n[/pricebox_body]\n[pricebox_footer]\n[button style='gradient' color='darkgray' size='big' stroke='true']Buy now[/button]\n[/pricebox_footer]\n[/pricebox]\n[/one_third]\n
[one_third_last]\n[pricebox title='Plus']\n[pricebox_price price='$28' period='month']\n[pricebox_body]\n[b]Unlimited[/b] projects\n[b]75 GB[/b] storage\n[b]Unlimited[/b] users\n[/pricebox_body]\n[pricebox_footer]\n[button style='gradient'stroke='true']Buy now[/button]\n[/pricebox_footer]\n[/pricebox]\n[/one_third_last]\n"
                           );

// [recent_posts]
$e404_shortcodes[] = array('title' => 'Recent blog posts',
                           'options' => array('thumbs' => array('type' => 'checkbox', 'title' => 'Show thumbnails'),
                                              'number' => array('type' => 'number', 'title' => 'Number of posts'),
                                              'title' => array('type' => 'text', 'title' => 'Title'),
                                              'limit' => array('type' => 'number', 'title' => 'Number of excerpt characters to display'),
                                              'categories' => array('type' => 'text', 'title' => 'Categories to display (comma separated slugs)'),
                                              ),
                           'tag' => 'recent_posts',
                           'content' => false,
                           );

// [popular_posts]
$e404_shortcodes[] = array('title' => 'Popular blog posts',
                           'options' => array('thumbs' => array('type' => 'checkbox', 'title' => 'Show thumbnails'),
                                              'number' => array('type' => 'number', 'title' => 'Number of posts'),
                                              'title' => array('type' => 'text', 'title' => 'Title'),
                                              'limit' => array('type' => 'number', 'title' => 'Number of excerpt characters to display'),
                                              'categories' => array('type' => 'text', 'title' => 'Categories to display (comma separated slugs)'),
                                              ),
                           'tag' => 'popular_posts',
                           'content' => false,
                           );

// [recent_posts_images]
$e404_shortcodes[] = array('title' => 'Recent blog posts with thumbnails',
                           'options' => array('number' => array('type' => 'number', 'title' => 'Number of posts'),
                                              'title' => array('type' => 'text', 'title' => 'Title'),
                                              'more_text' => array('type' => 'text', 'title' => '"Read more" button text'),
                                              'categories' => array('type' => 'text', 'title' => 'Categories to display (comma separated slugs)'),
                                              ),
                           'tag' => 'recent_posts_images',
                           'content' => false,
                           );

// [popular_posts_images]
$e404_shortcodes[] = array('title' => 'Popular blog posts with thumbnails',
                           'options' => array('number' => array('type' => 'number', 'title' => 'Number of posts'),
                                              'title' => array('type' => 'text', 'title' => 'Title'),
                                              'more_text' => array('type' => 'text', 'title' => '"Read more" button text'),
                                              'categories' => array('type' => 'text', 'title' => 'Categories to display (comma separated slugs)'),
                                              ),
                           'tag' => 'popular_posts_images',
                           'content' => false,
                           );

// [recent_posts_images_full]
$e404_shortcodes[] = array('title' => 'Recent blog posts with thumbnails (full width)',
                           'options' => array('title' => array('type' => 'text', 'title' => 'Title'),
                                              'url' => array('type' => 'text', 'title' => '"View all" link URL'),
                                              'more_text' => array('type' => 'text', 'title' => '"View all" link text'),
                                              'description' => array('type' => 'text', 'title' => 'Description'),
                                              'categories' => array('type' => 'text', 'title' => 'Categories to display (comma separated slugs)'),
                                              ),
                           'tag' => 'recent_posts_images_full',
                           'content' => false,
                           );

// [recent_posts_images_scrollable]
$e404_shortcodes[] = array('title' => 'Scrollable recent blog posts (full width)',
                           'options' => array('title' => array('type' => 'text', 'title' => 'Title'),
                                              'url' => array('type' => 'text', 'title' => '"View all" link URL'),
                                              'more_text' => array('type' => 'text', 'title' => '"View all" link text'),
                                              'works' => array('type' => 'text', 'title' => 'Number of items'),
                                              ),
                           'tag' => 'recent_posts_images_scrolable',
                           'content' => false,
                           );

// [recent_comments]
$e404_shortcodes[] = array('title' => 'Recent blog comments',
                           'options' => array('number' => array('type' => 'number', 'title' => 'Number of posts'),
                                              'title' => array('type' => 'text', 'title' => 'Title'),
                                              ),
                           'tag' => 'recent_comments',
                           'content' => false,
                           );

// [recent_works_images_full]
$e404_shortcodes[] = array('title' => 'Recent portfolio items with thumbnails (full width)',
                           'options' => array('title' => array('type' => 'text', 'title' => 'Title'),
                                              'url' => array('type' => 'text', 'title' => '"View all" link URL'),
                                              'more_text' => array('type' => 'text', 'title' => '"View all" link text'),
                                              'description' => array('type' => 'text', 'title' => 'Description'),
                                              ),
                           'tag' => 'recent_works_images_full',
                           'content' => false,
                           );

// [recent_works_images_scrollable]
$e404_shortcodes[] = array('title' => 'Scrollable recent portfolio items (full width)',
                           'options' => array('title' => array('type' => 'text', 'title' => 'Title'),
                                              'url' => array('type' => 'text', 'title' => '"View all" link URL'),
                                              'more_text' => array('type' => 'text', 'title' => '"View all" link text'),
                                              'works' => array('type' => 'text', 'title' => 'Number of items'),
                                              ),
                           'tag' => 'recent_works_images_scrolable',
                           'content' => false,
                           );

// [nivo]
$e404_shortcodes[] = array('title' => 'Nivo slider (images from a slideshow)',
                           'options' => array('width' => array('type' => 'number', 'title' => 'Width (px)'),
                                              'height' => array('type' => 'number', 'title' => 'Height (px)'),
                                              'effect' => array('type' => 'select2', 'title' => 'Transition effect', 'values' => $nivo_effects),
                                              'slideshow' => array('type' => 'select', 'title' => 'Slideshow to display', 'values' => $slideshow_options, 'default' => '0'),
                                              'buttons' => array('type' => 'checkbox', 'title' => 'Show buttons'),
                                              'bubbles' => array('type' => 'checkbox', 'title' => 'Show bubbles'),
                                              'pause' => array('type' => 'number', 'title' => 'Pause between photos (ms)'),
                                              ),
                           'tag' => 'nivo',
                           'content' => false
                           );

// [nivo_images]
$e404_shortcodes[] = array('title' => 'Nivo slider (custom images)',
                           'options' => array('width' => array('type' => 'number', 'title' => 'Width (px)'),
                                              'height' => array('type' => 'number', 'title' => 'Height (px)'),
                                              'effect' => array('type' => 'select2', 'title' => 'Transition effect', 'values' => $nivo_effects),
                                              'buttons' => array('type' => 'checkbox', 'title' => 'Show buttons'),
                                              'bubbles' => array('type' => 'checkbox', 'title' => 'Show bubbles'),
                                              'pause' => array('type' => 'number', 'title' => 'Pause between photos (ms)'),
                                              ),
                           'tag' => 'nivo_images',
                           'content' => true,
                           'content_placeholder' => "\nhttp://yourdomain.com/images/image1.jpg;Image 1 title\nhttp://yourdomain.com/images/image2.jpg;Image 2 title\nhttp://yourdomain.com/images/image3.jpg;Image 3 title\nhttp://yourdomain.com/images/image4.jpg;Image 4 title\n"
                           );

// [galleria]
$e404_shortcodes[] = array('title' => 'Galleria gallery (images from post/page)',
                           'options' => array('width' => array('type' => 'number', 'title' => 'Width (px)'),
                                              'height' => array('type' => 'number', 'title' => 'Height (px)'),
                                              'bgcolor' => array('type' => 'color', 'title' => 'Background color'),
                                              'thumbnails' => array('type' => 'checkbox', 'title' => 'Show thumbnails'),
                                              'slideshow' => array('type' => 'checkbox', 'title' => 'Slideshow'),
                                              'speed' => array('type' => 'number', 'title' => 'Pause between photos (ms)'),
                                              ),
                           'tag' => 'galleria',
                           'content' => false
                           );

// [galleria_images]
$e404_shortcodes[] = array('title' => 'Galleria gallery (custom images)',
                           'options' => array('width' => array('type' => 'number', 'title' => 'Width (px)'),
                                              'height' => array('type' => 'number', 'title' => 'Height (px)'),
                                              'bgcolor' => array('type' => 'color', 'title' => 'Background color'),
                                              'thumbnails' => array('type' => 'checkbox', 'title' => 'Show thumbnails'),
                                              'slideshow' => array('type' => 'checkbox', 'title' => 'Slideshow'),
                                              'speed' => array('type' => 'number', 'title' => 'Pause between photos (ms)'),
                                              ),
                           'tag' => 'galleria_images',
                           'content' => true,
                           'content_placeholder' => "\nhttp://yourdomain.com/images/image1.jpg;Image 1 title\nhttp://yourdomain.com/images/image2.jpg;Image 2 title\nhttp://yourdomain.com/images/image3.jpg;Image 3 title\nhttp://yourdomain.com/images/image4.jpg;Image 4 title\n"
                           );

// [scrollable]
$e404_shortcodes[] = array('title' => 'Scrollable gallery (custom images)',
                           'options' => array('title' => array('type' => 'text', 'title' => 'Gallery title'),
                                              'height' => array('type' => 'number', 'title' => 'Images height (px)'),
                                              'images' => array('type' => 'number', 'title' => 'Number of images per page'),
                                              ),
                           'tag' => 'scrollable',
                           'content' => true,
                           'content_placeholder' => "\nhttp://yourdomain.com/images/image1.jpg;Image 1 title\nhttp://yourdomain.com/images/image2.jpg;Image 2 title\nhttp://yourdomain.com/images/image3.jpg;Image 3 title\nhttp://yourdomain.com/images/image4.jpg;Image 4 title\n"
                           );

// [tweet]
$e404_shortcodes[] = array('title' => 'Tweet',
                           'options' => array('username' => array('type' => 'text', 'title' => 'Twitter username'),
                                              ),
                           'tag' => 'tweet',
                           'content' => false,
                           );

// [tweets]
$e404_shortcodes[] = array('title' => 'Tweets',
                           'options' => array('username' => array('type' => 'text', 'title' => 'Twitter username'),
                                              'number' => array('type' => 'number', 'title' => 'Number of tweets'),
                                              'time' => array('type' => 'checkbox', 'title' => 'Show time'),
                                              ),
                           'tag' => 'tweets',
                           'content' => false,
                           );

// [map]
$e404_shortcodes[] = array('title' => 'Map',
                           'options' => array('width' => array('type' => 'number', 'title' => 'Width (px)'),
                                              'height' => array('type' => 'number', 'title' => 'Height (px)'),
                                              ),
                           'tag' => 'map',
                           'content' => 'Map URL',
                           'content_placeholder' => 'http://maps.google.com.au/maps?q=Envato,+Bourke+Street,+Melbourne,+Victoria&ll=-37.818124,144.966574&spn=0.012188,0.027874&sll=-25.344026,135.74707&sspn=7.135617,14.27124&vpsrc=6&t=m&z=16'
                           );

$e404_shortcodes[] = array('title' => '-- Video --',
                           'disabled' => true,
                           );

// [youtube]
$e404_shortcodes[] = array('title' => 'YouTube Video',
                           'options' => array('id' => array('type' => 'text', 'title' => 'Video ID'),
                                              'width' => array('type' => 'number', 'title' => 'Width (px)'),
                                              'height' => array('type' => 'number', 'title' => 'Height (px)'),
                                              ),
                           'tag' => 'youtube',
                           'content' => false,
                           );

// [vimeo]
$e404_shortcodes[] = array('title' => 'Vimeo Video',
                           'options' => array('id' => array('type' => 'text', 'title' => 'Video ID'),
                                              'width' => array('type' => 'number', 'title' => 'Width (px)'),
                                              'height' => array('type' => 'number', 'title' => 'Height (px)'),
                                              ),
                           'tag' => 'vimeo',
                           'content' => false,
                           );

// [dailymotion]
$e404_shortcodes[] = array('title' => 'DailyMotion Video',
                           'options' => array('id' => array('type' => 'text', 'title' => 'Video ID'),
                                              'width' => array('type' => 'number', 'title' => 'Width (px)'),
                                              'height' => array('type' => 'number', 'title' => 'Height (px)'),
                                              ),
                           'tag' => 'dailymotion',
                           'content' => false,
                           );

// [video]
$e404_shortcodes[] = array('title' => 'Self-hosted Video',
                           'options' => array('width' => array('type' => 'number', 'title' => 'Width (px)'),
                                              'height' => array('type' => 'number', 'title' => 'Height (px)'),
                                              'title' => array('type' => 'text', 'title' => 'Title'),
                                              'poster' => array('type' => 'text', 'title' => 'Poster image URL'),
                                              'source' => array('type' => 'text', 'title' => 'Video file URL'),
                                              'controls' => array('type' => 'checkbox', 'title' => 'Show controls'),
                                              ),
                           'tag' => 'video',
                           'content' => false,
                           );

?>