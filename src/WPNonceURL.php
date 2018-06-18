<?php declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: Anissa
 * Date: 12.06.2018
 * Time: 14:17
 * PHP Version: 7
 */

namespace InpsydeTest;

/**
 * WP Nonce Strategy Type
 */
class WPNonceURL implements WPNonceInterface
{
    /*
     * @var string
     */
    protected $action; //Type casting not supported in 7.0

    /**
     * Set the wp nonce action
     *
     * @param string $action action identifier
     *
     * @return void
     */
    public function changeAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * Return the wp nonce action
     *
     * @return string
     */
    public function action(): string
    {
        return $this->action;
    }

    /**
     * Create a wp nonce and returns it's value
     *
     * @param string $action action identifier
     * @param int    $id     optional id
     * @param string $url    optional url
     *
     * @return string
     */
    public function createNonce(string $action, int $id, string $url): string
    {
        $actionFormatted = $id === 0 ? $action : $action.'_'.$id;

        $this->changeAction($action);

        return 'URL formatted nonce: '.$actionFormatted;
    }
}
