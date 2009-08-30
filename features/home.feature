Feature: Home Page
  In order to learn more
  As an information seeker
  I want to visit the home page
 
  Scenario: Browse to the home page
    When I go to index
    Then I should see a link to the teach page
    And I should see a featured collection
    And I should see a featured Look article