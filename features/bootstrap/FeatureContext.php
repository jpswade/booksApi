<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given there are the following books in the system:
     */
    public function thereAreTheFollowingBooksInTheSystem(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given I am an api consumer
     */
    public function iAmAnApiConsumer()
    {
        throw new PendingException();
    }

    /**
     * @When I filter by author :arg1
     */
    public function iFilterByAuthor($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should receive a :arg1 response
     */
    public function iShouldReceiveAResponse($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the body should contain :arg1 results
     */
    public function theBodyShouldContainResults($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the body should contain :arg1
     */
    public function theBodyShouldContain($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the body should contain :arg1 result
     */
    public function theBodyShouldContainResult($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I query the api for a list of categories
     */
    public function iQueryTheApiForAListOfCategories()
    {
        throw new PendingException();
    }

    /**
     * @Then the body should contain three results
     */
    public function theBodyShouldContainThreeResults()
    {
        throw new PendingException();
    }

    /**
     * @When I filter by category :arg1
     */
    public function iFilterByCategory($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I create the following book
     */
    public function iCreateTheFollowingBook(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given I am an api consumer When I create the following book
     */
    public function iAmAnApiConsumerWhenICreateTheFollowingBook(TableNode $table)
    {
        throw new PendingException();
    }

}
