<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:34
 */

namespace ebussola\facebook\ads\adgroup;

class AdGroupFactory {

    /**
     * @param $adgroups
     *
     * @return AdGroup[]
     */
    static public function createAdGroups(&$adgroups) {
        foreach ($adgroups as &$adgroup) {
            $adgroup = new AdGroup($adgroup);
        }

        return $adgroups;
    }

}