<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 15:19
 */

class CampaignTest extends AbstractSetUp {

    public function testGetCampaignsFromAccount() {
        $accounts = $this->ads->getAllAccounts();
        $account = $accounts[array_rand($accounts)];

        $campaigns = $this->ads->getCampaignsFromAccount($account->id);
        foreach ($campaigns as $campaign) {
            $this->assertInstanceOf('\ebussola\facebook\ads\Campaign', $campaign);
            $this->assertNotNull($campaign->id);
        }

        return $campaigns;
    }

    /**
     * @depends testGetCampaignsFromAccount
     */
    public function testGetCampaigns($campaigns) {

        // Test only one campaign request
        $one_campaign = current($campaigns);
        $campaign_id = $one_campaign->id;
        $result_campaigns = $this->ads->getCampaigns(array($campaign_id));

        $this->assertCount(1, $result_campaigns);
        $this->assertSame($one_campaign->id, current($result_campaigns)->id);
        $this->assertInstanceOf('\ebussola\facebook\ads\Campaign', current($result_campaigns));

        // Test multiple campaigns request
        $campaign_ids = \ebussola\facebook\ads\campaign\CampaignHelper::extractIds($campaigns);
        $result_campaigns = $this->ads->getCampaigns($campaign_ids);

        $this->assertSame(count($campaigns), count($result_campaigns));
    }

}