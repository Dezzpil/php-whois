<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * User: Nikita Dezzpil Orlov
 * Email: n.dezz.orlov@gmail.com
 * Date: 05.02.14
 * Time: 16:49
 */

class DNSTest extends Unittest_TestCase {

    function provider_domain_form() {
        return array(
            array('http://ya.ru/', 'ya.ru'),
            array('http://ya.ru', 'ya.ru'),
            array('ya.ru/', 'ya.ru'),
            array('ya.ru', 'ya.ru'),
            array('ya.ru/easter/eggs', 'ya.ru')
        );
    }

    /**
     * @param string $domain_name
     * @param string $expect
     * @dataProvider provider_domain_form
     */
    function test_format_domains($domain_name, $expect) {

        $this->assertEquals(
            $expect, DNS::get_host_from_domain($domain_name), $domain_name.'->'.$expect
        );

    }

} 