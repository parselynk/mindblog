<?php

namespace App;

use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasTags;

    protected $guarded = [];

    public function path()
    {
        return "/articles/{$this->id}";
    }

    public function adminPath()
    {
        return "/admin/articles/{$this->id}";
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function tagList()
    {
        return $this->tags->pluck('name');
    }
}
