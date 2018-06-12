<?php
/**
 * Created by PhpStorm.
 * User: rhamo
 * Date: 5/19/2018
 * Time: 1:01 PM
 */

require './vendor/autoload.php';

use InpsydeTest\WPNonceContext;

class WPNonceTest extends \PHPUnit_Framework_TestCase
{

    public function testWPNonceIsValidFront()
    {

        $context = new WPNonceContext;

        $context->createNonce('test_nonce');

        $_POST['_wpnonce'] = 'test_nonce';

        $this->assertFalse($context->validNonce() !== false);

    }

    public function testWPNonceIsNotValidFrontEmptyPost()
    {

        $context = new WPNonceContext;

        $context->createNonce('test_nonce');

        $_POST['_wpnonce'] = '';

        $this->assertFalse($context->validNonce() === false);

    }

    public function testWPNonceIsNotValidFrontWrongNonce()
    {

        $context = new WPNonceContext;

        $context->createNonce('test_nonce');

        $_POST['_wpnonce'] = 'test_nonces_2';

        $this->assertFalse($context->validNonce() === false);

    }

    public function testWPNonceIsValidAdmin()
    {

        $context = new WPNonceContext;

        $context->createNonce('_wpnonce');

        $_POST['_wpnonce'] = '_wpnonce';

        $this->assertFalse($context->validNonce( 'admin' ) !== false);

    }

    public function testWPNonceIsNotValidAdminEmptyPost()
    {
        $context = new WPNonceContext;

        $context->createNonce('_wpnonce');

        $_POST['_wpnonce'] = '';

        $this->assertTrue($context->validNonce( 'admin' ) === false);

    }

    public function testWPNonceIsNotValidAdminWrongNonce()
    {

        $context = new WPNonceContext;

        $context->createNonce('test_nonce');

        $_POST['_wpnonce'] = 'test_nonces_2';

        $this->assertFalse($context->validNonce( 'admin' ) === false);

    }
}
