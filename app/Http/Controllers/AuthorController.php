<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Author::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $author = Author::create($request->all());

        return response()->json($author, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'sometimes|string|max:100',
        ]);

        $author->update($request->all());

        return response()->json($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(null, 204);
    }
}
