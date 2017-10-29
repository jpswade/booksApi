Feature:
  As an api consumer
  I want to be able to add new books to the system
  So that I can easily list and find books

  Background:
    Given there are the following books in the system:
      | ISBN           | Title                                                      | Author            | Category        | Price     |
      | 978-1491918661 | Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5 | Robin Nixon       | PHP, Javascript | 9.99 GBP  |
      | 978-0596804848 | Ubuntu: Up and Running: A Power User's Desktop Guide       | Robin Nixon       | Linux           | 12.99 GBP |
      | 978-1118999875 | Linux Bible                                                | Christopher Negus | Linux           | 19.99 GBP |
      | 978-0596517748 | JavaScript: The Good Parts                                 | Douglas Crockford | Javascript      | 8.99 GBP  |

  Scenario: Filter by author, two results
    Given I am an api consumer
    When I filter by author "Robin Nixon"
    Then I should receive a 200 response
    And the body should contain 2 results
    And the body should contain "978-1491918661"
    And the body should contain "978-0596804848"

  Scenario: Filter by author, one result
    Given I am an api consumer
    When I filter by author "Christopher Negus"
    Then I should receive a 200 response
    And the body should contain 1 result
    And the body should contain "978-1118999875"

  Scenario: List the three categories
    Given I am an api consumer
    When I query the api for a list of categories
    Then I should receive a 200 response
    And the body should contain three results
    And the body should contain "PHP"
    And the body should contain "Javascript"
    And the body should contain "Linux"

  Scenario: Filter by category, two results
    Given I am an api consumer
    When I filter by category "Linux"
    Then I should receive a 200 response
    And the body should contain 2 results
    And the body should contain "978-0596804848"
    And the body should contain "978-1118999875"

  Scenario: Filter by category, one result
    Given I am an api consumer
    When I filter by category "PHP"
    Then I should receive a 200 response
    And the body should contain 1 result
    And the body should contain "978-1491918661"

  Scenario: Filter by author and category, one result
    Given I am an api consumer
    When I filter by author "Robin Nixon"
    And I filter by category "Linux"
    Then I should receive a 200 response
    And the body should contain 1 result
    And the body should contain "978-0596804848"

  Scenario: Add a book to the system
    Given I am an api consumer
    When I create the following book
      | ISBN           | Title                                       | Author        | Category | Price     |
      | 978-1491905012 | Modern PHP: New Features and Good Practices | Josh Lockhart | PHP      | 18.99 GBP |
    Then I should receive a 201 response
    And the body should contain "978-1491905012"
    And the body should contain "Modern PHP: New Features and Good Practices"
    And the body should contain "Josh Lockhart"
    And the body should contain "PHP"
    And the body should contain "18.99"

  Scenario: Fail to add a book
    Given I am an api consumer When I create the following book
      | ISBN                         | Title                                       | Author        | Category | Price     |
      | 978-INVALID-ISB N-1491905012 | Modern PHP: New Features and Good Practices | Josh Lockhart | PHP      | 18.99 GBP |
    Then I should receive a 400 response
    And the body should contain "Invalid isbn"
