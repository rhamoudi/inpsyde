<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Anissa
 * Date: 12.06.2018
 * Time: 12:27
 */

namespace InpsydeTest;

interface WPNonceInterface
{
    public function changeAction(string $action);  //: void is not yet introduced in php 7.0
    public function action() : string;
    public function createNonce(string $action, int $id, string $url) : string;
}
