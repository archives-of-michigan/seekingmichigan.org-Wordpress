Feature: URL Compressor
  In order to easily share URLs to collection items with others
  As an user
  I want to visit a link using a compressed URL
 
  Scenario: Browse to the home page
    When I go to http://seekingmichigan.org/u?/p129401coll0,3156
    Then I should be redirected to "http://haldigitalcollections.cdmhost.com/seeking_michigan/discover_item_viewer.php?CISOROOT=/p129401coll0&CISOPTR=3156"