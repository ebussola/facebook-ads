<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 17/02/14
 * Time: 11:24
 */

class NewStructureTest extends AbstractSetUp {

    public function testAdSet() {
        // account elected to test the new structure before the facebook's migration date (today 2014-02-17)
        $adsets = $this->ads->getAdSetsFromAccount('act_102151106609752');
        foreach ($adsets as $adset) {
            $this->assertInstanceOf('\ebussola\facebook\ads\AdSet', $adset);
        }

        $adset_ids = \ebussola\facebook\ads\campaign\AdSetHelper::extractIds($adsets);
        $adset_adgroups = $this->ads->getAdGroupsFromAdSets($adset_ids);
        foreach ($adset_adgroups as $adgroups) {
            foreach ($adgroups as $adgroup) {
                $this->assertInstanceOf('\ebussola\facebook\ads\AdGroup', $adgroup);
            }
        }
    }

}