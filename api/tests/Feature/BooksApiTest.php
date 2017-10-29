<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BooksApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
        $this->seed();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/api/books');
        $response->assertStatus(200);
    }

    /**
     * Filter by author, two results.
     *
     * @return void
     */
    public function testFilterByAuthor()
    {
        $query = ['author' => 'Robin Nixon'];
        $response = $this->get('/books?' . http_build_query($query));
        $response->assertStatus(200);
        $totalResults = count(json_decode($response));
        self::assertEquals($totalResults, 2);
        $response->assertSeeText('978-1491918661');
        $response->assertSeeText('978-0596804848');
    }

    /**
     * Filter by author, one result.
     *
     * @return void
     */
    public function testFilterByAuthor2()
    {
        $author = urlencode('Christopher Negus');
        $response = $this->get('/api/books?author=' . $author);
        $response->assertStatus(200);
        $resultsTotal = count(json_decode($response->content()));
        $this->assertEquals($resultsTotal, 1);
        $response->assertSeeText('978-1118999875');
    }

    /**
     * List of categories.
     */
    public function testCategoryList()
    {
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
        $resultsTotal = count(json_decode($response->content()));
        $this->assertEquals($resultsTotal, 3);
        $response->assertSeeText('PHP');
        $response->assertSeeText('Javascript');
        $response->assertSeeText('Linux');
    }

    /**
     * Filter by Category: Linux.
     */
    public function testCategoryFilterLinux()
    {
        $category = 'Linux';
        $response = $this->get('/api/books?category=' . $category);
        $response->assertStatus(200);
        $resultsTotal = count(json_decode($response->content()));
        $this->assertEquals($resultsTotal, 2);
        $response->assertSeeText('978-0596804848');
        $response->assertSeeText('978-1118999875');
    }

    /**
     * Filter by Category: PHP.
     */
    public function testCategoryFilterPHP()
    {
        $category = 'PHP';
        $response = $this->get('/api/books?category=' . $category);
        $response->assertStatus(200);
        $resultsTotal = count(json_decode($response->content()));
        $this->assertEquals($resultsTotal, 1);
        $response->assertSeeText('978-1491918661');
    }

    /**
     * Filter by Author and Category.
     */
    public function testAuthorCategoryFilter()
    {
        $author = 'Robin Nixon';
        $category = 'Linux';
        $response = $this->get('/api/books?category=' . $category . '&author=' . $author);
        $response->assertStatus(200);
        $resultsTotal = count(json_decode($response->content()));
        $this->assertEquals($resultsTotal, 1);
        $response->assertSeeText('978-0596804848');
    }


    /**
     * Create a book.
     */
    public function testCreate()
    {
        $data = [];
        $data['isbn'] = '978-1491905012';
        $data['title'] = 'Modern PHP: New Features and Good Practices';
        $data['author'] = 'Josh Lockhart';
        $data['category'] = 'PHP';
        $data['price'] = '18.99 GBP';
        $response = $this->post('/api/books', $data);
        $response->assertStatus(201);
        $response->assertSeeText('978-1491905012');
        $response->assertSeeText('Modern PHP: New Features and Good Practices');
        $response->assertSeeText('Josh Lockhart');
        $response->assertSeeText('PHP');
        $response->assertSeeText('18.99');
    }

    /**
     * Fail to create a book.
     */
    public function testCreateInvalidISBN()
    {
        $data = [];
        $data['isbn'] = '978-INVALID-ISB N-1491905012';
        $data['title'] = 'Modern PHP: New Features and Good Practices';
        $data['author'] = 'Josh Lockhart';
        $data['category'] = 'PHP';
        $data['price'] = '18.99 GBP';
        $response = $this->post('/api/books', $data);
        $response->assertStatus(400);
        $response->assertSeeText('Invalid isbn');
    }
}
