$(document).ready(function() {
  $('input#search-text').focus(function() {
    if($('input#search-text').val() == 'Enter text') {
      $('input#search-text').val('')
    }
  })
})
