<?php

use Illuminate\Database\Seeder;
use App\Book;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate our existing records.
        Book::truncate();

        // Load in our books.
        $booksJson = file_get_contents('storage/data/books.json');
        $books = json_decode($booksJson);

        // Create the books:
        foreach ($books as $book) {
            Book::create((array)$book);
        }
    }
}
