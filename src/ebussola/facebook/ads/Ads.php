<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:02
 */

namespace ebussola\facebook\ads;

use ebussola\facebook\ads\account\AccountFactory;
use ebussola\facebook\ads\pool\AccountPool;
use ebussola\facebook\core\Core;

class Ads {

    /**
     * @var Core
     */
    private $core;

    /**
     * @param Core $core
     */
    public function __construct(Core $core) {
        $this->core = $core;
    }

    /**
     * @return Account[]
     */
    public function getAllAccounts() {
        $fields = Fields::getAccountFields();

        $accounts = $this->core->curl(array('fields' => $fields), '/me/adaccounts', 'get');
        $accounts = isset($accounts->data) ? $accounts->data : $accounts;
        AccountFactory::createAccounts($accounts);

        AccountPool::getInstance()->addAll($accounts);

        return $accounts;
    }

}