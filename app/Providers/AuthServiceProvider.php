<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // ...
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-post', function ($user, $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('delete-post', function ($user, $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('update-comment', function ($user, $comment) {
            return $user->id === $comment->user_id;
        });

        Gate::define('delete-comment', function ($user, $comment) {
            return $user->id === $comment->user_id;
        });
    }
}
