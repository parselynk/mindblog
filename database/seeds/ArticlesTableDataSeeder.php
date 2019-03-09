<?php

use Illuminate\Database\Seeder;

class ArticlesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(App\Article::class, 50)->create()->each(function ($article) {
            $article->photos()->save(factory(App\Photo::class)->make());
         });
    }
}
