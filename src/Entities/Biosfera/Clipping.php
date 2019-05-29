<?php


namespace Modalnetworks\MetaSearch\Entities\Biosfera;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\json_decode;

class Clipping
{

    protected $base_url = 'http://isismyadmin.com/cgi-bin/wxis.exe';

    protected $query_params = [
        'IsisScript' => 'biosfera/search.xis',
        'user' => 'usu_eds',
        'label' => 'redsea'
    ];
    /**
     * @var GuzzleHttp\Client
     */
    protected $httpClient;

    public function addParams($params)
    {
        $this->query_params = array_replace($this->query_params, $params);
        return $this;
    }

    public function  getParams()
    {
        return $this->query_params;
    }

    public static function all()
    {

        $self = new self;
        $client = $self->getClientGuzzle();
        $self->addParams(['expbus' => 'as_gestjur']);
        $response = $client->request('GET', null, [
            'query' => $self->getParams()
        ]);
        $body = $response->getBody()->getContents();
        $decoded = json_decode($body, true);
        $data = $decoded['mfnList'] ?? $decoded['mfnList'];
        return collect($data);
    }

    public static function show($id)
    {
        $self = new self;
        $client = $self->getClientGuzzle();
        $self->addParams(['expbus' => 'id_' . $id, 'label' => 'moses']);
        $response = $client->request('GET', null, [
            'query' => $self->getParams()
        ]);
        $body = preg_replace('#[\r\n]+#','', $response->getBody()->getContents());
        $d = json_clean_decode($body, true);
        return $d;
    }

    /**
     * @return Client|GuzzleHttp\Client
     */
    private function getClientGuzzle()
    {
        if (!$this->httpClient) $this->httpClient = new Client(
            ['base_uri' => $this->base_url]
        );
        return $this->httpClient;
    }
}
