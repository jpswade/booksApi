<?php

namespace App\Http\Controllers;

use App\Book;

class BooksController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function show()
    {
        return Book::all();
    }
}