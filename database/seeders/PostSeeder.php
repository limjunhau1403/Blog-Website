<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->makeDirectory('temp_images');

        Post::create([
            'title' => 'First Sample Post',
            'content' => 'This is the content of the first sample post.',
            'image' => 'temp_images/post_images.jpeg',
            'user_id' => 1,
        ]);
    }
}
