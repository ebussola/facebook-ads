<?php
use ebussola\facebook\ads\account\AccountHelper;

/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:43
 */

class AccountTest extends AbstractSetUp {

    public function testGetAllAccounts() {
        $accounts = $this->ads->getAllAccounts();
        foreach ($accounts as $account) {
            $this->assertInstanceOf('\ebussola\facebook\ads\Account', $account);
            $this->assertNotNull($account->id);
        }

        return $accounts;
    }

    /**
     * @depends testGetAllAccounts
     */
    public function testGetAccounts($accounts) {

        // Test only one acocunt request
        $one_account = reset($accounts);
        $account_id = $one_account->id;
        $result_accounts = $this->ads->getAccounts(array($account_id));

        $this->assertCount(1, $result_accounts);
        $this->assertSame($one_account->id, current($result_accounts)->id);
        $this->assertInstanceOf('\ebussola\facebook\ads\Account', current($result_accounts));

        // Test multiple accounts request
        $account_ids = AccountHelper::extractIds($accounts);
        $result_accounts = $this->ads->getAccounts($account_ids);

        $this->assertSame(count($accounts), count($result_accounts));
    }

}