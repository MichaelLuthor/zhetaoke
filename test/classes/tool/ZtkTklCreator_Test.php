<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
class ZtkTklCreator_Test extends TestCase {
    public function test_generaete() {
        $tkl = ZheTaoKe::getInstance()->tklCreator()
            ->setText("测试数据-测试数据")
            ->setUrl('https://uland.taobao.com/index.php')
            ->generate();
        $this->assertNotEmpty($tkl);
    }
}