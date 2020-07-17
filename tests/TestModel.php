<?php
namespace RichardAbear\Twilio;

use Illuminate\Database\Eloquent\Model;
use RichardAbear\Twilio\Traits\TwilioSubaccount;

class TestModel extends Model {
    use TwilioSubaccount;
    
}