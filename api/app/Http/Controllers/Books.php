<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Show the book.
     *
     * @param  Request $request The request.
     * @return Book
     */
    public function show(Request $request)
    {
        $author = $request->get('author');
        $category = $request->get('category');
        $book = new Book();
        if ($author) {
            $book = $book->where('author', $author);
        }
        if ($category) {
            $book = $book->where('category', 'LIKE', "%$category%");
        }
        return $book->select('*')
            ->get();
    }
}