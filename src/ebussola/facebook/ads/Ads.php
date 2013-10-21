<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:02
 */

namespace ebussola\facebook\ads;

use ebussola\common\pool\Pool;
use ebussola\facebook\ads\account\AccountFactory;
use ebussola\facebook\ads\pool\AccountPool;
use ebussola\facebook\core\Core;

class Ads {

    /**
     * @var Core
     */
    private $core;

    /**
     * @var Pool[]
     */
    private $pools;

    /**
     * @param Core $core
     *
     * @param null | Pool[] $pools
     * ObjectPools for performance improvement
     * Indexes: account
     */
    public function __construct(Core $core, $pools=null) {
        $this->core = $core;

        if (!isset($pools['account'])) {
            $pools['account'] = AccountPool::getInstance();
        }

        $this->pools = $pools;
    }

    /**
     * @return Account[]
     */
    public function getAllAccounts() {
        $fields = Fields::getAccountFields();

        $accounts = $this->core->curl(array('fields' => $fields), '/me/adaccounts', 'get');
        $accounts = isset($accounts->data) ? $accounts->data : $accounts;
        AccountFactory::createAccounts($accounts);

        $this->pools['account']->addAll($accounts);

        return $accounts;
    }

    /**
     * @see https://developers.facebook.com/docs/reference/ads-api/adaccount/
     *
     * @param string[] $account_ids
     *
     * @return Account[]
     */
    public function getAccounts($account_ids) {
        if (is_array($account_ids)) {
            $account_ids = array_unique($account_ids);
        }

        $all_account_ids = $account_ids;
        $request_account_ids = $this->pools['account']->getNotHasIds($account_ids);

        if (count($request_account_ids) > 0) {
            $fields = Fields::getAccountFields();

            $requests = [];
            foreach ($request_account_ids as $account_id) {
                $requests[] = $this->core->createRequest(array('fields' => $fields), '/' . $account_id, 'get');
            }

            $accounts = $this->core->batchRequest($requests);
            $accounts = isset($accounts->data) ? $accounts->data : $accounts;
            AccountFactory::createAccounts($accounts);

            $this->pools['account']->addAll($accounts);
        }

        return $this->pools['account']->getAllExistents($all_account_ids);
    }

}