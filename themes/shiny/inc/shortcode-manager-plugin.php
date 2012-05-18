<?php
header("Content-type: application/x-javascript");
?>
(function() {
        tinymce.create('tinymce.plugins.e404ShortcodeManager', {
                init : function(ed, url) {
                        ed.addCommand('e404ShortcodeManager', function() {
                                ed.windowManager.open({
                                        file : url + '/shortcode-manager-view.php?mce=true',
                                        width : 670,
                                        height : 650,
                                        inline : 1
                                }, {
                                        plugin_url : url
                                });
                        });

                        ed.addButton('e404ShortcodeManager', {
                                title : 'Shortcodes',
                                cmd : 'e404ShortcodeManager',
                                image : url + '/images/shortcodes.png'
                        });

                        ed.onNodeChange.add(function(ed, cm, n) {
                                cm.setActive('e404ShortcodeManager', n.nodeName == 'IMG');
                        });
                },

                createControl : function(n, cm) {
                        return null;
                },

                getInfo : function() {
                        return {
                                longname : 'e404 Shortcode Manager',
                                author : 'e404 Themes',
                                authorurl : 'http://e404themes.com',
                                infourl : 'http://e404themes.com',
                                version : "1.0"
                        };
                }
        });

        tinymce.PluginManager.add('e404ShortcodeManager', tinymce.plugins.e404ShortcodeManager);
})();
