<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Traits\AuthTrait;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase, AuthTrait;
    
    /** @test */
    public function it_has_a_path()
    {
        $article = factory('App\Article')->create();
        $this->assertEquals('/articles/' . $article->id, $article->path());
        $this->assertEquals('/admin/articles/' . $article->id, $article->adminPath());
    }

    public function it_has_an_owner()
    {
        $project = factory('App\Project')->create();
        $this->assertInstanceOf('App\User', $project->owner);
    }
}
