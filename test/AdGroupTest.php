<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 16:27
 */

class AdGroupTest extends AbstractSetUp {

    public function testGetAdGroupsFromCampaigns() {
        $accounts = $this->ads->getAllAccounts();
        $account = $accounts[array_rand($accounts)];
        $campaigns = $this->ads->getAdSetsFromAccount($account->id);
        $campaign = $campaigns[array_rand($campaigns)];

        $ad_groups = $this->ads->getAdGroupsFromAdSets(array($campaign->id));
        $this->assertArrayHasKey($campaign->id, $ad_groups);
        foreach ($ad_groups[$campaign->id] as $ad_group) {
            $this->assertInstanceOf('\ebussola\facebook\ads\AdGroup', $ad_group);
            $this->assertNotNull($ad_group->id);
        }

        return $ad_groups;
    }

    /**
     * @depends testGetAdGroupsFromCampaigns
     */
    public function testGetAdGroups($ad_groups) {
        $ad_groups = current($ad_groups);

        // Test only one ad_group request
        $one_adgroup = current($ad_groups);
        $adgroup_id = $one_adgroup->id;
        $result_adgroups = $this->ads->getAdGroups(array($adgroup_id));

        $this->assertCount(1, $result_adgroups);
        $this->assertSame($one_adgroup->id, current($result_adgroups)->id);
        $this->assertInstanceOf('\ebussola\facebook\ads\AdGroup', current($result_adgroups));

        // Test multiple ad_groups request
        $adgroup_ids = \ebussola\facebook\ads\adgroup\AdGroupHelper::extractIds($ad_groups);
        $result_adgroups = $this->ads->getAdGroups($adgroup_ids);

        $this->assertSame(count($ad_groups), count($result_adgroups));
    }

}