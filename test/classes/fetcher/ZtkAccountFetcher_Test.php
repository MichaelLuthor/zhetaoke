<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\entity\ZtkAccount;
class ZtkAccountFetcher_Test extends TestCase {
    public function test_fetchAll() {
        $accounts = ZheTaoKe::getInstance()->account()->fetchAll();
        $this->assertNotEmpty($accounts);
        $this->assertInstanceOf(ZtkAccount::class, $accounts[0]);
    }
}