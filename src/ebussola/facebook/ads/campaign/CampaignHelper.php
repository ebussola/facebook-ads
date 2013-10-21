<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 14:32
 */

namespace ebussola\facebook\ads\campaign;

class CampaignHelper {

    /**
     * @param Campaign[] $campaigns
     *
     * @return string[]
     */
    static public function extractIds($campaigns) {
        $campaign_ids = array();
        foreach ($campaigns as $campaign) {
            $campaign_ids[] = $campaign->id;
        }

        return $campaign_ids;
    }

}