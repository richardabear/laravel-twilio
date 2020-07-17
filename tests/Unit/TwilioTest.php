<?php
namespace RichardAbear\Twilio\Tests\Unit;

use RichardAbear\Twilio\Adapters\Twilio;
use RichardAbear\Twilio\Tests\TestCase;
use Twilio\Rest\Client;

class TwilioTest extends TestCase
{
    public function testTwilioKeys()
    {
        $this->assertNotNull(config('twilio.sid'));
        $this->assertNotNull(config('twilio.token'));
    }

    public function testCanCreateTwilioAdminClient()
    {
        $administrator = new Twilio(config('twilio.sid'), config('twilio.token'));
        $this->assertInstanceOf(Client::class, $administrator->getClient());
    }

    public function testCanCreateSubaccountAndClose()
    {
        $twilio_administrator = new Twilio(config('twilio.sid'), config('twilio.token'));
        $client = $twilio_administrator->getClient();
        $friendly_name = "Test Account";
        $sub_account = $client->api->v2010->accounts->create(['friendlyName' => $friendly_name]);
        $this->assertNotNull($sub_account);

        $client->api->v2010->accounts($sub_account->friendlyName)
    }
}
