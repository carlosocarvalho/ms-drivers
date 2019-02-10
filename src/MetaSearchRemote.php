<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 09/02/19
 * Time: 12:36
 */

namespace Modalnetworks\MetaSearch;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class MetaSearchRemote
{

    protected $headers = [];

    protected $options;

    protected $url = 'http://dev.api.metabuscador/v1/documents/';

    /**
     * @var GuzzleHttp\Client
     */
    protected $httpClient;

    public function __construct($options = [], $headers = [])
    {

    }

    /**
     * @param array $data
     * @param \Closure $callback
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function push(array $data, \Closure $callback)
    {
        try {
            $response = $this->getClientGuzzle()->request('POST', $this->url, [
                'json' => $data
            ]);
            $callback($response->getBody());
        }catch (RequestException $e){
            if( $e->hasResponse() )
                 $callback(Psr7\str($e->getResponse()));
        }

    }

    /**
     *
     */
    public function pushBulk()
    {

    }

    /**
     * @return Client|GuzzleHttp\Client
     */
    private function getClientGuzzle(){
       if( ! $this->httpClient ) $this->httpClient = new Client();
       return $this->httpClient;
    }


}