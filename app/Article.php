<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/articles/{$this->id}";
    }

    public function adminPath()
    {
        return "/admin/articles/{$this->id}";
    }
}
