<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 14:32
 */

namespace ebussola\facebook\ads\creative;

class CreativeHelper {

    /**
     * @param Creative[] $creatives
     *
     * @return string[]
     */
    static public function extractIds($creatives) {
        $creative_ids = array();
        foreach ($creatives as $creative) {
            $creative_ids[] = $creative->id;
        }

        return $creative_ids;
    }

}