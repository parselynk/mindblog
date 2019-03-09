<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Article;
use Illuminate\Http\Request;
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
    public function store()
    {

        $attributes = request()->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        if (request()->has('tags')) {
            $tags = preg_split("/[,]+/", request('tags'));
        }


        if (request()->hasFile('photo')) {
            request()->validate([
                    'photo' => 'required|image|mimes:jpeg,jpg|max:1024',
            ]);

            $imageName = request()->file('photo')->store(config('photo.folder'), config('photo.disk'));

            if (!request()->file('photo')->isValid()) {
                return back()->withErrors([
                    'message' => ' Check your credentials and try again.'
                ]);
            }
        }

        $article = auth()->user()->articles()->create($attributes);
        
        if (!empty($tags)) {
            $article->attachTags($tags);
        }

        if (!empty($imageName)) {
            $article->photos()->create([
                'name' => $imageName
            ]);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
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
