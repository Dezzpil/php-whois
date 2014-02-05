<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * User: Nikita Dezzpil Orlov
 * Email: n.dezz.orlov@gmail.com
 * Date: 05.02.14
 * Time: 15:05
 */

/**
 * Class DNS
 */
class DNS {

    /**
     * Get domain in single form - yandex.ru,
     * not 'http://yandex.ru' not 'yandex.ru/' and further
     * @param string $name
     * @return string
     */
    static function get_host_from_domain($name) {
        $list = parse_url($name);
        if (Arr::get($list, 'host')) {
            return $list['host'];
        } else {
            return self::get_host_from_domain('http://'.$name);
        }
    }

    static protected $instances = array();
    static protected $idn = null;

    static function instances($domain) {

        $domain = self::get_host_from_domain($domain);
        self::$idn = self::$idn == null ? new idna_convert() : self::$idn;

        if (Arr::get(self::$instances, $domain) == null) {
            self::$instances[$domain] = new self($domain, new whois());
        }

        return self::$instances[$domain];
    }

    protected $domain;
    protected $whois = null;

    protected function __construct($domain, $whois) {
        $this->domain = $domain;
        $this->whois = $whois;
    }

    /**
     * for Internationalized Domain Names
     * 'россия.рф' -> 'xn--h1alffa9f.xn--p1ai',
     * @return string
     * @throws DNS_Exception
     */
    function idn_encode() {
        $result = self::$idn->encode($this->domain);
        if ($result) {
            $this->domain = $result;
            $this->whois->set_domain($result);
            return $this;
        }

        throw new DNS_Exception(self::$idn->get_last_error());
    }

    /**
     * for Internationalized Domain Names
     * 'xn--h1alffa9f.xn--p1ai' -> 'россия.рф'
     * @return string
     * @throws DNS_Exception
     */
    function idn_decode() {
        $result = self::$idn->decode($this->domain);
        if ($result) {
            $this->domain = $result;
            return $this;
        }

        throw new DNS_Exception(self::$idn->get_last_error());
    }

    /**
     * @return string
     */
    function get_domain() {
        return $this->domain;
    }

    /**
     * @return bool
     */
    function is_valid() {
        return $this->whois->is_valid();
    }

    /**
     * @return bool
     */
    function is_available() {
        return $this->whois->is_available();
    }

    /**
     * @return string
     */
    function info() {
        return $this->whois->info();
    }

}