<?php
namespace RichardAbear\Twilio\Client;

use Twilio\Rest\Client;

class TwilioAdministration
{
    /**
     * Client variable
     *
     * @var Client $client
     */
    protected $client;

    public function __construct(): void
    {
        $this->client = new Client(config('twilio.sid'), config('twilio.token'));
    }

    public function createSubaccount(string $friendlyName): void
    {
        $sub_account = $this->client->api->v2010->accounts->create([
            'friendlyName' => $friendlyName
        ]);
    }
}
