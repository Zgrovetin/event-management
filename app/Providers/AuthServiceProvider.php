<?php

namespace App\Providers;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

// Added and registered as policy classes
//        Gate::define('update-event', function ($user, Event $event) {
//            return $user->id === $event->user_id;
//        });
//
//        Gate::define('delete-attendee', function ($user, Event $event, Attendee $attendee) {
//            return $user->id === $event->user_id || $user->id === $attendee->user_id;
//        });

    }
}
