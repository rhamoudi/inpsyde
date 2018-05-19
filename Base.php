<?php
/**
 * Created by PhpStorm.
 * User: rhamo
 * Date: 5/19/2018
 * Time: 12:27 PM
 */

namespace Inpsyde;

/**
 * Class Base
 * @package Inpsyde
 * @description: The base class to generate a WordPress nonce field/value and to check wether this nonce is valid
 */
class Base
{
    protected $wp_nonce;
    protected $action;
    protected $errors;
    protected $error_message;

    public function __construct()
    {
        $this->errors = false;
    }

    /*
     * @return void
     */
    public function createNonce( $action, $id = 0, $url = '', $type = 'string' )
    {

        $action_formatted = $id == 0 ? $action : $action.'_'.$id;

        $this->setAction($action_formatted);

        switch( $type )
        {
            case 'url':
                $this->setNonce( $this->wp_nonce_url( $url, $action_formatted ) );
                break;
            case 'form':
                $this->setNonce( $this->wp_nonce_field( $action_formatted ) );
                break;
            default:
                $this->setNonce( $this->wp_create_nonce( $action_formatted ) );
                break;
        }

    }

    /*
     * These 3 methods are empty for now, we will use the function setAction and getAction to "simulate" a wp_nonce request
     */
    public function wp_nonce_url( $url, $action ){}
    public function wp_nonce_field( $action_formatted ){}
    public function wp_create_nonce( $action_formatted ){}

    /*
     * @return void
     */
    public function setErrors( $errors )
    {
        $this->errors = $errors;
    }

    /*
     * @return void
     */
    public function setErrorMessage( $error_message )
    {
        $this->error_message = $error_message;
    }

    /*
     * @return boolean $errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /*
     * @return string $error_message
     */
    public function getErrorMessage()
    {
        return $this->error_message;
    }

    /*
     * @return void
     */
    public function setAction( $action )
    {
        $this->action = $action;
    }

    /*
     * @return string $action
     */
    public function getAction()
    {
        return $this->action;
    }

    /*
     * @return void
     */
    public function setNonce( $nonce = '' )
    {
        $this->wp_nonce = $nonce;
    }

    /*
     * @return string $wp_nonce
     */
    public function getNonce()
    {
       return $this->wp_nonce;
    }

    public function wp_verify_nonce( $wp_nonce, $action )
    {
        return $wp_nonce == $action;
    }

    public function check_admin_referer( $action, $wp_nonce )
    {
        return $wp_nonce == $action;
    }

    /*
     * @return boolean
     */
    public function validNonce( $type = 'front' )
    {
        $error_message = 'Your WordPress Nonce is not valid.';

        /*
         * If it's not the a front area call it must be inside the WP administration area
         */
        if( $type == 'front' )
        {

            if(  ! isset( $_POST['_wpnonce'] )
                || ! $this->wp_verify_nonce( $_POST['_wpnonce'], $this->getAction() )  )
            {

                $this->setErrors( true );
                $this->setErrorMessage( $error_message );

            }

        } else {

            if ( empty( $_POST )
                || ! $this->check_admin_referer( $this->getAction(), '_wpnonce' ) ) {

                $this->setErrors( true );
                $this->setErrorMessage( $error_message );

            }
        }

        if( $this->getErrors() )
        {

            return false;

        }

        return true;
    }

}