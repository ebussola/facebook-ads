<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:31
 */

namespace ebussola\facebook\ads\adset;


class AdSet implements \ebussola\facebook\ads\AdSet {

    /**
     * @var \stdClass
     */
    private $campaign;

    public function __construct($campaign) {
        $this->campaign = $campaign;
    }

    public function __get($name) {
        return $this->campaign->{$name};
    }

    public function __set($name, $value) {
        $this->campaign->{$name} = $value;
    }

}