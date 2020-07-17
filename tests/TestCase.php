<?php
namespace RichardAbear\Twilio\Tests;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use RichardAbear\Twilio\TwilioServiceProvider;

class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [TwilioServiceProvider::class];
    }

    /**
 * Define environment setup.
 *
 * @param  \Illuminate\Foundation\Application  $app
 * @return void
 */
    protected function getEnvironmentSetUp($app)
    {
        $app->useEnvironmentPath(__DIR__.'/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('twilio.sid', env('TWILIO_ADMIN_SID'));
        $app['config']->set('twilio.token', env('TWILIO_ADMIN_TOKEN'));

        parent::getEnvironmentSetUp($app);
    }

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->artisan('migrate', ['--database' => 'testing'])->run();
    }
}
