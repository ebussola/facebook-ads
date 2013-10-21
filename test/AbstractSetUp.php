<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 15:20
 */

abstract class AbstractSetUp extends PHPUnit_Framework_TestCase {

    /**
     * @var \ebussola\facebook\ads\Ads
     */
    protected $ads;

    public function setUp() {
        $config = include('config.php');
        $access_token_data = new AccessTokenData();
        $access_token_data->setLongAccessToken($config['long_access_token'], 5000);

        $core = new \ebussola\facebook\core\Core($config['app_id'], $config['secret'], $config['redirect_uri'], $access_token_data);

        // instantiating the wrong way to clear the memory
        $pools = array(
            'account' => new \ebussola\facebook\ads\pool\AccountPool(),
            'campaign' => new \ebussola\facebook\ads\pool\CampaignPool(),
            'adgroup' => new \ebussola\facebook\ads\pool\AdGroupPool()
        );
        $this->ads = new \ebussola\facebook\ads\Ads($core, $pools);
    }

}