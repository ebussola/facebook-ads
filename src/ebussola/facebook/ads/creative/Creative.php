<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 18:30
 */

namespace ebussola\facebook\ads\creative;


class Creative implements \ebussola\facebook\ads\Creative {

    /**
     * @var \stdClass
     */
    private $creative;

    public function __construct($creative) {
        $this->creative = $creative;
    }

    public function &__get($name) {
        return $this->creative->{$name};
    }

    public function __set($name, $value) {
        $this->creative->{$name} = $value;
    }

}