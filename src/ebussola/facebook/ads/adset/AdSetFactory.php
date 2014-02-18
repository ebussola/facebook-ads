<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:34
 */

namespace ebussola\facebook\ads\adset;

class AdSetFactory {

    /**
     * @param $adsets
     *
     * @return AdSet[]
     */
    static public function createAdSets(&$adsets) {
        foreach ($adsets as &$adset) {
            $adset = new AdSet($adset);
        }

        return $adsets;
    }

}