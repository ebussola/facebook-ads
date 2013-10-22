<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 22/10/13
 * Time: 11:52
 */

class ReportStatsTest extends AbstractSetUp {

    public function testGetSyncReportStats() {
        $accounts = $this->ads->getAllAccounts();
        $account = $accounts[array_rand($accounts)];

        $campaigns = $this->ads->getCampaignsFromAccount($account->id);
        $campaign_ids = \ebussola\facebook\ads\campaign\CampaignHelper::extractIds($campaigns);

        $data_columns = array('campaign_id', 'campaign_name', 'impressions', 'clicks', 'social_impressions',
            'social_clicks', 'unique_impressions', 'unique_clicks', 'unique_social_impressions',
            'unique_social_clicks', 'actions', 'spend');

        $filters = array(
            \ebussola\facebook\ads\ReportStatsHelper::createFilter('campaign_id', 'in', $campaign_ids)
        );

        $time_ranges = \ebussola\facebook\ads\ReportStatsHelper::createDailyTimeRange(new DateTime('today'), new DateTime('today +15 days'));

        $results = $this->ads->getSyncReportStats($account->id, $data_columns, $filters, $time_ranges);

        foreach ($results as $result) {
            $this->assertTrue(in_array($result->campaign_id, $campaign_ids));
        }
    }

}