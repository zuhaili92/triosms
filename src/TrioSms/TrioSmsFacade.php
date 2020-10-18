<?php namespace zuhaili92\TrioSms;

use Illuminate\Support\Facades\Facade;

class TrioSmsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zuhaili92\TrioSms\TrioSms';
    }
}
