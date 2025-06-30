<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; // Importar Gate
use App\Models\Noticia; // Importar o modelo Noticia
use App\Models\User; // Importar o modelo User

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

        // Gate para visualizar uma notícia
        Gate::define('view-noticia', function (User $user, Noticia $noticia) {
            return $user->id === $noticia->user_id;
        });

        // Gate para atualizar uma notícia
        Gate::define('update-noticia', function (User $user, Noticia $noticia) {
            return $user->id === $noticia->user_id;
        });

        // Gate para excluir uma notícia
        Gate::define('delete-noticia', function (User $user, Noticia $noticia) {
            return $user->id === $noticia->user_id;
        });
    }
}
