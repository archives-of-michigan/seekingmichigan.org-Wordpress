function events_fetch_calendar() {
  var year = $('#calendar_year').val();
  var month = $('#calendar_month').val();
  $.ajax({
    url: '/event_manager/categories/Civil%20war/calendars/' + year + '/' + month,
    success: function(data) {
      $('#calendar_container').html(data);
      bind_events();
    }
  });
}

function bind_events() {
  $('#calendar_year, #calendar_month').change(function() {
    events_fetch_calendar();
  });
}

$(document).ready(function() {
  bind_events();
});
