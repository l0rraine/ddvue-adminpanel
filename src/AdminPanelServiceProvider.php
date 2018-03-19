<?php

namespace DDVue\AdminPanel;

use DDVue\AdminPanel\app\Console\Commands\CrudControllerCommand;
use DDVue\AdminPanel\app\Console\Commands\CrudModelCommand;
use DDVue\AdminPanel\app\Console\Commands\CrudViewListCommand;
use DDVue\AdminPanel\app\Console\Commands\CrudViewStoreCommand;
use DDVue\AdminPanel\app\Console\Commands\CrudVueEditCommand;
use DDVue\AdminPanel\app\Console\Commands\CrudVueListCommand;
use DDVue\Crud\CrudRoute;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Route;
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
                             __DIR__ . '/config/permission.php' => config_path('permission.php'),
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


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->setupRoutes();
        $this->commands([
                            CrudControllerCommand::class,
                            CrudModelCommand::class,
                            CrudViewListCommand::class,
                            CrudViewStoreCommand::class,
                            CrudVueListCommand::class,
                            CrudVueEditCommand::class,
                        ]);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('AdminPanel', \DDVue\AdminPanel\AdminPanelServiceProvider::class);


        $this->app->register(\Spatie\Permission\PermissionServiceProvider::class);
    }


    private function setupRoutes()
    {

        Route::group([
                         'namespace'  => '\DDVue\AdminPanel\app\Http\Controllers',
                         'middleware' => ['web'],
                         'prefix'     => config('ddvue.adminpanel.url_prefix')],
            function () {
                require __DIR__ . '/routes/auth.php';
            });

        $middleware = ['web', config('ddvue.adminpanel.auth.admin_auth_middleware')];

        Route::group([
                         'middleware' => $middleware,
                         'prefix'     => config('ddvue.adminpanel.url_prefix')],
            function () {
                Route::group(['namespace' => '\DDVue\AdminPanel\app\Http\Controllers'], function () {
                    Route::get('/', 'AdminPanelController@getIndex')->name('Ddvue.AdminPanel.home');
                    Route::get('/welcome', function () {
                        return view('ddvue.adminpanel::welcome');
                    })->name('Ddvue.AdminPanel.welcome');

                    Route::get('/settingsJson', 'AdminPanelController@getSettingsJson')->name('Ddvue.AdminPanel.settings.json');
                    Route::get('/changepassword', 'AdminPanelController@changePassword')->name('Ddvue.AdminPanel.changepassword');
                });

                //后台菜单
                CrudRoute::make('menu', 'DDVue\AdminPanel\app\Http\Controllers\AdminMenuController', 'Ddvue.AdminPanel.menu');

                //用户管理
                $controller = config('ddvue.adminpanel.page_settings.user.controller');
                Route::get('user/changepassword/{id}', $controller . '@changePassword')->name('Ddvue.AdminPanel.user.changepassword');
                Route::post('user/changepassword', $controller . '@doChange')->name('Ddvue.AdminPanel.user.changepassword');
                CrudRoute::make('user', $controller, 'Ddvue.AdminPanel.user');

                //单位管理
                CrudRoute::make('department', config('ddvue.adminpanel.page_settings.department.controller'), 'Ddvue.AdminPanel.department');

                //角色管理
                CrudRoute::make('role', config('ddvue.adminpanel.page_settings.role.controller'), 'Ddvue.AdminPanel.role');

                //权限
                CrudRoute::make('permission', config('ddvue.adminpanel.page_settings.permission.controller'), 'Ddvue.AdminPanel.permission');


                //Excel上传
                require __DIR__ . '/routes/excel.php';

            });


    }


}
