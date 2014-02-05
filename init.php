<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * User: Nikita Dezzpil Orlov
 * Email: n.dezz.orlov@gmail.com
 * Date: 05.02.14
 * Time: 14:32
 */

if ($path = Kohana::find_file('vendor', 'idna_convert', 'php')) {
    include_once $path;
}

if ($path = Kohana::find_file('vendor', 'whois.class', 'php')) {
    include_once $path;
}