<?php

namespace App\Http\Requests;

use App\Article;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required'
        ];
    }

    public function hasTags()
    {
        if (request()->has('tags')) {
            return true;
        }

        return false;
    }

    public function hasPhoto()
    {
        if (request()->has('photo')) {
            return true;
        }

        return false;
    }

    public function validatePhoto()
    {
        request()->validate([
            'photo' => 'required|image|mimes:jpeg,jpg|max:1024|dimensions:min_width=250,max_width=2048'
        ]);
    }

    public function processTags()
    {
        return request('tags') ? preg_split("/[,]+/", request('tags')) : [];
    }

    public function persistTags(Article $article)
    {
        
        if ($this->hasTags()) {
            // reset tags
            if ($article->tagList()->count()) {
                $article->detachTags($article->tagList()->toArray());
            }
            // attach tags again
            if (!empty($tags = $this->processTags())) {
                $article->attachTags($tags);
            }
        }

        return $this;
    }

    public function persistPhoto(Article $article)
    {
        if ($this->hasPhoto()) {
            $this->validatePhoto();
            $imageName = $this->uploadPhoto();
            if (!empty($imageName)) {
                 $article->photos()->create([
                    'name' => $imageName
                 ]);
            }
        }

        return $this;
    }

    public function uploadPhoto()
    {
        $imageName = request()->file('photo')->store(config('photo.folder'), config('photo.disk'));
        if (!request()->file('photo')->isValid()) {
            return back()->withErrors([
                'message' => 'there was an error with uploading photo.'
            ]);
        }

        return $imageName;
    }
}
