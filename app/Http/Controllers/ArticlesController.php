<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\BaseController;

class ArticlesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view($this->getview('index'), compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->getview('create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {

        $attributes = $request->validated();
        $article = auth()->user()->articles()->create($attributes);

        $request->persistTags($article);
        $request->persistPhoto($article);

        return redirect('/admin/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view($this->getview('show'), compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        if (auth()->user()->isNot($article->author)) {
            return abort(403);
        }
        return view($this->getview('edit'), compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Article $article, ArticleRequest $request)
    {
        
        if (auth()->user()->isNot($article->author)) {
            return abort(403);
        }

        $attributes = $request->validated();
        $article->update($attributes);

        $request->persistTags($article);
        $request->persistPhoto($article);

        return redirect('/admin/articles/'.$article->id.'/edit')->with(['success' => 'Article is updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
