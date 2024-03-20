<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;


class Service
{
    protected ?Client $clientGuzzle;

    function getClientGuzzle($getNewForce = false): Client
        {
            if (empty($this->clientGuzzle) || $getNewForce) {
                $this->clientGuzzle = new Client();
            }
            return $this->clientGuzzle;
        }

    public function getNewRequest(string $method, $uri, array $heders = [], $body = null): Request
    {
        return new Request($method, $uri);
    }
    public function getData(string $prefixFile,string $urlRequest):string
    {
        $fileName = dirname(__DIR__ ,1). '/File/' . date("Y-n-d") . $prefixFile;
        if (file_exists($fileName)) {
            return file_get_contents($fileName);
        }
        $clien= $this->getClientGuzzle();
        $request = $this->getNewRequest('GET', $urlRequest);
        $res= $clien->sendAsync($request)->wait();
        file_put_contents($fileName,(string)$res->getbody());
        return (string)$res->getbody();
    }
}
