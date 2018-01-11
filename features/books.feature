Feature:
  As an api consumer
  I want to be able to add new books to the system
  So that I can easily list and find books

  Background:
    Given I fill in the following:
      | ISBN           | Title                                                      | Author            | Category        | Price     |
      | 978-1491918661 | Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5 | Robin Nixon       | PHP, Javascript | 9.99 GBP  |
      | 978-0596804848 | Ubuntu: Up and Running: A Power User's Desktop Guide       | Robin Nixon       | Linux           | 12.99 GBP |
      | 978-1118999875 | Linux Bible                                                | Christopher Negus | Linux           | 19.99 GBP |
      | 978-0596517748 | JavaScript: The Good Parts                                 | Douglas Crockford | Javascript      | 8.99 GBP  |
    And press "submit"

  Scenario: Filter by author, two results
    When I select "Robin Nixon" from "author"
    Then the response status code should be 200
    And the response should contain "978-1491918661"
    And the response should contain "978-0596804848"

  Scenario: Filter by author, one result
    When I select "Christopher Negus" from "author"
    Then the response status code should be 200
    And the response should contain "978-1118999875"

  Scenario: List the three categories
    When I go to "/categories"
    Then the response status code should be 200
    And the response should contain "PHP"
    And the response should contain "Javascript"
    And the response should contain "Linux"

  Scenario: Filter by category, two results
    When I select "Linux" from "category"
    Then the response status code should be 200
    And the response should contain "978-0596804848"
    And the response should contain "978-1118999875"

  Scenario: Filter by category, one result
    When I select "PHP" from "category"
    Then the response status code should be 200
    And the response should contain "978-1491918661"

  Scenario: Filter by author and category, one result
    When I select "Robin Nixon" from "author"
    When I select "Linux" from "category"
    Then the response status code should be 200
    And the response should contain "978-0596804848"

  Scenario: Add a book to the system
    Given I fill in the following:
      | ISBN           | Title                                       | Author        | Category | Price     |
      | 978-1491905012 | Modern PHP: New Features and Good Practices | Josh Lockhart | PHP      | 18.99 GBP |
    And press "submit"
    Then the response status code should be 201
    And the response should contain "978-1491905012"
    And the response should contain "Modern PHP: New Features and Good Practices"
    And the response should contain "Josh Lockhart"
    And the response should contain "PHP"
    And the response should contain "18.99"

  Scenario: Fail to add a book
    Given I fill in the following:
      | ISBN                         | Title                                       | Author        | Category | Price     |
      | 978-INVALID-ISB N-1491905012 | Modern PHP: New Features and Good Practices | Josh Lockhart | PHP      | 18.99 GBP |
    Then the response status code should be 400
    And the response should contain "Invalid isbn"
