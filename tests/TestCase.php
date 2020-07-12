<?php

use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return ['RichardAbear\Twilio\TwilioServiceProvider'];
    }

    /**
 * Define environment setup.
 *
 * @param  \Illuminate\Foundation\Application  $app
 * @return void
 */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('twilio.sid', env(['TWILIO_ADMIN_SID']));
        $app['config']->set('twilio.token', env(['TWILIO_ADMIN_TOKEN']));
    }
}
