<?php


namespace Modalnetworks\MetaSearch\Entities\Deloitte;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\json_decode;

class TaxHand
{

    protected $base_url = 'https://www.taxathand.com/api/tax/v1/articles/~';

    protected $query_params = [
        'countryFilterPath' => 'Brazil'
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
        $self->addParams([
            'completeArticleResponse' => 'false',
            'limit' => 2,
            'offset' => 0]);
        $response = $client->request('GET', null, [
            'query' => $self->getParams()
        ]);
        $body = $response->getBody()->getContents();
        $decoded = json_decode($body, true);
        $data = $decoded['articles'] ?? $decoded['articles'];
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
