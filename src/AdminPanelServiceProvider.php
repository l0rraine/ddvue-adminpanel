<?php

namespace DDVue\AdminPanel;

use Illuminate\Auth\SessionGuard;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use DDVue\AdminPanel\app\Exceptions\CustomHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;

class AdminPanelServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        app('router')->aliasMiddleware('admin.referer', 'DDVue\AdminPanel\app\Http\Middleware\SetAdminReferer');
        app('router')->aliasMiddleware('admin.auth', 'DDVue\AdminPanel\app\Http\Middleware\Authenticate');

        // LOAD THE VIEWS
        // - first the published views (in case they have any changes)
        $this->loadViewsFrom(resource_path('views/vendor/ddvue/adminpanel'), 'ddvue.adminpanel');
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'ddvue.adminpanel');


        $this->publishes([
            __DIR__ . '/resources/views'       => resource_path('views/vendor/ddvue/adminpanel'),
            __DIR__ . '/public'                => public_path('/'),
            __DIR__ . '/config/ddvue'          => config_path('ddvue'),
            __DIR__ . '/config/adldap'         => config_path('/'),
            __DIR__ . '/database'              => base_path('/database'),
            __DIR__ . '/resources/assets/js'   => resource_path('assets/js'),
            __DIR__ . '/resources/assets/sass' => resource_path('assets/sass'),

        ], 'ddvue-adminpanel');


        $this->mergeConfigFrom(__DIR__ . '/config/ddvue/guards/ddvue_db.php', 'auth.guards.ddvue_db');
        $this->mergeConfigFrom(__DIR__ . '/config/ddvue/guards/ddvue_ldap.php', 'auth.guards.ddvue_ldap');

        $this->mergeConfigFrom(__DIR__ . '/config/ddvue/providers/db.php', 'auth.providers.db');
        $this->mergeConfigFrom(__DIR__ . '/config/ddvue/providers/ldap.php', 'auth.providers.ldap');


        $this->app->bind(
            ExceptionHandler::class,
            CustomHandler::class
        );


    }

    private function setupRoutes()
    {
        $router = app('router');

        $router->group([
            'namespace'  => '\DDVue\AdminPanel\app\Http\Controllers',
            'middleware' => ['web'],
            'prefix'     => config('ddvue.adminpanel.url_prefix')],
            function () use ($router) {
                require __DIR__ . '/routes/auth.php';
            });

        $middleware = ['web', config('ddvue.adminpanel.auth.admin_auth_middleware')];

        $router->group([
            'namespace'  => '\DDVue\AdminPanel\app\Http\Controllers',
            'middleware' => $middleware,
            'prefix'     => config('ddvue.adminpanel.url_prefix')],
            function () use ($router) {

                $router->get('/', 'AdminPanelController@getIndex')->name('DDVue.AdminPanel.home');

                $router->get('/welcome', function () {
                    return view('ddvue.adminpanel::welcome');
                })->name('DDVue.AdminPanel.welcome');

                $router->get('/settingsJson', 'AdminPanelController@getSettingsJson')->name('DDVue.AdminPanel.settings.json');

                //后台菜单
                require __DIR__ . '/routes/menu.php';

            });


    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->setupRoutes();
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('AdminPanel', \DDVue\AdminPanel\AdminPanelServiceProvider::class);


//        \App::singleton(
//
//            \DDVue\AdminPanel\app\Exceptions\Handler::class
//        );


//        $this->app->register('Kodeine\Acl\AclServiceProvider');
    }


}
