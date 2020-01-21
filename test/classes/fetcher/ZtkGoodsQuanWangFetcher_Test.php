<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\entity\ZtkGoods;
class ZtkGoodsQuanWangFetcher_Test extends TestCase {
    /**
     * 
     */
    public function test_fetchAll() {
        $goods = ZheTaoKe::getInstance()->goodsQuanWang()->setPageSize(10)->fetchAll();
        $this->assertNotEmpty($goods);
        $this->assertCount(10, $goods);
        $this->assertInstanceOf(ZtkGoods::class, $goods[0]);
    }
}