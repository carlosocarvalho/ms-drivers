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

$str = 'string file generate';

$settings = new \Modalnetworks\MetaSearch\MetaSearchMappingConfig($mapping['mappings']['abcd']);
$settings->setExtrasMerge(['client_id' => 'token client']);
$driver = (new AbcdDriver($settings, true));


try{
    (new MetaSearchService)->driver($driver)->pushRemote($str, function ($response) {
        dump($response);
    });

}catch(\Exception $e){
   dump($e->getMessage());
}

```