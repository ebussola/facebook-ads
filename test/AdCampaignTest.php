<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 18/02/14
 * Time: 18:10
 */

class AdCampaignTest extends AbstractSetUp {

    public function testGetAdCampaignsFromAccount() {
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
        foreach ($adcampaigns as $adcampaign) {
            $this->assertInstanceOf('\ebussola\facebook\ads\AdCampaign', $adcampaign);
            $this->assertNotNull($adcampaign->id);
            $this->assertNotNull($adcampaign->account_id);
            $this->assertNotNull($adcampaign->campaign_group_status);
            $this->assertNotNull($adcampaign->name);
            $this->assertNotNull($adcampaign->objective);
        }
    }

}