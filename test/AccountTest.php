<?php
use ebussola\facebook\ads\account\AccountHelper;

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
        $pool = new \ebussola\facebook\ads\pool\AccountPool(); // instantiating the wrong way to clear the memory
        $this->ads = new \ebussola\facebook\ads\Ads($core, array('account' => $pool));
    }

    public function testGetAllAccounts() {
        $accounts = $this->ads->getAllAccounts();
        foreach ($accounts as $account) {
            $this->assertInstanceOf('\ebussola\facebook\ads\Account', $account);
        }

        return $accounts;
    }

    /**
     * @depends testGetAllAccounts
     */
    public function testGetAccounts($accounts) {

        // Test only one acocunt request
        $one_account = current($accounts);
        $account_id = $one_account->id;
        $result_accounts = $this->ads->getAccounts(array($account_id));

        $this->assertCount(1, $result_accounts);
        $this->assertSame($one_account->id, current($result_accounts)->id);

        // Test multiple accounts request
        $account_ids = AccountHelper::extractIds($accounts);
        $result_accounts = $this->ads->getAccounts($account_ids);

        $this->assertSame(count($accounts), count($result_accounts));
    }

}