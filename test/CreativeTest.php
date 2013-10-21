<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 18:35
 */

class CreativeTest extends AbstractSetUp {

    public function testGetCreatives() {
        $accounts = $this->ads->getAllAccounts();
        $account = $accounts[array_rand($accounts)];
        $campaigns = $this->ads->getCampaignsFromAccount($account->id);
        $campaign = $campaigns[array_rand($campaigns)];
        $campaign_ad_groups = $this->ads->getAdGroupsFromCampaigns(array($campaign->id));
        /** @var \ebussola\facebook\ads\AdGroup[] $ad_groups */
        $ad_groups = $campaign_ad_groups[array_rand($campaign_ad_groups)];
        $ad_group = $ad_groups[array_rand($ad_groups)];

        $result_creatives = $this->ads->getCreatives($ad_group->creative_ids);

        $this->assertCount(count($ad_group->creative_ids), $result_creatives);
        foreach ($result_creatives as $result_creative) {
            $this->assertInstanceOf('\ebussola\facebook\ads\Creative', $result_creative);
            $this->assertNotNull($result_creative->id);
        }
    }

}
