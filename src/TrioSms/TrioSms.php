<?php namespace i906\TrioSms;

use GuzzleHttp\Client;

class TrioSms
{

    const MODE_SHORT = 'shortcode';
    const MODE_LONG = 'longcode';

    const FORMAT_ASCII = 1;
    const FORMAT_UNICODE = 4;

    private $client;

    private $url;
    private $token;

    private $format;
    private $sender;
    private $mode;

    /**
     * TrioSms constructor.
     * @param $url
     * @param $token
     */
    public function __construct($url, $token)
    {
        $this->url = $url;
        $this->token = $token;
        $this->client = new Client();
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @param mixed $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @param mixed $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function balance($mode = self::MODE_SHORT)
    {
        $response = $this->client->createRequest('GET', $this->getUrl(), [
            'api_key' => $this->token,
            'action' => 'bal_check',
            'mode' => $mode,
        ]);

        return $response->getBody();
    }

    public function send($recipient, $message, $mode = self::MODE_SHORT, $format = self::FORMAT_ASCII)
    {
        $response = $this->client->createRequest('GET', $this->getUrl(), [
            'api_key' => $this->token,
            'action' => 'send',
            'to' => $recipient,
            'msg' => $message,
            'sender_id' => $this->sender,
            'content_type' => $format,
            'mode' => $mode,
        ]);

        return $response->getBody();
    }

    private function getUrl()
    {
        return $this->url . 'index.php/api/bulk_mt';
    }
}
