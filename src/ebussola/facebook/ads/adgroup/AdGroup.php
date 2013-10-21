<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:31
 */

namespace ebussola\facebook\ads\adgroup;


class AdGroup implements \ebussola\facebook\ads\AdGroup {

    /**
     * @var \stdClass
     */
    private $adgroup;

    public function __construct($adgroup) {
        $this->adgroup = $adgroup;
    }

    public function __get($name) {
        return $this->adgroup->{$name};
    }

    public function __set($name, $value) {
        $this->adgroup->{$name} = $value;
    }

}