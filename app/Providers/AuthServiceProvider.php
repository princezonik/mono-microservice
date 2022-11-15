<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

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

        if (! $this->app->routesAreCached()) {
            Passport::routes();
        }

        Gate::define('view',  function(User $user, $model){
            return $user->hasAccess("view_{$model}") || $user->hasAccess("edit_{$model}");
        });
        Gate::define('edit',  function(User $user, $model){
            return $user->hasAccess("edit_{$model}");
        });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $dexterUrl = 'dexterprolimited.com?email_verify_url=' . $url;

            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $dexterUrl);
        });
    }
}
