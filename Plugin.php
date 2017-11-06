<?php namespace ChVuagniaux\Horizon;

use App;
use Backend\Facades\BackendAuth;
use Config;
use Illuminate\Foundation\AliasLoader;
use Laravel\Horizon\Horizon;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

/**
 * Horizon Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Horizon',
            'description' => 'Queue monitoring dashboard by Laravel',
            'author'      => 'ChVuagniaux',
            'icon'        => 'icon-area-chart',
            'homepage'    => 'http://octobercms.com/plugins/chvuagniaux-horizon'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
        App::register('Laravel\Horizon\HorizonServiceProvider');

        AliasLoader::getInstance()->alias('Horizon', 'Laravel\Horizon\Horizon');

        Config::set('app.env', App::environment());

        Horizon::auth(function ($request) {
            if (empty($user = BackendAuth::getUser())) {
                return false;
            }

            return $user->isSuperUser() || $user->hasPermission('chvuagniaux.horizon.access');
        });
    }

    /**
     * Registers scheduled tasks that are executed on a regular basis.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function registerSchedule($schedule)
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'chvuagniaux.horizon.access' => [
                'tab'   => 'Horizon',
                'label' => 'Access to the Horizon dashboard',
                'roles' => ['developer'],
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'horizon' => [
                'label'       => 'Horizon',
                'description' => 'Queue monitoring dashboard',
                'category'    => SettingsManager::CATEGORY_LOGS,
                'icon'        => 'icon-area-chart',
                'url'         => url('/horizon'),
                'permissions' => ['chvuagniaux.horizon.access'],
                'order'       => 500,
                'keywords'    => 'queue horizon job',
            ],
        ];
    }
}
