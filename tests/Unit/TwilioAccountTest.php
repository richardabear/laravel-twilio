<?php
namespace RichardAbear\Twilio\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use RichardAbear\Twilio\Adapters\Twilio;
use RichardAbear\Twilio\Models\TwilioAccount;
use RichardAbear\Twilio\Tests\TestCase;
use Twilio\Rest\Client;

class TwilioAccountTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateTwilioAccount()
    {
        $twilioAccount = new TwilioAccount([
            'friendly_name' => 'test',
        ]);
        $twilioAccount->save();
        $this->assertEquals('test', $twilioAccount->friendly_name);
    }
}
