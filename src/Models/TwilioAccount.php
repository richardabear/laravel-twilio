<?php
namespace RichardAbear\Twilio\Models;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use RichardAbear\Twilio\Adapters\Twilio;
use Twilio\Rest\Client;

class TwilioAccount extends Model
{
    protected $fillable = [
        'sid',
        'token',
        'friendly_name'
    ];

    public function getAdapterAttribute(): Twilio
    {
        return new Twilio($this->sid, $this->token);
    }

    public function getTwilioClientAttribute(): Client
    {
        return $this->adapter->getClient();
    }

    public function setTokenAttribute($val)
    {
        return Crypt::encrypt($val);
    }

    public function getTokenAttribute($val)
    {
        return Crypt::decrypt($val);
    }
}
