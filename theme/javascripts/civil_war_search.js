$(document).ready(function() {
  $('input#s').focus(function() {
    if($('input#s').val() == 'Enter text') {
      $('input#s').val('')
    }
  }
}
