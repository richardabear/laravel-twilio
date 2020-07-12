<?php
namespace RichardAbear\Twilio;

use Illuminate\Database\Eloquent\Model;

class TwilioSubaccountManager
{
    protected $owner;
    
    public function __construct(Model $owner)
    {
        $this->owner = $owner;
    }
}
