<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:34
 */

namespace ebussola\facebook\ads\account;

class AccountFactory {

    /**
     * @param $accounts
     *
     * @return Account[]
     */
    static public function createAccounts(&$accounts) {
        foreach ($accounts as &$account) {
            $account = new Account($account);
        }

        return $accounts;
    }

}