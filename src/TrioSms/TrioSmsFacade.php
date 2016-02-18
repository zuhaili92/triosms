<?php namespace i906\TrioSms;

use Illuminate\Support\Facades\Facade;

class TrioSmsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TrioSms::class;
    }
}
