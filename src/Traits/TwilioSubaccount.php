<?php
namespace RichardAbear\Twilio\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;
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
    
    /**
     * Bootable Twilio Subaccount
     *
     * @return void
     */
    public function bootTwilioSubaccount()
    {
        if (! $this->twilioAccount) { // By default create a twilio account for the attached model.
            $this->createTwilioAccount();
        }
    }

    /**
     * Returns the twilio account
     *
     * @return BelongsTo
     */
    public function twilioAccount(): BelongsTo
    {
        return $this->belongsTo(TwilioAccount::class);
    }

    protected function createTwilioSubAccount()
    {
        $twilioAccount = new TwilioAccount([
            'friendly_name' => Uuid::uuid1(16)
        ]);

        $twilioAccount->save();

        /**
         * @var TwilioAdminClient $adminClient
         */
        $adminClient = app(TwilioAdminClient::class);

        try {
            $account = $adminClient->api->v2010->accounts->create([
                'friendlyName' => $twilioAccount->friendly_name
            ]);

            $twilioAccount->sid = $account->sid;
            $twilioAccount->token = $account->authToken;

            $twilioAccount->save();
        } catch (\Exception $e) {
            $twilioAccount->delete();
        }
    }
}
