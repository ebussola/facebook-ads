<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:43
 */

class AccountTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \ebussola\facebook\ads\Ads
     */
    private $ads;

    public function setUp() {
        $config = include('config.php');
        $access_token_data = new AccessTokenData();
        $access_token_data->setLongAccessToken($config['long_access_token'], 5000);

        $core = new \ebussola\facebook\core\Core($config['app_id'], $config['secret'], $config['redirect_uri'], $access_token_data);
        $this->ads = new \ebussola\facebook\ads\Ads($core);
    }

    public function testGetAllAccounts() {
        $accounts = $this->ads->getAllAccounts();
        foreach ($accounts as $account) {
            $this->assertInstanceOf('\ebussola\facebook\ads\Account', $account);
        }
    }

}