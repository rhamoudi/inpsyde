<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Anissa
 * Date: 12.06.2018
 * Time: 12:27
 * PHP Version: 7
 */

namespace InpsydeTest;

/**
 * Interface WPNonceInterface
 */
interface WPNonceInterface
{
    /**
     * @param string $action action identifier
     *
     * @return void
     */
    public function changeAction(string $action);  //:void not in php 7.0 yet

    /**
     * @return string the wp nonce action
     */
    public function action(): string;

     /**
      * Create a wp nonce and returns it's value
      *
      * @param string $action action identifier
      * @param int $id optional id
      * @param string $url optional url
      *
      * @return string
      */
    public function createNonce(string $action, int $id, string $url): string;
}
