<?php
use ebussola\facebook\ads\adcampaign\AdCampaignHelper;

/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 15:19
 */

class AdSetTest extends AbstractSetUp {

    public function testGetAdSetsFromAccount() {
        $accounts = $this->ads->getAllAccounts();
        $account = $accounts[array_rand($accounts)];

        $adsets = $this->ads->getAdSetsFromAccount($account->id);
        foreach ($adsets as $adset) {
            $this->assertInstanceOf('\ebussola\facebook\ads\AdSet', $adset);
            $this->assertNotNull($adset->id);
        }

        return $adsets;
    }

    /**
     * @depends testGetAdSetsFromAccount
     */
    public function testGetAdSets($adsets) {

        // Test only one campaign request
        $one_adset = current($adsets);
        $adset_id = $one_adset->id;
        $result_adsets = $this->ads->getAdSets(array($adset_id));

        $this->assertCount(1, $result_adsets);
        $this->assertSame($one_adset->id, current($result_adsets)->id);
        $this->assertInstanceOf('\ebussola\facebook\ads\AdSet', current($result_adsets));

        // Test multiple campaigns request
        $adset_ids = \ebussola\facebook\ads\adset\AdSetHelper::extractIds($adsets);
        $result_adsets = $this->ads->getAdSets($adset_ids);

        $this->assertSame(count($adsets), count($result_adsets));
    }

    public function testGetAdSetsFromAdCampaigns() {
        $today = new DateTime('today');
        $migration_date = new DateTime('2014-03-04');
        if ($today >= $migration_date) {
            $accounts = $this->ads->getAllAccounts();
            $account = $accounts[array_rand($accounts)];
        } else {
            $accounts = $this->ads->getAccounts(['act_102151106609752']);
            $account = reset($accounts);
        }

        $adcampaigns = $this->ads->getAdCampaignsFromAccount($account->id);
        $adcampaign_ids = AdCampaignHelper::extractIds($adcampaigns);

        $adcampaign_adsets = $this->ads->getAdSetsFromAdCampaigns($adcampaign_ids);
        foreach ($adcampaign_adsets as $adsets) {
            /** @var \ebussola\facebook\ads\AdSet $adset */
            foreach ($adsets as $adset) {
                $this->assertInstanceOf('\ebussola\facebook\ads\AdSet', $adset);
                $this->assertNotNull($adset->id);
                $this->assertNotNull($adset->name);
                $this->assertNotNull($adset->account_id);
                $this->assertNotNull($adset->budget_remaining);
                $this->assertNotNull($adset->campaign_group_id);
                $this->assertNotNull($adset->campaign_status);
                $this->assertNotNull($adset->created_time);
                $this->assertNotNull($adset->start_time);
                $this->assertNotNull($adset->updated_time);
            }
        }
    }

}