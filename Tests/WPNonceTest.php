<?php
/**
 * Created by PhpStorm.
 * User: rhamo
 * Date: 5/19/2018
 * Time: 1:01 PM
 */

namespace rhamoudi\Inpsyde\Tests;

use Inpsyde\Base;

require __DIR__ . "/../Base.php";

class WPNonceTest extends \PHPUnit_Framework_TestCase
{

    public function testWPNonceIsValidFront()
    {

        $base = new Base;

        $base->createNonce('test_nonce');

        $_POST['_wpnonce'] = 'test_nonce';

        $this->assertTrue($base->validNonce() !== false);

    }

    public function testWPNonceIsNotValidFrontEmptyPost()
    {

        $base = new Base;

        $base->createNonce('test_nonce');

        $this->assertTrue($base->validNonce() === false);

    }

    public function testWPNonceIsNotValidFrontWrongNonce()
    {

        $base = new Base;

        $base->createNonce('test_nonce');

        $_POST['_wpnonce'] = 'test_nonces_2';

        $this->assertTrue($base->validNonce() === false);

    }

    public function testWPNonceIsValidAdmin()
    {

        $base = new Base;

        $base->createNonce('_wpnonce');

        $_POST['_wpnonce'] = '_wpnonce';

        $this->assertTrue($base->validNonce( 'admin' ) !== false);

    }

    public function testWPNonceIsNotValidAdminEmptyPost()
    {
        $base = new Base;

        $base->createNonce('_wpnonce');

        $this->assertTrue($base->validNonce( 'admin' ) === false);

    }

    public function testWPNonceIsNotValidAdminWrongNonce()
    {

        $base = new Base;

        $base->createNonce('test_nonce');

        $_POST['_wpnonce'] = 'test_nonces_2';

        $this->assertTrue($base->validNonce( 'admin' ) === false);

    }
}
