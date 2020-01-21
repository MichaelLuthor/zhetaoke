<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
class ZtkGoods_Test extends TestCase {
    public function test_afterFetched() {
        $goods = ZheTaoKe::getInstance()->goods()->fetchOneByTaoId('607037024445');
        $this->assertEquals('6200068', $goods->code);
        
        $this->assertNotEmpty($goods->getCouponLink());
        $this->assertNotEmpty($goods->getShareLink());
        $this->assertNotEmpty($goods->getTaoKouLing());
    }
}