<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::define("admin-privileges", function() {
            # Only super admin can perform registration 
            # Only super admin can delete admins
            # Only superadmin can modify role status
        });

        Gate::define("post", function (int $userId, Post $post) {
           return $userId == $post->user_id;
        });

        Gate::define("post-update", function (int $userId, Post $post) {
            return $userId == $post->user_id;
        });

        Gate::define("post-delete", function (int $userId, Post $post) {
            return $userId == $post->user_id;
        });

        Gate::define("comment-update", function () {
            # Only user who created comment can update or delete post
        });

        
    }
}
