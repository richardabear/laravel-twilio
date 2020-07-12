<?php
namespace RichardAbear\Twilio\Traits;

use RichardAbear\Twilio\Models\TwilioAccount;

trait TwilioSubaccount
{
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
        $account = new TwilioAccount([
            ''
        ]);
    }
}
