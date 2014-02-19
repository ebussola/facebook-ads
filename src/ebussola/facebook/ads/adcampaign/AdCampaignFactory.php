<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:34
 */

namespace ebussola\facebook\ads\adcampaign;

use ebussola\facebook\ads\AdCampaign;

class AdCampaignFactory {

    /**
     * @param $campaigns
     *
     * @return AdCampaign[]
     */
    static public function createAdCampaigns(&$campaigns) {
        foreach ($campaigns as &$campaign) {
            $campaign = new \ebussola\facebook\ads\adcampaign\AdCampaign($campaign);
        }

        return $campaigns;
    }

}