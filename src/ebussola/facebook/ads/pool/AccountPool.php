<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:26
 */

namespace ebussola\facebook\ads\pool;


use ebussola\common\pool\inmemory\PoolAbstract;

class AccountPool extends PoolAbstract {

    /**
     * @param $object
     *
     * @return int | string
     */
    protected function makeId($object) {
        return $object->id;
    }

}