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
use ebussola\facebook\ads\campaign\CampaignFactory;
use ebussola\facebook\ads\pool\AccountPool;
use ebussola\facebook\ads\pool\CampaignPool;
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
     * Indexes: account, campaign
     */
    public function __construct(Core $core, $pools=null) {
        $this->core = $core;

        if (!isset($pools['account'])) {
            $pools['account'] = AccountPool::getInstance();
        }
        if (!isset($pools['campaign'])) {
            $pools['campaign'] = CampaignPool::getInstance();
        }

        $this->pools = $pools;
    }

    /**
     * @return Account[]
     */
    public function getAllAccounts() {
        $fields = Fields::getAccountFields();

        $accounts = $this->core->curl(array('fields' => $fields), '/me/adaccounts', 'get');
        $accounts = $accounts->data;
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
            AccountFactory::createAccounts($accounts);

            $this->pools['account']->addAll($accounts);
        }

        return $this->pools['account']->getAllExistents($all_account_ids);
    }

    /**
     * @param string $account_id
     *
     * @return Campaign[]
     */
    public function getCampaignsFromAccount($account_id) {
        $fields = Fields::getCampaignFields();
        $result = $this->core->curl(array('fields' => $fields), '/'.$account_id.'/adcampaigns', 'get');
        $campaigns = $result->data;
        CampaignFactory::createCampaigns($campaigns);

        $this->pools['campaign']->addAll($campaigns);

        return $campaigns;
    }

    /**
     * @param int[] $campaign_ids
     *
     * @return Campaign[]
     */
    public function getCampaigns($campaign_ids) {
        if (is_array($campaign_ids)) {
            $campaign_ids = array_unique($campaign_ids);
        }

        $all_campaign_ids = $campaign_ids;
        $request_campaign_ids = $this->pools['campaign']->getNotHasIds($campaign_ids);

        if (count($request_campaign_ids) > 0) {
            $fields = Fields::getCampaignFields();

            $requests = [];
            foreach ($request_campaign_ids as $campaign_id) {
                $requests[] = $this->core->createRequest(array('fields' => $fields), '/' . $campaign_id, 'get');
            }

            $campaigns = $this->core->batchRequest($requests);
            CampaignFactory::createCampaigns($campaigns);
            $this->pools['campaign']->addAll($campaigns);
        }

        return $this->pools['campaign']->getAllExistents($all_campaign_ids);
    }

}