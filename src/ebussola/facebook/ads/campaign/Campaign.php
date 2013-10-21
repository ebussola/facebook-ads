<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:31
 */

namespace ebussola\facebook\ads\campaign;


class Campaign implements \ebussola\facebook\ads\Campaign {

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