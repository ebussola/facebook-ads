<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 14:32
 */

namespace ebussola\facebook\ads\adgroup;

class AdGroupHelper {

    /**
     * @param AdGroup[] $adgroups
     *
     * @return string[]
     */
    static public function extractIds($adgroups) {
        $adgroup_ids = array();
        foreach ($adgroups as $adgroup) {
            $adgroup_ids[] = $adgroup->id;
        }

        return $adgroup_ids;
    }

}