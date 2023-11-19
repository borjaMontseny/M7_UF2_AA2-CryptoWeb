<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use App\Http\Requests\StoreNewsArticleRequest;
use App\Http\Requests\UpdateNewsArticleRequest;

class NewsArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsArticleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsArticle $newsArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsArticle $newsArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsArticleRequest $request, NewsArticle $newsArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsArticle $newsArticle)
    {
        //
    }
}
