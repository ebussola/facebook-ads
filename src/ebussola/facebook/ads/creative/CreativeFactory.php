<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:34
 */

namespace ebussola\facebook\ads\creative;

class CreativeFactory {

    /**
     * @param $creatives
     *
     * @return Creative[]
     */
    static public function createCreative(&$creatives) {
        foreach ($creatives as &$creative) {
            $creative = new Creative($creative);
        }

        return $creatives;
    }

}