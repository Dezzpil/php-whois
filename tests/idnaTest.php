<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * User: Nikita Dezzpil Orlov
 * Email: n.dezz.orlov@gmail.com
 * Date: 05.02.14
 * Time: 15:27
 */

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class idnaTest extends Unittest_TestCase {

    function provider_encode() {
        return array(
            array('xn--h1alffa9f.xn--p1ai', 'россия.рф'),
            array('xn--80aqf4a0a.xn--p1ai', 'тачки.рф'),
            array('100.xn--p1ai', '100.рф'),
            array('xn--108-8cdamlk0a2alo7d0c.xn--p1ai', '108далматинцев.рф')
        );
    }

    /**
     * @dataProvider provider_encode
     */
    function test_idna_encode($name_i18n, $name_utf8) {

        $this->assertEquals(
            DNS::instances($name_utf8)->idn_encode(), $name_i18n
        );

    }

    /**
     * @dataProvider provider_encode
     */
    function test_idna_decode($name_i18n, $name_utf8) {

        $this->assertEquals(
            DNS::instances($name_i18n)->idn_decode(), $name_utf8
        );

    }

}