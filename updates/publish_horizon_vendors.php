<?php namespace ChVuagniaux\Horizon\Updates;

use Illuminate\Support\Facades\Artisan;
use October\Rain\Database\Updates\Migration;

class PublishHorizonVendors extends Migration
{
    public function up()
    {
        Artisan::call('vendor:publish', [
            '--provider' => 'Laravel\Horizon\HorizonServiceProvider',
        ]);
    }

    public function down()
    {
    }
}
