# Kohana-php-whois

Kohana Whois module based on php-whois (https://github.com/regru/php-whois)

## Example of usage

```php

<?php

$domain_name = 'reg.ru';

$domain = new whois( $domain_name );
$whois_answer = $domain->info();

echo $whois_answer;

if ($domain->is_available()) {
    echo "Domain is available\n";
} else {
    echo "Domain is registered\n";
}

```

