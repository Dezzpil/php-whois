<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * User: Nikita Dezzpil Orlov
 * Email: n.dezz.orlov@gmail.com
 * Date: 05.02.14
 * Time: 15:27
 */

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class whoisTest extends Unittest_TestCase {

    function provider_for_domain_valid() {
        return array(
            array('xn--h1alffa9f.xn--p1ai', TRUE), // россия.рф
            array('xn--d1abbgf6aiiy.xn--p1ai', TRUE), // президент.рф
            array('президент.рф', FALSE),
            array('yandex.ru', TRUE),
            array('ya.xn--p1ai', TRUE),
            array('ru.xn--p1ai', TRUE)
        );
    }

    /**
     * @param string $name
     * @param bool $expected
     * @dataProvider provider_for_domain_valid
     */
    function test_whois_valid($name, $expected) {
        $this->assertEquals(
            $expected, DNS::instances($name)->is_valid(), $name
        );
    }

    function provider_for_domain_free() {
        return array(
            array('xn--h1alffa9f.xn--p1ai', FALSE), // россия.рф
            array('100.xn--p1ai', FALSE), // 100.рф
            array('ya.xn--p1ai', TRUE), // not valid
            array('xn--d1abbgf6aiiy.xn--p1ai', FALSE), // президент.рф
            array('xn--108-8cdamlk0a2alo7d0c.xn--p1ai', TRUE), // 108далматинцев.рф
        );
    }

    /**
     *
     * @param string $name
     * @param bool $expected
     * @dataProvider provider_for_domain_free
     */
    function test_whois_available($name, $expected) {

        $this->assertEquals(
            $expected, DNS::instances($name)->is_available(), $name
        );
    }

    function provider_for_domain_info() {
        return array(
            array('ya.ru'), array('yandex.ru'),
            array('google.com'), array('goo.gl'),
            array('xn--d1abbgf6aiiy.xn--p1ai')
        );
    }

    /**
     * @param $name
     * @dataProvider provider_for_domain_info
     */
    function test_whois_info($name) {
        $this->assertNotEmpty(DNS::instances($name)->info(), $name);
    }

}