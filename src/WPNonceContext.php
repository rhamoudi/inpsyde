<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Anissa
 * Date: 12.06.2018
 * Time: 12:27
 */

namespace InpsydeTest;

class WPNonceContext
{
    private $strategy = null;
    protected $errors = false;
    protected $errorMessage;

    /**
     * WPNonceContext constructor.
     * @param string $type the wp nonce type
     */
    public function __construct(string $type = '')
    {
        switch ($type) {
            case 'URL':
                $this->strategy = new WPNonceURL();
                break;
            case 'FIELD':
                $this->strategy = new WPNonceField();
                break;
            default:
                $this->strategy = new WPNonceDefault();
                break;
        }
    }

    /**
     * @return string
     */
    public function action(): string
    {
        return $this->strategy->action();
    }

    /**
     * @param string $action
     */
    public function changeAction(string $action)
    {
        $this->strategy->changeAction($action);
    }

    /**
     * Create a nonce based on the chosen nonce type
     *
     * @param string $action the wp nonce action
     * @param int $id an optional wp nonce id
     * @param string $url when the type is an url this must be set too
     * @return string
     */
    public function createNonce(string $action, int $id = 0, string $url = '') : string
    {
        return $this->strategy->createNonce($action, $id, $url);
    }

    /**
     * Just a mock to verify wether the wp_nonce and nonce action are the same
     *
     * @param $wp_nonce
     * @param $action
     * @return bool
     */
    public function wpVerifyNonce($wp_nonce, $action) : bool
    {
        return $wp_nonce == $action;
    }

    /**
     * Just a mock to verify wether the wp_nonce and nonce action are the same
     *
     * @param $action
     * @param $wp_nonce
     * @return bool
     */
    public function checkAdminReferer($action, $wp_nonce) : bool
    {
        return $wp_nonce == $action;
    }

    /**
     * I put the validation inside the context because it is the same for the other nonce classes. If atleast one of the nonce class would use a different validation method, we can then implement an interface method to validate each nonce class accordingly
     * @param string $type a string that represents wether the validation check should happen on the frontend or backend (wp-admin area)
     * @return boolean
     */
    public function validNonce($type = 'front') : bool
    {
        $errorMessage = 'Your WordPress Nonce is not valid.';
        $nonce = $_POST['_wpnonce']; // Not sanitizing for this test case

        /*
         * If it's not the a front area call it must be inside the WP administration area
         */
        if ($type === 'front') {
            if (! isset($nonce)
                || ! $this->wpVerifyNonce($nonce, $this->action())  ) {
                $this->changeErrors(true);
                $this->changeErrorMessage($errorMessage);
            }
        } elseif($type === 'admin') {
            if (empty($_POST)
                || ! $this->checkAdminReferer($this->Action(), '_wpnonce') ) {
                $this->changeErrors(true);
                $this->changeErrorMessage($errorMessage);
            }
        }

        return $this->errors() !== false;
    }

    /**
     * @param $errors
     */
    public function changeErrors(bool $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @param string $errorMessage
     */
    public function changeErrorMessage(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return boolean
     */
    public function errors() : bool
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function errorMessage() : string
    {
        return $this->errorMessage;
    }
}
