# Horizon in October CMS
Provide [Laravel Horizon](https://horizon.laravel.com/) inside your OctoberCMS application.

## Run
```
php artisan horizon
```
When running, Horizon will take care of running all your queues defined inside `config/horizon.php`. 

For the production this process need to be supervised by a tool like supervisord  
(that take care of restarting it when the process fail).

If you want graph, don't forget to correctly setup [October CMS scheduler cron](http://octobercms.com/docs/setup/installation#crontab-setup)  

## Configuration
For the configuration take a look on the [Horizon documentation site](https://laravel.com/docs/master/horizon)
