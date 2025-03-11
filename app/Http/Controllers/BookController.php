<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Book::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'author_id' => 'required|exists:authors,id',
            'category_ids' => 'array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $book = Book::create($request->only(['title', 'author_id']));
        
        if ($request->has('category_ids')) {
            $book->categories()->attach($request->category_ids);
        }

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json($book, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'string|max:250',
            'author_id' => 'exists:authors,id',
            'category_ids' => 'array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $book->update($request->only(['title', 'author_id']));
        
        if ($request->has('category_ids')) {
            $book->categories()->sync($request->category_ids);
        }

        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
    }
}
