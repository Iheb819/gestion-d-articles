<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $articles = Article::with('scategorie')->get();
            return response()->json($articles);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $article = new Article([
                "designation" => $request->input('designation'),
                "marque" => $request->input('marque'),
                "reference" => $request->input('reference'),
                "qtestock" => $request->input('qtestock'),
                "prix" => $request->input('prix'),
                "imageart" => $request->input('imageart'),
                "scategorieID" => $request->input('scategorieID'),
            ]);
            $article->save();
            return response()->json($article);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $article = Article::findOrFail($id);  // Removed empty with() relation
            return response()->json($article);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->update($request->all());
            return response()->json($article);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();
            return response()->json("Article supprimé avec succès");
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Paginate articles.
     */
    public function articlesPaginate()
    {
        try {
            $perPage = request()->input('pageSize', 10); // Dynamic page size for pagination
            $articles = Article::with('scategorie')->paginate($perPage);

            return response()->json([
                'products' => $articles->items(), // Paged articles
                'totalPages' => $articles->lastPage(), // Total number of pages
            ]);
        } catch (\Exception $e) {
            return response()->json("Selection impossible: {$e->getMessage()}");
        }
    }
}
