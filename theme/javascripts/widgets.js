$(document).ready(function() {
  if($('#twitter')) {
    $.getScript("http://twitter.com/javascripts/blogger.js", function(){
      $.getScript("http://twitter.com/statuses/user_timeline/seekingmichigan.json?callback=twitterCallback2&count=1");
    });
  }
});