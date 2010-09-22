function COBrowser() {
  this.initialize = function() {
    this.activator().hover(this.on_hover);
    this.box().mouseleave(this.close);
    this.close_button().click(this.close);
  }

  this.on_hover = function(e) {
    var a = $('a#compound_object_pages');
    var win = $('div#compound_object_list');
    var a_pos = a.offset();
    win_left = (a_pos.left - 490);
    win_top = (a_pos.top - 95);
    win.css({ 'left': win_left + 'px', 'top': win_top + 'px' });
    win.fadeIn();
  }

  this.close = function(e) {
    var div = $('div#compound_object_list');
    div.fadeOut();
  }

  this.activator = function() { return $('a#compound_object_pages'); }
  this.box = function() { return $('div#compound_object_list'); }
  this.close_button = function() { return $('#close_button'); }

}

jQuery(document).ready(function($) {
  var cob = new COBrowser();
  cob.initialize();
});

