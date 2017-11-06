# Horizon in October CMS
Provide [Laravel Horizon](https://horizon.laravel.com/) inside your OctoberCMS application.

Horizon will take care of running all your queues defined inside `config/horizon.php`. 

> Minimal requirement : OctoberCMS 420 and PHP 7.1

## Setup
1. Install this plugin
2. Edit the config file `config/horizon.php` - [good doc here](https://divinglaravel.com/horizon/before-the-dive)
3. run `php artisan horizon`

For the production this command need to be supervised by a tool like supervisord, that take care of restarting process when fails.

[More informations about how running Horizon](https://laravel.com/docs/master/horizon#running-horizon)
## Graphs
Horizon provide usage queue usage graph, if you want use them you need to have the [October CMS scheduler cron](http://octobercms.com/docs/setup/installation#crontab-setup)  correctly configured.
