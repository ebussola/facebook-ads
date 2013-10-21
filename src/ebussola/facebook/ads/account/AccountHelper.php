<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 14:32
 */

namespace ebussola\facebook\ads\account;

class AccountHelper {

    /**
     * @param Account[] $accounts
     *
     * @return string[]
     */
    static public function extractIds($accounts) {
        $account_ids = array();
        foreach ($accounts as $account) {
            $account_ids[] = $account->id;
        }

        return $account_ids;
    }

}