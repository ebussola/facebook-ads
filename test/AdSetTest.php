<?php
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

        $campaigns = $this->ads->getAdSetsFromAccount($account->id);
        foreach ($campaigns as $campaign) {
            $this->assertInstanceOf('\ebussola\facebook\ads\AdSet', $campaign);
            $this->assertNotNull($campaign->id);
        }

        return $campaigns;
    }

    /**
     * @depends testGetAdSetsFromAccount
     */
    public function testGetAdSets($campaigns) {

        // Test only one campaign request
        $one_campaign = current($campaigns);
        $campaign_id = $one_campaign->id;
        $result_campaigns = $this->ads->getAdSets(array($campaign_id));

        $this->assertCount(1, $result_campaigns);
        $this->assertSame($one_campaign->id, current($result_campaigns)->id);
        $this->assertInstanceOf('\ebussola\facebook\ads\AdSet', current($result_campaigns));

        // Test multiple campaigns request
        $campaign_ids = \ebussola\facebook\ads\campaign\AdSetHelper::extractIds($campaigns);
        $result_campaigns = $this->ads->getAdSets($campaign_ids);

        $this->assertSame(count($campaigns), count($result_campaigns));
    }

}