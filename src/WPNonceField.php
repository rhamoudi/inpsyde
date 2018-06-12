<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Anissa
 * Date: 12.06.2018
 * Time: 14:17
 */

namespace InpsydeTest;

class WPNonceField implements WPNonceInterface
{

    /**
     * @var string
     */
    protected $action; //Type casting not supported in 7.0

    /**
     * Set the wp nonce action
     *
     * @param string $action
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
     * @param string $action
     * @param int $id
     * @param string $url
     * @return string
     */
    public function createNonce(string $action, int $id, string $url): string
    {
        $actionFormatted = $id === 0 ? $action : $action.'_'.$id;

        $this->changeAction($actionFormatted);

        return 'Field formatted nonce';
    }
}
