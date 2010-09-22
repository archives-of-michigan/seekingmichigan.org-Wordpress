function swap_options(from, to) {
  var selected_elements = from.find('option:selected')
  var duped_elements = selected_elements.clone();
  selected_elements.remove();
  to.append(duped_elements);
  remove_default_all_collections_criterion();
  add_default_all_collections_criterion();
}

function remove_default_all_collections_criterion() {
  if($('#included_collections option').length > 1)
    $('#included_collections option[value=all]').remove();
}

function add_default_all_collections_criterion() {
  if($('#included_collections option').length == 0)
    $('#included_collections').append('<option value="all"></option>');
}

$(document).ready(function() {
  $('#add_collections').click(function() { swap_options($('#excluded_collections'),$('#included_collections')); });
  $('#remove_collections').click(function() { swap_options($('#included_collections'),$('#excluded_collections')); });
  $('#advanced-search-button').click(function() {
    $('#included_collections option').each(function(index) { this.selected = true; });
  });
  $('#select-all').click(function() {
    $('#excluded_collections option').each(function(index) { this.selected = true; });
    swap_options($('#excluded_collections'),$('#included_collections'));
  });
  $('#clear-all').click(function() {
    $('#included_collections option').each(function(index) { this.selected = true; });
    swap_options($('#included_collections'),$('#excluded_collections'));
  });
  $('.search-type').change(function() {
    death_record_options = $('#death_1, #death_2, #death_3, #death_4, #death_5, #death_6, #death_7, #death_8, #death_9');
    death_record_options.each(function(index, option) {
      if(option.selected) {
        unselected_death_records_option = $('#excluded_collections #option_p129401coll7');
        if(unselected_death_records_option) {
          unselected_death_records_option.get(0).selected = true;
          swap_options($('#excluded_collections'),$('#included_collections'));
        }
      }
    });
    
  });
  $('#excluded_collections, #excluded_collections option').dblclick(function() {
    swap_options($('#excluded_collections'),$('#included_collections'));
  });
  $('#included_collections, #included_collections option').dblclick(function() {
    swap_options($('#included_collections'),$('#excluded_collections'));
  });
});