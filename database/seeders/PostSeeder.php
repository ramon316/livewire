<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class PostSeeder extends Seeder
{
    public function run(): void
    {        
        Storage::deleteDirectory('public/posts-images');
        Storage::makeDirectory('public/posts-images');
        Post::factory(30)->create();
    }
}
