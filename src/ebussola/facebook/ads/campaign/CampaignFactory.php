<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:34
 */

namespace ebussola\facebook\ads\campaign;

class CampaignFactory {

    /**
     * @param $campaigns
     *
     * @return Campaign[]
     */
    static public function createCampaigns(&$campaigns) {
        foreach ($campaigns as &$campaign) {
            $campaign = new Campaign($campaign);
        }

        return $campaigns;
    }

}