<?php
namespace RichardAbear\Twilio;

use Illuminate\Support\ServiceProvider;
use RichardAbear\Twilio\Adapters\Twilio;
use RichardAbear\Twilio\Contracts\TwilioAdminClient;
use TwilioAdmin;

class TwilioServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TwilioAdminClient::class, function () {
            return new Twilio(config('twilio.sid'), config('twilio.token'));
        });
    }
    
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        
        $this->publishes([
            __DIR__.'/../config/twilio.php' => config_path('twilio.php')
        ]);
    }
}
