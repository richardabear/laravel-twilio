<?php
namespace RichardAbear\Twilio\Traits;

use RichardAbear\Twilio\Contracts\TwilioAdminClient;
use RichardAbear\Twilio\Models\TwilioAccount;

trait TwilioSubaccount
{
    /**
     * Twilio Administrator client
     *
     * @var String
     */
    protected $twilioAdminClient;
    
    public function bootTwilioSubaccount()
    {
        if (! $this->twilioAccount) {
            $this->createTwilioAccount();
        }
    }

    public function twilioAccount()
    {
        return $this->belongsTo(TwilioAccount::class);
    }

    protected function createTwilioSubAccount()
    {
        $twilioAccount = new TwilioAccount([]);
        /**
         * @var TwilioAdminClient $adminClient
         */
        $adminClient = app(TwilioAdminClient::class);
    }
}
