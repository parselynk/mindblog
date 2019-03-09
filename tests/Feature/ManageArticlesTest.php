<?php

namespace Tests\Feature;

use App\Photo;
use Tests\TestCase;
use App\Traits\AuthTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageArticlesTest extends TestCase
{
    use RefreshDatabase, withFaker, AuthTrait;

    /** @test */
    public function guests_cannot_create_article()
    {
        $article = factory('App\Article')->create();
        $this->get('/admin/articles/create')->assertStatus(302);
        $this->get('/admin/articles/create')->assertRedirect('/login');
        $this->post('admin/articles', $article->toArray())->assertRedirect('/login');
    }

    /** @test */
    public function guest_user_can_only_view_articles_through_public_view()
    {
        $this->withoutExceptionHandling();
        $article = factory('App\Article')->create();
        $this->get('/articles')->assertOk()->assertViewIs('articles.index');
        $this->get($article->path())->assertOk()->assertViewIs('articles.show');
    }

    /** @test */
    public function admin_can_view_articles_through_admin_panel()
    {
        //$this->withoutExceptionHandling();
        $article = factory('App\Article')->create();
        $this->get($article->adminPath())->assertRedirect('/login');
        $this->authorizeUser();
        $this->get('/admin/articles')->assertOk()->assertViewIs('articles.admin.index');
        $this->get("{$article->adminPath()}")->assertOk()->assertViewIs('articles.admin.show');
    }

     /** @test */
    public function an_admin_can_create_article()
    {
        $this->withoutExceptionHandling();
        $this->authorizeUser();
        $this->get('/admin/articles/create')->assertOk()->assertViewIs('articles.admin.create');

        $attributes = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph
        ];
        $this->post('/admin/articles', $attributes);
        $this->assertDatabaseHas('articles', $attributes);
    }

     /** @test */
    public function an_article_requires_a_title()
    {
        $this->authorizeUser();
        $attributes = factory('App\Article')->raw(['title' => null]);
        $this->post('/admin/articles', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_article_requires_content()
    {
        $this->authorizeUser();
        $attributes = factory('App\Article')->raw(['content' => null]);
        $this->post('/admin/articles', $attributes)->assertSessionHasErrors('content');
    }

    /** @test */
    public function an_article_can_have_a_photo()
    {
        Storage::fake(config('photo.disk'));
        $this->authorizeUser();
        $photo = UploadedFile::fake()->image('avatar.jpg');
        $attributes = factory('App\Article')->raw();
        $attributes['photo'] = $photo;
        $this->post('/admin/articles', $attributes);
        $this->assertEquals(config('photo.folder').'/' . $photo->hashName(), Photo::latest()->first()->name);
        Storage::disk(config('photo.disk'))->assertExists(config('photo.folder') .'/'. $photo->hashName());
        ;
    }
}