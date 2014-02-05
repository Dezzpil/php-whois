# Kohana-php-whois

Kohana Whois module based on php-whois (https://github.com/regru/php-whois)
with adding idna_convert class

## Example of usage

```php

<?php

$dns = DNS::instances('ya.ru');
var_dump($dns->info());                 // get info from whois server
var_dump($dbs->is_available());         // get is free or busy

$dns = DNS::instances('президент.рф');
echo $dns->idn_encode()->get_domain();  // get domain as ACE string

```
