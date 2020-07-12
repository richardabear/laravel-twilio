<?php
namespace RichardAbear\Twilio;

use Illuminate\Support\ServiceProvider;

class TwilioServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'../config/twilio.php' => config_path('twilio.php');
        ]);
    }
}
