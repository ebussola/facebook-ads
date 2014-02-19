<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 18/02/14
 * Time: 16:56
 */

namespace ebussola\facebook\ads\adcampaign;


class AdCampaign implements \ebussola\facebook\ads\AdCampaign {

    private $adcampaign;

    public function __construct($adcampaign) {
        $this->adcampaign = $adcampaign;
    }

    public function __get($name) {
        return $this->adcampaign->{$name};
    }

    public function __set($name, $value) {
        $this->adcampaign->{$name} = $value;
    }

}