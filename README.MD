### Driver para Metabuscador

> Esse driver deve ser usando em conjunto com o sistema de metabuscador
>

[![Latest Stable Version](https://poser.pugx.org/modalnetworks/metasearch-drivers/v/stable)](https://packagist.org/packages/modalnetworks/metasearch-drivers) 
[![Total Downloads](https://poser.pugx.org/modalnetworks/metasearch-drivers/downloads)](https://packagist.org/packages/modalnetworks/metasearch-drivers)
[![Latest Unstable Version](https://poser.pugx.org/modalnetworks/metasearch-drivers/v/unstable)](https://packagist.org/packages/modalnetworks/metasearch-drivers)
[![License](https://poser.pugx.org/modalnetworks/metasearch-drivers/license)](https://packagist.org/packages/modalnetworks/metasearch-drivers)
[![Monthly Downloads](https://poser.pugx.org/modalnetworks/metasearch-drivers/d/monthly)](https://packagist.org/packages/modalnetworks/metasearch-drivers)
[![Daily Downloads](https://poser.pugx.org/modalnetworks/metasearch-drivers/d/daily)](https://packagist.org/packages/modalnetworks/metasearch-drivers)
[![composer.lock](https://poser.pugx.org/modalnetworks/metasearch-drivers/composerlock)](https://packagist.org/packages/modalnetworks/metasearch-drivers)

#### Instalaçao

```php
composer require modalnetworks/metasearch-drivers
```

```php
use Modalnetworks\MetaSearch\Drivers\AbcdDriver;
use Modalnetworks\MetaSearch\MetaSearchService;

$str = 'index|CLIPPINGS||type|CLIPPING||thumbnail|http://www.deloittetaxks.com.br/abcd/digital/EstudosDTT/capa//os-poderosos-industria-comercio-2014.jpg||987|CL20170530141451||777|20150318||901A|todos||digital|http://www.deloittetaxks.com.br/abcd/digital/EstudosDTT/os-poderosos-industria-bens-consumo.pdf||16|CLIPPING||245A|Os poderosos da indústria de bens de consumo||245B|o consumidor conectado em constante evolução||591|As perspectivas econômicas dos principais mercados e o impacto potencial sobre as empresas de bens de consumo. Esta é uma visão que serve de referência, uma vez que decisões políticas inesperadas, tomadas por líderes ou  eleitores, podem relegar certas previsões à lata do lixo. Esperamos que as informações e dados apontados a seguir ofereçam um importante guia para tomada de decisão.||697|Tendências globais; Fusões e aquisições; Bens de consumo||856B|os-poderosos-industria-bens-consumo.pdf||903|estudo||973|ARTIGO||991|Os poderosos da indústria de bens de consumo; o consumidor conectado em constante evolução||995|2015||996|03||997|18||999|<strong>Os poderosos da indústria de bens de consumo: o consumidor conectado em constante evolução. </strong>18.03.2015||';

$settings = new \Modalnetworks\MetaSearch\MetaSearchMappingConfig($mapping['mappings']['abcd']);
$settings->setExtrasMerge(['client_id' => '075f8741-4de4-45be-bf2c-6c306b4e363c']);
$driver = (new AbcdDriver($settings, true));


try{
    (new MetaSearchService)->driver($driver)->pushRemote($str, function ($response) {
        dump($response);
    });

}catch(\Exception $e){
   dump($e->getMessage());
}

```