<?php
namespace RichardAbear\Twilio\Tests;

use Illuminate\Database\Eloquent\Model;
use RichardAbear\Twilio\Traits\TwilioSubaccount;

class TestModel extends Model
{
    use TwilioSubaccount;
}
