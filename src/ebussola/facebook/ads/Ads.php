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
use ebussola\facebook\ads\adcampaign\AdCampaign;
use ebussola\facebook\ads\adcampaign\AdCampaignFactory;
use ebussola\facebook\ads\adgroup\AdGroupFactory;
use ebussola\facebook\ads\adset\AdSetFactory;
use ebussola\facebook\ads\creative\CreativeFactory;
use ebussola\facebook\ads\pool\AccountPool;
use ebussola\facebook\ads\pool\AdCampaignPool;
use ebussola\facebook\ads\pool\AdGroupPool;
use ebussola\facebook\ads\pool\AdSetPool;
use ebussola\facebook\ads\pool\CreativePool;
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
        if (!isset($pools['adset'])) {
            $pools['adset'] = AdSetPool::getInstance();
        }
        if (!isset($pools['adgroup'])) {
            $pools['adgroup'] = AdGroupPool::getInstance();
        }
        if (!isset($pools['creative'])) {
            $pools['creative'] = CreativePool::getInstance();
        }
        if (!isset($pools['ad_campaign'])) {
            $pools['ad_campaign'] = AdCampaignPool::getInstance();
        }

        $this->pools = $pools;
    }

    /**
     * @return Account[]
     */
    public function getAllAccounts() {
        $fields = Fields::getAccountFields();

        $accounts = $this->core->curl(array('fields' => $fields), '/me/adaccounts', 'get');
        /** @noinspection PhpUndefinedFieldInspection */
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
     * @return AdCampaign[]
     */
    public function getAdCampaignsFromAccount($account_id) {
        $fields = Fields::getAdCampaignFields();
        $result = $this->core->curl(array('fields' => $fields), '/'.$account_id.'/adcampaign_groups', 'get');
        /** @noinspection PhpUndefinedFieldInspection */
        $adcampaigns = $result->data;
        AdCampaignFactory::createAdCampaigns($adcampaigns);
        
        $this->pools['ad_campaign']->addAll($adcampaigns);
        
        return $adcampaigns;
    }

    /**
     * @param string[] $adcampaign_ids
     *
     * @return AdCampaign[]
     */
    public function getAdCampaigns(array $adcampaign_ids) {
        $adcampaign_ids = array_unique($adcampaign_ids);

        $all_adcampaign_ids = $adcampaign_ids;
        $adcampaign_ids = $this->pools['ad_campaign']->getNotHasIds($adcampaign_ids);

        if (count($adcampaign_ids) > 0) {
            $fields = Fields::getAdCampaignFields();

            $requests = array();
            foreach ($adcampaign_ids as $adcampaign_id) {
                $requests[] = $this->core->createRequest(array('fields' => $fields), '/' . $adcampaign_id, 'get');
            }
            $adcampaigns = $this->core->batchRequest($requests);
            AdCampaignFactory::createAdCampaigns($adcampaigns);
            $this->pools['ad_campaign']->addAll($adcampaigns);
        }

        return $this->pools['ad_campaign']->getAllExistents($all_adcampaign_ids);
    }

    /**
     * @param string $account_id
     *
     * @return AdSet[]
     */
    public function getAdSetsFromAccount($account_id) {
        $fields = Fields::getAdSetFields();
        $result = $this->core->curl(array('fields' => $fields), '/'.$account_id.'/adcampaigns', 'get');
        /** @noinspection PhpUndefinedFieldInspection */
        $adsets = $result->data;
        AdSetFactory::createAdSets($adsets);

        $this->pools['adset']->addAll($adsets);

        return $adsets;
    }

    /**
     * @param int[] $campaign_ids
     *
     * @return AdSet[]
     */
    public function getAdSetsFromAdCampaigns($campaign_ids) {
        $fields = Fields::getAdSetFields();

        $requests = array();
        foreach ($campaign_ids as $campaign_id) {
            $requests[] = $this->core->createRequest(array('fields' => $fields), '/'.$campaign_id.'/adcampaigns', 'get');
        }
        $campaign_adsets = $this->core->batchRequest($requests);

        $result = [];
        foreach ($campaign_adsets as &$adsets) {
            if (count($adsets->data) > 0) {
                $adsets = $adsets->data;
                AdSetFactory::createAdSets($adsets);
                $result[$adsets[0]->campaign_group_id] = $adsets;
            }
        }

        foreach ($result as $adsets) {
            $this->pools['adset']->addAll($adsets);
        }

        return $result;
    }

    /**
     * @param int[] $adset_ids
     *
     * @return AdSet[]
     */
    public function getAdSets($adset_ids) {
        if (is_array($adset_ids)) {
            $adset_ids = array_unique($adset_ids);
        }

        $all_adset_ids = $adset_ids;
        $request_adset_ids = $this->pools['adset']->getNotHasIds($adset_ids);

        if (count($request_adset_ids) > 0) {
            $fields = Fields::getAdSetFields();

            $requests = [];
            foreach ($request_adset_ids as $adset_id) {
                $requests[] = $this->core->createRequest(array('fields' => $fields), '/' . $adset_id, 'get');
            }

            $adsets = $this->core->batchRequest($requests);
            AdSetFactory::createAdSets($adsets);
            $this->pools['adset']->addAll($adsets);
        }

        return $this->pools['adset']->getAllExistents($all_adset_ids);
    }

    /**
     * @param string[] $adset_ids
     *
     * @return array
     * key = campaign_id
     * value = AdGroup[]
     */
    public function getAdGroupsFromAdSets($adset_ids) {
        $fields = Fields::getAdGroupFields();

        $requests = [];
        foreach ($adset_ids as $adset_id) {
            $requests[] = $this->core->createRequest(array('fields' => $fields), '/'.$adset_id.'/adgroups', 'get');
        }

        $adset_ad_groups = $this->core->batchRequest($requests);

        $result = [];
        foreach ($adset_ad_groups as &$ad_groups) {
            if (count($ad_groups->data) > 0) {
                $ad_groups = $ad_groups->data;
                AdGroupFactory::createAdGroups($ad_groups);
                $result[$ad_groups[0]->campaign_id] = $ad_groups;
            }
        }

        foreach ($result as $ad_groups) {
            $this->pools['adgroup']->addAll($ad_groups);
        }

        return $result;
    }

    /**
     * @param int[] $ad_group_ids
     *
     * @return AdGroup[]
     */
    public function getAdGroups($ad_group_ids) {
        if (is_array($ad_group_ids)) {
            $ad_group_ids = array_unique($ad_group_ids);
        }

        $all_ad_group_ids = $ad_group_ids;
        $request_ad_group_ids = $this->pools['adgroup']->getNotHasIds($ad_group_ids);

        if (count($request_ad_group_ids) > 0) {
            $fields = Fields::getAdGroupFields();

            $requests = [];
            foreach ($request_ad_group_ids as $ad_group_id) {
                $requests[] = $this->core->createRequest(array('fields' => $fields), '/' . $ad_group_id, 'get');
            }

            $ad_groups = $this->core->batchRequest($requests);
            AdGroupFactory::createAdGroups($ad_groups);
            $this->pools['adgroup']->addAll($ad_groups);
        }

        return $this->pools['adgroup']->getAllExistents($all_ad_group_ids);
    }

    /**
     * @param string[] $creative_ids
     *
     * @return array
     */
    public function getCreatives($creative_ids) {
        if (is_array($creative_ids)) {
            $creative_ids = array_unique($creative_ids);
        }

        $all_creative_ids = $creative_ids;
        $request_creative_ids = $this->pools['creative']->getNotHasIds($creative_ids);

        if (count($request_creative_ids) > 0) {
            $fields = Fields::getCreativeFields();

            $requests = [];
            foreach ($request_creative_ids as $creative_id) {
                $requests[] = $this->core->createRequest(array('fields' => $fields), '/' . $creative_id, 'get');
            }

            $creatives = $this->core->batchRequest($requests);
            CreativeFactory::createCreative($creatives);
            $this->pools['creative']->addAll($creatives);
        }

        return $this->pools['creative']->getAllExistents($all_creative_ids);
    }

    /**
     * @param string    $account_id
     * @param array     $data_columns
     * @param array     $filters
     * @param \DateTime $start_date
     * @param \DateTime $end_date
     *
     * @return array
     */
    public function getReportStats($account_id, array $data_columns, array $filters, \DateTime $start_date,
                                   \DateTime $end_date) {

        $account_id = $this->fixAccountId($account_id);

        $this->fixTimezone($account_id, $start_date);
        $this->fixTimezone($account_id, $end_date);
        $end_date = clone $end_date;
        $end_date->add(new \DateInterval('P1D'));

        $time_ranges = ReportStatsHelper::createPeriodTimeRange($start_date, $end_date);

        return $this->getSyncReportStats($account_id, $data_columns, $filters, $time_ranges);
    }

    /**
     * @param string    $account_id
     * @param array     $data_columns
     * @param array     $filters
     * @param \DateTime $start_date
     * @param \DateTime $end_date
     *
     * @see ReportStatsHelper::createFilter
     *
     * @return array
     */
    public function getDailyReportStats($account_id, array $data_columns, array $filters, \DateTime $start_date,
                                        \DateTime $end_date) {

        $account_id = $this->fixAccountId($account_id);

        $this->fixTimezone($account_id, $start_date);
        $this->fixTimezone($account_id, $end_date);
        $end_date = clone $end_date;
        $end_date->add(new \DateInterval('P1D'));

        $time_ranges = ReportStatsHelper::createDailyTimeRange($start_date, $end_date);

        return $this->getSyncReportStats($account_id, $data_columns, $filters, $time_ranges);
    }

    /**
     * @param string      $account_id
     *
     * @param array $data_columns
     *
     * @param array $filters
     * @see ReportStatsHelper::createFilter
     *
     * @param array $time_ranges
     * @see ReportStatsHelper::createPeriodTimeRange
     * @see ReportStatsHelper::createDailyTimeRange
     *
     * @return array
     */
    public function getSyncReportStats($account_id, array $data_columns, array $filters, array $time_ranges) {
        $job_id = $this->createAsyncReportStats($account_id, $data_columns, $filters, $time_ranges);
        while (!$this->isJobCompleted($job_id)) {
            usleep(rand(1000, 1000000));
        }

        return $this->getJobResult($account_id, $job_id);
    }

    /**
     * Fix timezone according to account configuration
     *
     * @param string   $account_id
     * @param \DateTime $date_time
     */
    public function fixTimezone($account_id, \DateTime $date_time) {
        /** @var Account $account */
        $account = reset($this->getAccounts(array($account_id)));
        $date_time->setTimezone(new \DateTimeZone($account->timezone_name));
    }

    /**
     * @param string $account_id
     *
     * @param array  $data_columns
     *
     * @param array  $filters
     * @see ReportStatsHelper::createFilter
     *
     * @param array  $time_ranges
     * @see ReportStatsHelper::createPeriodTimeRange
     * @see ReportStatsHelper::createDailyTimeRange
     *
     * @return string
     * Job ID
     *
     * @throws \Exception
     */
    private function createAsyncReportStats($account_id, array $data_columns, array $filters, array $time_ranges) {
        $account_id = $this->fixAccountId($account_id);

        $data = array(
            'async' => true,
            'time_ranges' => $time_ranges,
            'data_columns' => $data_columns,
            'filters' => $filters,
            'limit' => 999999,
            'actions_group_by' => array('action_type')
        );

        $result = $this->core->curl($data, $account_id.'/reportstats', 'post');

        return $result;
    }

    /**
     * @param string $job_id
     *
     * @return bool
     */
    private function isJobCompleted($job_id) {
        $result = $this->core->curl(array(), '/'.$job_id, 'get');

        /** @noinspection PhpUndefinedFieldInspection */
        return ($result->async_percent_completion == 100 && $result->async_status == 'Job Completed');
    }

    /**
     * @param string $job_id
     *
     * @return array
     *
     * @throws \Exception
     */
    private function getJobResult($account_id, $job_id) {
        $account_id = $this->fixAccountId($account_id);

        $data = array(
            'report_run_id' => $job_id,
            'limit' => 5000
        );
        $result = $this->core->curl($data, '/'. $account_id.'/reportstats', 'get');

        if (!isset($result->data)) {
            throw new \Exception('something went wrong :(');
        }

        return $result->data;
    }

    /**
     * @param string $account_id
     *
     * @return string
     */
    private function fixAccountId($account_id) {
        if (substr($account_id, 0, 4) != 'act_') {
            $account_id = 'act_'.$account_id;
        }

        return $account_id;
    }

}