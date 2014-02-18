<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 14:32
 */

namespace ebussola\facebook\ads\adset;

class AdSetHelper {

    /**
     * @param AdSet[] $campaigns
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