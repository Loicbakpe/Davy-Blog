<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Administrateur
        User::factory()->create([
            'name' => 'Davy Admin',
            'email' => 'admin@davyblog.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Auteur
        User::factory()->create([
            'name' => 'John Auteur',
            'email' => 'author@davyblog.com',
            'role' => 'author',
        ]);

        Category::factory(5)->create();
        Tag::factory(10)->create();

        // Posts avec tags attachés
        Post::factory(20)->create()->each(function (Post $post) {
            $tags = Tag::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $post->tags()->attach($tags);
        });
    }
}
