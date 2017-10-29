<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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


    /**
     * Store a new book.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $book = new Book();
        $book->isbn = $request->post('isbn');
        $book->title = $request->post('title');
        $book->author = $request->post('author');
        $book->category = $request->post('category');
        $book->price = $request->post('price');
        $book->save();
        return response($book, 201);
    }
}