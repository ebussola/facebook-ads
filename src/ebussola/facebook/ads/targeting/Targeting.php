<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 17:13
 */

namespace ebussola\facebook\ads\targeting;


class Targeting implements \ebussola\facebook\ads\Targeting {

    /**
     * @var \stdClass
     */
    private $targeting;

    public function __construct($targeting) {
        $this->targeting = $targeting;
    }

    public function __get($name) {
        return $this->targeting->{$name};
    }

    public function __set($name, $value) {
        $this->targeting->{$name} = $value;
    }

}