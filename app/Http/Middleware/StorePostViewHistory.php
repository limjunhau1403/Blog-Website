<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Post;

class StorePostViewHistory
{
    public function handle(Request $request, Closure $next)
    {
        // Only run if the route has a post
        $postId = $request->route('post.id');
        
        if ($postId) {
            $post = Post::find($postId);
            if ($post) {
                $history = session()->get('viewed_posts', []);

                // Avoid duplicate entry for the same post
                $history = collect($history)->reject(fn($item) => $item['id'] == $post->id)->toArray();

                // Add new post at the beginning
                array_unshift($history, [
                    'id' => $post->id,
                    'title' => $post->title,
                    'visited_at' => now()->toDateTimeString(),
                ]);

                session(['viewed_posts' => $history]);
            }
        }

        return $next($request);
    }
}
