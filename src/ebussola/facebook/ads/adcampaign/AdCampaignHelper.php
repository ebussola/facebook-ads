<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 14:32
 */

namespace ebussola\facebook\ads\adcampaign;

class AdCampaignHelper {

    /**
     * @param \ebussola\facebook\ads\AdCampaign[] $adcampaigns
     *
     * @return string[]
     */
    static public function extractIds($adcampaigns) {
        $adcampaign_ids = array();
        foreach ($adcampaigns as $adcampaign) {
            $adcampaign_ids[] = $adcampaign->id;
        }

        return $adcampaign_ids;
    }

}