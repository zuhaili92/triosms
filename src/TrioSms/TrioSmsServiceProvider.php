<?php namespace i906\TrioSms;

use Illuminate\Support\ServiceProvider;

class TrioSmsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/courier.php' => \config_path('triosms.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TrioSms::class, function ($app) {
            $c = $app['config'];

            $url = $c->get('triosms.url');
            $token = $c->get('triosms.token');
            $sender = $c->get('triosms.sender');
            $mode = $c->get('triosms.mode');
            $format = $c->get('triosms.format');

            $sms = new TrioSms($url, $token);
            $sms->setSender($sender);
            $sms->setMode($mode);
            $sms->setFormat($format);

            return $sms;
        });
    }
}
