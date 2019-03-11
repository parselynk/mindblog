<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\BaseController;

class ArticlesController extends BaseController
{
    
    public function __construct()
    {
        $this->middleware('can:update,article')->except(['index','create','store','show']);
    }

    public function index()
    {
        $articles = Article::latest()->get();
        return view($this->getview('index'), compact('articles'));
    }


    public function create()
    {
        return view($this->getview('create'));
    }

    /**
     * @param  ArticleRequest $request
     */
    public function store(ArticleRequest $request)
    {

        $attributes = $request->validated();
        $article = auth()->user()->articles()->create($attributes);

        $request->persistTags($article);
        $request->persistPhoto($article);

        return redirect('/admin/articles')->with(["success" => "Article no: {$article->id} is created successfully."]);
    }

    public function show(Article $article)
    {
        return view($this->getview('show'), compact('article'));
    }

    public function edit(Article $article)
    {
        return view($this->getview('edit'), compact('article'));
    }

    /**
     * @param  Article        $article
     * @param  ArticleRequest $request
     */
    public function update(Article $article, ArticleRequest $request)
    {

        $attributes = $request->validated();
        $article->update($attributes);

        $request->persistTags($article);
        $request->persistPhoto($article);

        return redirect('/admin/articles/'.$article->id.'/edit')->with(['success' => 'Article is updated successfully.']);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect('/admin/articles')->with(["success" => "Article {$article->id} is removed successfully."]);
        ;
    }
}
