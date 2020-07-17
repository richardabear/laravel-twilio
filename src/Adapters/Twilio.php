<?php
namespace RichardAbear\Twilio\Adapters;

use RichardAbear\Twilio\Contracts\TwilioClient;
use Twilio\Rest\Client;

class Twilio
{
    /**
     * Client variable
     *
     * @var Client $client
     */
    protected $client;

    public function __construct($sid, $token)
    {
        $this->client = new Client($sid, $token);
    }
    
    /**
     * Returns the twilio client for the administrator account
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
