<?php
/**
 * Created by PhpStorm.
 * User: rhamo
 * Date: 5/19/2018
 * Time: 1:01 PM
 * PHP Version: 7
 */

require './vendor/autoload.php';

use InpsydeTest\WPNonceContext;

/**
 * Class WPNonceTest
 */
class WPNonceTest extends \PHPUnit_Framework_TestCase
{

    public function testWPNonceIsValidFront()
    {

        $context = new WPNonceContext;

        $context->createNonce('test_nonce');

        $_POST['_wpnonce'] = 'test_nonce';

        $this->assertTrue($context->validNonce());

    }

    public function testWPNonceIsNotValidFrontEmptyPost()
    {

        $context = new WPNonceContext;

        $context->createNonce('test_nonce');

        $_POST['_wpnonce'] = '';

        $this->assertFalse($context->validNonce());

    }

    public function testWPNonceIsNotValidFrontWrongNonce()
    {

        $context = new WPNonceContext;

        $context->createNonce('test_nonce');

        $_POST['_wpnonce'] = 'test_nonces_2';

        $this->assertFalse($context->validNonce());

    }

    public function testWPNonceIsValidAdmin()
    {

        $context = new WPNonceContext;

        $context->createNonce('_wpnonce');

        $_POST['_wpnonce'] = '_wpnonce';

        $this->assertTrue($context->validNonce( 'admin' ));

    }

    public function testWPNonceIsNotValidAdminEmptyPost()
    {
        $context = new WPNonceContext;

        $context->createNonce('_wpnonce');

        $_POST['_wpnonce'] = '';

        $this->assertTrue($context->validNonce( 'admin' ));

    }

    public function testWPNonceIsNotValidAdminWrongNonce()
    {

        $context = new WPNonceContext;

        $context->createNonce('test_nonce');

        $_POST['_wpnonce'] = 'test_nonces_2';

        $this->assertFalse($context->validNonce( 'admin' ));

    }
}
