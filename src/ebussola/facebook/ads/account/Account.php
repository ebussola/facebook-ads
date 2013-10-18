<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:31
 */

namespace ebussola\facebook\ads\account;


class Account implements \ebussola\facebook\ads\Account {

    /**
     * @var \stdClass
     */
    private $account;

    public function __construct($account) {
        $this->account = $account;
    }

    public function __get($name) {
        return $this->account->{$name};
    }

    public function __set($name, $value) {
        $this->account->{$name} = $value;
    }

}