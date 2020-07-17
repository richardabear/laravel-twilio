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
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'../config/twilio.php' => config_path('twilio.php')
        ]);

        $this->app->singleton(TwilioAdminClient::class, function () {
            $twilioAdminAdapter = new Twilio(config('twilio.sid'), config('twilio.token'));
            return $twilioAdminAdapter->getClient();
        });
    }
}
