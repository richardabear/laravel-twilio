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
    public static function bootTwilioSubaccount()
    {
        static::created(function ($model) {
            $model->validateTwilioAccount();
        });

        static::updated(function ($model) {
            $model->validateTwilioAccount();
        });

        static::deleted(function ($model) {
            $model->destroyTwilioAccount();
        });
    }

    /**
     * Validates that the model has an attached twilio account
     *
     * @return self
     */
    public function validateTwilioAccount()
    {
        if (! $this->twilioAccount) {
            $this->createTwilioSubAccount();
        }

        return $this;
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

    /**
     * Creates a new twilio sub account
     *
     * @return self
     */
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

        return $this;
    }

    
    /**
     * Update the twilio account status
     *
     * active
     * suspended
     * closed
     *
     * @param String $status
     * @return self
     */
    public function updateTwilioAccountStatus($status)
    {
        /**
         * @var TwilioAdminClient $admin
         */
        $adminClient = app(TwilioAdminClient::class);
        $adminClient->api->v2010->accounts($this->twilioAccount->sid)->update(['status' => $status]);

        return $this;
    }
}
